<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreOrderRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Show the dedicated shopping cart and checkout page.
     */
    public function index()
    {
        $user = Auth::user();

        return view('cart', compact('user'));
    }

    /**
     * Process checkout submission.
     */
    public function checkout(StoreOrderRequest $request, OrderService $orderService)
    {
        try {
            $order = $orderService->createOrder($request->validated());

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Order placed successfully.',
                    'data'    => $order,
                ], 201);
            }

            return redirect()->route('cart.success', ['order' => $order->order_number])
                ->with('success', "Order #{$order->order_number} placed successfully!");
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ], 422);
            }

            return back()->withInput()->withErrors(['order_error' => $e->getMessage()]);
        }
    }

    /**
     * Show order confirmation receipt.
     */
    public function success(string $orderNumber)
    {
        $order = Order::with('items.product')->where('order_number', $orderNumber)->firstOrFail();
        $user  = Auth::user();

        return view('cart-success', compact('order', 'user'));
    }
}
