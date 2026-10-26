<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private readonly OrderService $orderService) {}

    /**
     * Update order status from admin panel (web form).
     */
    public function updateStatus(Request $request, int $id)
    {
        $request->validate([
            'status' => ['required', 'in:' . implode(',', Order::VALID_STATUSES)],
        ]);

        $order = Order::with('items.product')->findOrFail($id);

        try {
            $this->orderService->updateStatus($order, $request->status);
            return back()->with('success', "Order {$order->order_number} updated to '{$request->status}'.");
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
