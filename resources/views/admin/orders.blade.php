<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Orders — ShopNest Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root { --bg:#07070d;--bg-card:#0f0f18;--bg-glass:rgba(255,255,255,.03);--border:rgba(255,255,255,.08);--sidebar-w:240px;--accent:#7c3aed;--accent2:#a855f7;--green:#22c55e;--red:#ef4444;--amber:#f59e0b;--blue:#3b82f6;--text:#f1f5f9;--muted:#64748b; }
        body { font-family:'Inter',sans-serif;background:var(--bg);color:var(--text);display:flex;min-height:100vh; }
        .sidebar { width:var(--sidebar-w);background:var(--bg-card);border-right:1px solid var(--border);display:flex;flex-direction:column;position:fixed;top:0;left:0;bottom:0;z-index:10; }
        .sidebar-logo { padding:1.5rem;font-size:1.3rem;font-weight:800;background:linear-gradient(135deg,#fff,#a855f7);-webkit-background-clip:text;-webkit-text-fill-color:transparent;border-bottom:1px solid var(--border); }
        .sidebar-nav { flex:1;padding:1rem 0; }
        .nav-section { padding:.5rem 1rem .25rem;font-size:.65rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--muted); }
        .nav-link { display:flex;align-items:center;gap:.75rem;padding:.65rem 1rem;margin:2px .5rem;border-radius:8px;color:var(--muted);text-decoration:none;font-size:.875rem;font-weight:500;transition:all .15s; }
        .nav-link:hover { background:var(--bg-glass);color:var(--text); }
        .nav-link.active { background:rgba(124,58,237,.15);color:var(--accent2); }
        .sidebar-footer { padding:1rem;border-top:1px solid var(--border); }
        .user-chip { display:flex;align-items:center;gap:.75rem; }
        .user-avatar { width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--accent),var(--accent2));display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.875rem;flex-shrink:0; }
        .user-name { font-size:.825rem;font-weight:600; }
        .user-role { font-size:.7rem;color:var(--accent2);font-weight:600;text-transform:uppercase;letter-spacing:.5px; }
        .logout-btn { display:block;text-align:center;margin-top:.75rem;padding:.55rem;border-radius:8px;background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.2);color:#fca5a5;font-size:.8rem;font-weight:600;transition:all .15s;cursor:pointer;width:100%;font-family:'Inter',sans-serif; }
        .logout-btn:hover { background:rgba(239,68,68,.15); }
        .main { margin-left:var(--sidebar-w);flex:1; }
        .topbar { background:rgba(10,10,15,.8);backdrop-filter:blur(20px);border-bottom:1px solid var(--border);padding:1rem 2rem;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:5; }
        .page-title { font-size:1.2rem;font-weight:700; }
        .content { padding:2rem; }
        .filter-bar { display:flex;gap:.75rem;flex-wrap:wrap;margin-bottom:1.5rem;align-items:center; }
        .filter-link { padding:.4rem .9rem;border-radius:20px;font-size:.8rem;font-weight:600;text-decoration:none;border:1px solid var(--border);color:var(--muted);transition:all .15s; }
        .filter-link:hover,.filter-link.active { border-color:var(--accent);color:var(--accent2);background:rgba(124,58,237,.08); }
        table { width:100%;border-collapse:collapse;background:var(--bg-card);border:1px solid var(--border);border-radius:14px;overflow:hidden; }
        th { padding:.75rem 1.1rem;font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:var(--muted);text-align:left;border-bottom:1px solid var(--border);background:rgba(255,255,255,.02); }
        td { padding:.85rem 1.1rem;font-size:.875rem;border-bottom:1px solid rgba(255,255,255,.03); }
        tr:last-child td { border-bottom:none; }
        tr:hover td { background:var(--bg-glass); }
        .status-pill { padding:2px 10px;border-radius:20px;font-size:.68rem;font-weight:700;text-transform:uppercase;letter-spacing:.4px; }
        .s-pending  { background:rgba(245,158,11,.1);color:var(--amber);border:1px solid rgba(245,158,11,.25); }
        .s-confirmed { background:rgba(59,130,246,.1);color:var(--blue);border:1px solid rgba(59,130,246,.25); }
        .s-processing { background:rgba(124,58,237,.1);color:var(--accent2);border:1px solid rgba(124,58,237,.25); }
        .s-shipped  { background:rgba(16,185,129,.1);color:#34d399;border:1px solid rgba(16,185,129,.25); }
        .s-delivered { background:rgba(34,197,94,.1);color:var(--green);border:1px solid rgba(34,197,94,.25); }
        .s-cancelled { background:rgba(239,68,68,.1);color:var(--red);border:1px solid rgba(239,68,68,.25); }
        .update-form { display:flex;align-items:center;gap:.4rem; }
        .status-select { padding:.3rem .5rem;background:var(--bg);border:1px solid var(--border);border-radius:6px;color:var(--text);font-size:.78rem;font-family:'Inter',sans-serif;outline:none;cursor:pointer; }
        .update-btn { padding:.3rem .7rem;background:var(--accent);border:none;border-radius:6px;color:#fff;font-size:.75rem;font-weight:600;cursor:pointer;font-family:'Inter',sans-serif;transition:background .15s; }
        .update-btn:hover { background:var(--accent2); }
        .empty { text-align:center;padding:4rem;color:var(--muted); }
        .pagination { display:flex;gap:.5rem;justify-content:center;margin-top:1.5rem;flex-wrap:wrap; }
        .page-btn { min-width:36px;height:36px;padding:0 .6rem;display:flex;align-items:center;justify-content:center;background:var(--bg-card);border:1px solid var(--border);border-radius:7px;color:var(--muted);text-decoration:none;font-size:.85rem;transition:all .15s; }
        .page-btn:hover { border-color:var(--accent);color:var(--text); }
        .page-btn.active { background:var(--accent);border-color:var(--accent);color:#fff; }
        .page-btn.disabled { opacity:.3;pointer-events:none; }
    </style>
</head>
<body>
<aside class="sidebar">
    <div class="sidebar-logo">🛍 ShopNest</div>
    <nav class="sidebar-nav">
        <div class="nav-section">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-link"><span>📊</span> Dashboard</a>
        <div class="nav-section">Orders</div>
        <a href="{{ route('admin.orders') }}" class="nav-link active"><span>🧾</span> All Orders</a>
        <a href="{{ route('browse') }}" class="nav-link" target="_blank"><span>📦</span> Browse Products</a>
    </nav>
    <div class="sidebar-footer">
        <div class="user-chip">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div>
            <div><div class="user-name">{{ auth()->user()->name }}</div><div class="user-role">Administrator</div></div>
        </div>
        <form method="POST" action="{{ route('logout') }}" style="margin-top:.75rem">@csrf<button type="submit" class="logout-btn">← Sign Out</button></form>
    </div>
</aside>
<div class="main">
    <div class="topbar">
        <div class="page-title">🧾 All Orders</div>
        <span style="font-size:.85rem;color:var(--muted)">{{ $orders->total() }} total orders</span>
    </div>
    <div class="content">
        <!-- Status Filter -->
        <div class="filter-bar">
            <span style="font-size:.8rem;color:var(--muted);font-weight:600">Filter:</span>
            @foreach([''=>'All', 'pending'=>'Pending', 'confirmed'=>'Confirmed', 'processing'=>'Processing', 'shipped'=>'Shipped', 'delivered'=>'Delivered', 'cancelled'=>'Cancelled'] as $val => $label)
            <a href="{{ route('admin.orders', $val ? ['status'=>$val] : []) }}" class="filter-link {{ request('status')===$val ? 'active' : '' }}">{{ $label }}</a>
            @endforeach
        </div>

        @if($orders->count())
        <table>
            <thead>
                <tr>
                    <th>Order #</th><th>Customer</th><th>Items</th><th>Total</th><th>Status</th><th>Date</th><th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td style="font-family:monospace;color:var(--accent2);font-size:.8rem">{{ $order->order_number }}</td>
                    <td>
                        <div style="font-weight:500">{{ $order->customer_name }}</div>
                        <div style="font-size:.75rem;color:var(--muted)">{{ $order->customer_email }}</div>
                    </td>
                    <td style="color:var(--muted);font-size:.8rem">{{ $order->items->count() }} item(s)</td>
                    <td style="font-weight:700">₹{{ number_format($order->total, 2) }}</td>
                    <td><span class="status-pill s-{{ $order->status }}">{{ $order->status }}</span></td>
                    <td style="color:var(--muted);font-size:.8rem">{{ $order->created_at->format('M j, Y') }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.orders.status', $order->id) }}" class="update-form">
                            @csrf @method('PATCH')
                            <select name="status" class="status-select">
                                @foreach(\App\Models\Order::VALID_STATUSES as $s)
                                <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="update-btn">Update</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty">No orders found for this filter.</div>
        @endif

        @if($orders->hasPages())
        <div class="pagination">
            @if($orders->onFirstPage())<span class="page-btn disabled">← Prev</span>
            @else<a href="{{ $orders->previousPageUrl() }}" class="page-btn">← Prev</a>@endif
            @foreach($orders->getUrlRange(1,$orders->lastPage()) as $page=>$url)
            <a href="{{ $url }}" class="page-btn {{ $page==$orders->currentPage()?'active':'' }}">{{ $page }}</a>
            @endforeach
            @if($orders->hasMorePages())<a href="{{ $orders->nextPageUrl() }}" class="page-btn">Next →</a>
            @else<span class="page-btn disabled">Next →</span>@endif
        </div>
        @endif
    </div>
</div>
</body>
</html>
