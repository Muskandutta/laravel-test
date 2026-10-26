<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the customer dashboard with their orders.
     */
    public function index()
    {
        $user = Auth::user();

        $orders = Order::with('items')
            ->where('customer_email', $user->email)
            ->latest()
            ->paginate(10);

        $stats = [
            'total_orders'    => Order::where('customer_email', $user->email)->count(),
            'pending_orders'  => Order::where('customer_email', $user->email)->where('status', 'pending')->count(),
            'delivered_orders' => Order::where('customer_email', $user->email)->where('status', 'delivered')->count(),
            'total_spent'     => Order::where('customer_email', $user->email)
                                    ->whereNotIn('status', ['cancelled'])
                                    ->sum('total'),
        ];

        return view('customer.dashboard', compact('orders', 'stats', 'user'));
    }
}
