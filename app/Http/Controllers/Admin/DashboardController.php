<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index()
    {
        $stats = [
            'total_orders'    => Order::count(),
            'pending_orders'  => Order::where('status', 'pending')->count(),
            'total_products'  => Product::count(),
            'out_of_stock'    => Product::where('status', 'out_of_stock')->orWhere('stock_quantity', 0)->count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'total_revenue'   => Order::whereNotIn('status', ['cancelled'])->sum('total'),
        ];

        $recentOrders = Order::with('items')
            ->latest()
            ->take(10)
            ->get();

        $lowStockProducts = Product::where('status', 'active')
            ->whereRaw('stock_quantity <= low_stock_threshold')
            ->orderBy('stock_quantity')
            ->take(8)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'lowStockProducts'));
    }

    /**
     * List all orders with filters.
     */
    public function orders(Request $request)
    {
        $query = Order::with('items')->latest();

        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        $orders = $query->paginate(20)->withQueryString();

        return view('admin.orders', compact('orders'));
    }
}
