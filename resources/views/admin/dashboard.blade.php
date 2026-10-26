<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — ShopNest</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #07070d; --bg-card: #0f0f18; --bg-glass: rgba(255,255,255,0.03);
            --border: rgba(255,255,255,0.08); --sidebar-w: 240px;
            --accent: #7c3aed; --accent2: #a855f7; --accent-glow: rgba(124,58,237,0.3);
            --green: #22c55e; --red: #ef4444; --amber: #f59e0b; --blue: #3b82f6;
            --text: #f1f5f9; --muted: #64748b;
        }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar {
            width: var(--sidebar-w); background: var(--bg-card);
            border-right: 1px solid var(--border);
            display: flex; flex-direction: column;
            position: fixed; top: 0; left: 0; bottom: 0; z-index: 10;
        }
        .sidebar-logo {
            padding: 1.5rem; font-size: 1.3rem; font-weight: 800;
            background: linear-gradient(135deg, #fff, #a855f7);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            border-bottom: 1px solid var(--border);
        }
        .sidebar-nav { flex: 1; padding: 1rem 0; }
        .nav-section { padding: 0.5rem 1rem 0.25rem; font-size: 0.65rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--muted); }
        .nav-link {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.65rem 1rem; margin: 2px 0.5rem; border-radius: 8px;
            color: var(--muted); text-decoration: none; font-size: 0.875rem; font-weight: 500;
            transition: all 0.15s;
        }
        .nav-link:hover { background: var(--bg-glass); color: var(--text); }
        .nav-link.active { background: rgba(124,58,237,0.15); color: var(--accent2); }
        .nav-icon { font-size: 1rem; width: 20px; text-align: center; }
        .sidebar-footer { padding: 1rem; border-top: 1px solid var(--border); }
        .user-chip { display: flex; align-items: center; gap: 0.75rem; }
        .user-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 0.875rem; flex-shrink: 0;
        }
        .user-name { font-size: 0.825rem; font-weight: 600; }
        .user-role { font-size: 0.7rem; color: var(--accent2); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .logout-btn {
            display: block; text-align: center; margin-top: 0.75rem;
            padding: 0.55rem; border-radius: 8px;
            background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.2);
            color: #fca5a5; text-decoration: none; font-size: 0.8rem; font-weight: 600;
            transition: all 0.15s; cursor: pointer; width: 100%; font-family: 'Inter', sans-serif;
        }
        .logout-btn:hover { background: rgba(239,68,68,0.15); }

        /* MAIN */
        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; }
        .topbar {
            background: rgba(10,10,15,0.8); backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border); padding: 1rem 2rem;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 5;
        }
        .page-title { font-size: 1.2rem; font-weight: 700; }
        .page-sub { font-size: 0.8rem; color: var(--muted); margin-top: 1px; }
        .badge-admin { background: rgba(124,58,237,0.15); color: var(--accent2); border: 1px solid rgba(124,58,237,0.3); padding: 3px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase; }

        .content { padding: 2rem; }

        /* STATS GRID */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem; }
        .stat-card {
            background: var(--bg-card); border: 1px solid var(--border);
            border-radius: 14px; padding: 1.25rem;
            display: flex; flex-direction: column; gap: 0.5rem;
            transition: border-color 0.2s, transform 0.2s;
        }
        .stat-card:hover { border-color: rgba(124,58,237,0.3); transform: translateY(-2px); }
        .stat-icon { font-size: 1.6rem; }
        .stat-label { font-size: 0.75rem; color: var(--muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-value { font-size: 1.8rem; font-weight: 800; letter-spacing: -1px; }
        .stat-sub { font-size: 0.75rem; color: var(--muted); }

        /* TWO COLS */
        .two-cols { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
        @media(max-width: 900px) { .two-cols { grid-template-columns: 1fr; } }

        .section-card { background: var(--bg-card); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; }
        .section-head { padding: 1.1rem 1.25rem; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
        .section-title { font-size: 0.9rem; font-weight: 700; }
        .view-all { font-size: 0.78rem; color: var(--accent2); text-decoration: none; font-weight: 600; }
        .view-all:hover { color: #fff; }

        /* ORDERS TABLE */
        .order-table { width: 100%; border-collapse: collapse; }
        .order-table th { padding: 0.65rem 1rem; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: var(--muted); text-align: left; border-bottom: 1px solid var(--border); }
        .order-table td { padding: 0.75rem 1rem; font-size: 0.85rem; border-bottom: 1px solid rgba(255,255,255,0.03); }
        .order-table tr:last-child td { border-bottom: none; }
        .order-table tr:hover td { background: var(--bg-glass); }

        .status-pill { padding: 2px 10px; border-radius: 20px; font-size: 0.68rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.4px; }
        .s-pending    { background: rgba(245,158,11,0.1); color: var(--amber); border: 1px solid rgba(245,158,11,0.25); }
        .s-confirmed  { background: rgba(59,130,246,0.1); color: var(--blue);  border: 1px solid rgba(59,130,246,0.25); }
        .s-processing { background: rgba(124,58,237,0.1); color: var(--accent2); border: 1px solid rgba(124,58,237,0.25); }
        .s-shipped    { background: rgba(16,185,129,0.1); color: #34d399; border: 1px solid rgba(16,185,129,0.25); }
        .s-delivered  { background: rgba(34,197,94,0.1);  color: var(--green); border: 1px solid rgba(34,197,94,0.25); }
        .s-cancelled  { background: rgba(239,68,68,0.1);  color: var(--red);   border: 1px solid rgba(239,68,68,0.25); }

        .empty-state { padding: 3rem; text-align: center; color: var(--muted); font-size: 0.875rem; }

        /* LOW STOCK LIST */
        .stock-item { display: flex; align-items: center; justify-content: space-between; padding: 0.75rem 1.25rem; border-bottom: 1px solid rgba(255,255,255,0.03); }
        .stock-item:last-child { border-bottom: none; }
        .stock-item:hover { background: var(--bg-glass); }
        .stock-name { font-size: 0.85rem; font-weight: 500; }
        .stock-sku  { font-size: 0.72rem; color: var(--muted); font-family: monospace; margin-top: 2px; }
        .stock-qty  { font-size: 0.875rem; font-weight: 700; color: var(--amber); }
        .stock-qty.critical { color: var(--red); }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-logo">🛍 ShopNest</div>
    <nav class="sidebar-nav">
        <div class="nav-section">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-link active">
            <span class="nav-icon">📊</span> Dashboard
        </a>
        <div class="nav-section">Inventory</div>
        <a href="{{ route('browse') }}" class="nav-link" target="_blank">
            <span class="nav-icon">📦</span> Browse Products
        </a>
        <div class="nav-section">Orders</div>
        <a href="{{ route('admin.orders') }}" class="nav-link">
            <span class="nav-icon">🧾</span> All Orders
        </a>
        <a href="{{ route('admin.orders', ['status' => 'pending']) }}" class="nav-link">
            <span class="nav-icon">⏳</span> Pending
        </a>
    </nav>
    <div class="sidebar-footer">
        <div class="user-chip">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">Administrator</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}" style="margin-top:0.75rem">
            @csrf
            <button type="submit" class="logout-btn">← Sign Out</button>
        </form>
    </div>
</aside>

<!-- MAIN -->
<div class="main">
    <div class="topbar">
        <div>
            <div class="page-title">Admin Dashboard</div>
            <div class="page-sub">{{ now()->format('l, F j Y') }}</div>
        </div>
        <span class="badge-admin">Admin</span>
    </div>

    <div class="content">

        @if(session('success'))
        <div style="background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.25);color:#86efac;padding:.85rem 1rem;border-radius:10px;margin-bottom:1.5rem;font-size:.875rem;">
            ✓ {{ session('success') }}
        </div>
        @endif

        <!-- STAT CARDS -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">🧾</div>
                <div class="stat-label">Total Orders</div>
                <div class="stat-value">{{ number_format($stats['total_orders']) }}</div>
                <div class="stat-sub">{{ $stats['pending_orders'] }} pending</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">💰</div>
                <div class="stat-label">Revenue</div>
                <div class="stat-value">₹{{ number_format($stats['total_revenue'], 0) }}</div>
                <div class="stat-sub">Excl. cancelled</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📦</div>
                <div class="stat-label">Products</div>
                <div class="stat-value">{{ $stats['total_products'] }}</div>
                <div class="stat-sub">{{ $stats['out_of_stock'] }} out of stock</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-label">Customers</div>
                <div class="stat-value">{{ $stats['total_customers'] }}</div>
                <div class="stat-sub">Registered accounts</div>
            </div>
        </div>

        <!-- TWO COLS -->
        <div class="two-cols">

            <!-- RECENT ORDERS -->
            <div class="section-card">
                <div class="section-head">
                    <span class="section-title">🧾 Recent Orders</span>
                    <a href="{{ route('admin.orders') }}" class="view-all">View all →</a>
                </div>
                @if($recentOrders->count())
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                        <tr>
                            <td style="font-family:monospace;font-size:0.78rem;color:var(--accent2)">{{ $order->order_number }}</td>
                            <td>
                                <div style="font-size:0.83rem;font-weight:500">{{ $order->customer_name }}</div>
                                <div style="font-size:0.72rem;color:var(--muted)">{{ $order->customer_email }}</div>
                            </td>
                            <td style="font-weight:600">₹{{ number_format($order->total, 2) }}</td>
                            <td><span class="status-pill s-{{ $order->status }}">{{ $order->status }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="empty-state">No orders yet.</div>
                @endif
            </div>

            <!-- LOW STOCK -->
            <div class="section-card">
                <div class="section-head">
                    <span class="section-title">⚠️ Low Stock Alert</span>
                </div>
                @if($lowStockProducts->count())
                    @foreach($lowStockProducts as $p)
                    <div class="stock-item">
                        <div>
                            <div class="stock-name">{{ $p->name }}</div>
                            <div class="stock-sku">{{ $p->sku }}</div>
                        </div>
                        <div class="stock-qty {{ $p->stock_quantity <= 2 ? 'critical' : '' }}">
                            {{ $p->stock_quantity }} left
                        </div>
                    </div>
                    @endforeach
                @else
                <div class="empty-state">✅ All products are well stocked!</div>
                @endif
            </div>

        </div>
    </div>
</div>

</body>
</html>
