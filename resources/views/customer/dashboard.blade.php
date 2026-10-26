<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard — ShopNest</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #07070d; --bg-card: #0f0f18; --bg-glass: rgba(255,255,255,0.03);
            --border: rgba(255,255,255,0.08);
            --accent: #7c3aed; --accent2: #a855f7; --accent-glow: rgba(124,58,237,0.3);
            --green: #22c55e; --red: #ef4444; --amber: #f59e0b; --blue: #3b82f6;
            --text: #f1f5f9; --muted: #64748b;
        }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; }

        /* NAV */
        nav {
            background: rgba(10,10,15,0.9); backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem; height: 64px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 10;
        }
        .nav-logo { font-size: 1.3rem; font-weight: 800;
            background: linear-gradient(135deg, #fff, #a855f7);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .nav-right { display: flex; align-items: center; gap: 1rem; }
        .nav-user { display: flex; align-items: center; gap: 0.6rem; }
        .avatar { width: 34px; height: 34px; border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 0.8rem; flex-shrink: 0; }
        .nav-name { font-size: 0.875rem; font-weight: 600; }
        .nav-role { font-size: 0.68rem; color: var(--accent2); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
        .logout-link {
            padding: 0.45rem 1rem; border-radius: 8px;
            border: 1px solid rgba(239,68,68,0.25); background: rgba(239,68,68,0.06);
            color: #fca5a5; font-size: 0.8rem; font-weight: 600;
            cursor: pointer; font-family: 'Inter', sans-serif; transition: all 0.15s;
        }
        .logout-link:hover { background: rgba(239,68,68,0.15); }
        .browse-link {
            padding: 0.45rem 1.1rem; border-radius: 8px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            color: #fff; font-size: 0.8rem; font-weight: 600; text-decoration: none; transition: opacity 0.15s;
        }
        .browse-link:hover { opacity: 0.85; }

        /* HERO WELCOME */
        .welcome-hero {
            background: linear-gradient(135deg, #1e1035 0%, #07070d 60%);
            border-bottom: 1px solid var(--border);
            padding: 2.5rem 2rem 2rem;
            position: relative; overflow: hidden;
        }
        .welcome-hero::before {
            content: ''; position: absolute; top: -80px; right: -80px;
            width: 400px; height: 400px; border-radius: 50%;
            background: radial-gradient(circle, rgba(124,58,237,0.2), transparent 70%);
        }
        .welcome-hero h1 { font-size: 1.8rem; font-weight: 800; letter-spacing: -0.5px; }
        .welcome-hero p { color: var(--muted); margin-top: 0.25rem; font-size: 0.9rem; }

        /* STATS */
        .stats-row { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 1rem; margin-top: 2rem; }
        .stat { background: var(--bg-card); border: 1px solid var(--border); border-radius: 12px; padding: 1rem 1.25rem; }
        .stat-icon { font-size: 1.4rem; margin-bottom: 0.4rem; }
        .stat-label { font-size: 0.72rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; }
        .stat-value { font-size: 1.6rem; font-weight: 800; letter-spacing: -0.5px; margin-top: 0.1rem; }

        /* CONTENT */
        .content { padding: 2rem; max-width: 1200px; }
        .section-title { font-size: 1rem; font-weight: 700; margin-bottom: 1rem; }

        /* ORDERS */
        .order-card {
            background: var(--bg-card); border: 1px solid var(--border);
            border-radius: 14px; margin-bottom: 0.85rem; overflow: hidden;
            transition: border-color 0.2s;
        }
        .order-card:hover { border-color: rgba(124,58,237,0.3); }
        .order-head {
            padding: 1rem 1.25rem;
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem;
            border-bottom: 1px solid var(--border);
        }
        .order-num { font-family: monospace; font-size: 0.85rem; color: var(--accent2); font-weight: 700; }
        .order-date { font-size: 0.78rem; color: var(--muted); margin-top: 2px; }
        .order-body { padding: 1rem 1.25rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem; }
        .order-items-preview { display: flex; flex-wrap: wrap; gap: 0.4rem; }
        .item-chip {
            background: var(--bg-glass); border: 1px solid var(--border);
            border-radius: 6px; padding: 2px 8px; font-size: 0.75rem; color: var(--muted);
        }
        .order-total { font-size: 1rem; font-weight: 700; }
        .order-sub { font-size: 0.75rem; color: var(--muted); text-align: right; margin-top: 2px; }

        /* Status pills */
        .status-pill { padding: 3px 10px; border-radius: 20px; font-size: 0.68rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.4px; }
        .s-pending    { background: rgba(245,158,11,0.1); color: var(--amber); border: 1px solid rgba(245,158,11,0.25); }
        .s-confirmed  { background: rgba(59,130,246,0.1); color: var(--blue);  border: 1px solid rgba(59,130,246,0.25); }
        .s-processing { background: rgba(124,58,237,0.1); color: var(--accent2); border: 1px solid rgba(124,58,237,0.25); }
        .s-shipped    { background: rgba(16,185,129,0.1); color: #34d399; border: 1px solid rgba(16,185,129,0.25); }
        .s-delivered  { background: rgba(34,197,94,0.1);  color: var(--green); border: 1px solid rgba(34,197,94,0.25); }
        .s-cancelled  { background: rgba(239,68,68,0.1);  color: var(--red);   border: 1px solid rgba(239,68,68,0.25); }

        /* Timeline */
        .order-timeline { padding: 0 1.25rem 1rem; display: flex; gap: 0; }
        .tl-step { flex: 1; text-align: center; position: relative; }
        .tl-step::before {
            content: ''; position: absolute; top: 8px; left: 50%; right: -50%;
            height: 2px; background: var(--border);
        }
        .tl-step:last-child::before { display: none; }
        .tl-dot { width: 18px; height: 18px; border-radius: 50%; margin: 0 auto 0.3rem;
            border: 2px solid var(--border); background: var(--bg-card); position: relative; z-index: 1; }
        .tl-dot.done { background: var(--green); border-color: var(--green); }
        .tl-dot.current { background: var(--accent); border-color: var(--accent); box-shadow: 0 0 8px var(--accent-glow); }
        .tl-label { font-size: 0.62rem; color: var(--muted); }
        .tl-label.done { color: var(--green); }
        .tl-label.current { color: var(--accent2); }

        .empty-orders { text-align: center; padding: 4rem 2rem; color: var(--muted); }
        .empty-orders .big { font-size: 4rem; margin-bottom: 1rem; opacity: 0.4; }

        .pagination { display: flex; gap: 0.5rem; justify-content: center; margin-top: 1.5rem; flex-wrap: wrap; }
        .page-btn { min-width: 36px; height: 36px; padding: 0 0.6rem; display: flex; align-items: center; justify-content: center;
            background: var(--bg-card); border: 1px solid var(--border); border-radius: 7px;
            color: var(--muted); text-decoration: none; font-size: 0.85rem; transition: all 0.15s; }
        .page-btn:hover { border-color: var(--accent); color: var(--text); }
        .page-btn.active { background: var(--accent); border-color: var(--accent); color: #fff; }
        .page-btn.disabled { opacity: 0.3; pointer-events: none; }
    </style>
</head>
<body>

<!-- NAV -->
<nav>
    <span class="nav-logo">🛍 ShopNest</span>
    <div class="nav-right">
        <a href="{{ route('browse') }}" class="browse-link">🛒 Browse Products</a>
        <div class="nav-user">
            <div class="avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
            <div>
                <div class="nav-name">{{ $user->name }}</div>
                <div class="nav-role">Customer</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-link">Sign Out</button>
        </form>
    </div>
</nav>

<!-- WELCOME HERO -->
<div class="welcome-hero">
    <div style="max-width:1200px">
        <h1>Welcome back, {{ explode(' ', $user->name)[0] }}! 👋</h1>
        <p>Here's a summary of your shopping activity on ShopNest.</p>

        <div class="stats-row">
            <div class="stat">
                <div class="stat-icon">🧾</div>
                <div class="stat-label">Total Orders</div>
                <div class="stat-value">{{ $stats['total_orders'] }}</div>
            </div>
            <div class="stat">
                <div class="stat-icon">⏳</div>
                <div class="stat-label">Pending</div>
                <div class="stat-value">{{ $stats['pending_orders'] }}</div>
            </div>
            <div class="stat">
                <div class="stat-icon">✅</div>
                <div class="stat-label">Delivered</div>
                <div class="stat-value">{{ $stats['delivered_orders'] }}</div>
            </div>
            <div class="stat">
                <div class="stat-icon">💰</div>
                <div class="stat-label">Total Spent</div>
                <div class="stat-value" style="font-size:1.3rem">₹{{ number_format($stats['total_spent'], 0) }}</div>
            </div>
        </div>
    </div>
</div>

<!-- ORDERS -->
<div class="content">
    @if(session('success'))
    <div style="background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.25);color:#86efac;padding:.85rem 1rem;border-radius:10px;margin-bottom:1.5rem;font-size:.875rem;">
        ✓ {{ session('success') }}
    </div>
    @endif

    <div class="section-title">Your Orders</div>

    @forelse($orders as $order)
    @php
        $steps = ['pending','confirmed','processing','shipped','delivered'];
        $currentIdx = array_search($order->status, $steps);
        if($order->status === 'cancelled') $currentIdx = -1;
    @endphp
    <div class="order-card">
        <div class="order-head">
            <div>
                <div class="order-num">{{ $order->order_number }}</div>
                <div class="order-date">Placed {{ $order->created_at->format('M j, Y \a\t g:i A') }}</div>
            </div>
            <span class="status-pill s-{{ $order->status }}">{{ $order->status }}</span>
        </div>

        @if($order->status !== 'cancelled')
        <div class="order-timeline">
            @foreach($steps as $idx => $step)
            <div class="tl-step">
                <div class="tl-dot {{ $idx < $currentIdx ? 'done' : ($idx === $currentIdx ? 'current' : '') }}"></div>
                <div class="tl-label {{ $idx < $currentIdx ? 'done' : ($idx === $currentIdx ? 'current' : '') }}">{{ ucfirst($step) }}</div>
            </div>
            @endforeach
        </div>
        @endif

        <div class="order-body">
            <div class="order-items-preview">
                @foreach($order->items as $item)
                    <span class="item-chip">{{ $item->product_name }} ×{{ $item->quantity }}</span>
                @endforeach
            </div>
            <div style="text-align:right">
                <div class="order-total">₹{{ number_format($order->total, 2) }}</div>
                <div class="order-sub">{{ $order->items->count() }} item(s) · incl. 18% GST</div>
            </div>
        </div>
    </div>
    @empty
    <div class="empty-orders">
        <div class="big">📦</div>
        <div style="font-size:1.1rem;color:var(--text);margin-bottom:.5rem">No orders yet</div>
        <p>Browse our products and place your first order!</p>
        <a href="{{ route('browse') }}" style="display:inline-block;margin-top:1.25rem;padding:.75rem 1.5rem;background:linear-gradient(135deg,var(--accent),var(--accent2));border-radius:10px;color:#fff;text-decoration:none;font-weight:600;font-size:.9rem">Browse Products →</a>
    </div>
    @endforelse

    @if($orders->hasPages())
    <div class="pagination">
        @if($orders->onFirstPage())<span class="page-btn disabled">← Prev</span>
        @else<a href="{{ $orders->previousPageUrl() }}" class="page-btn">← Prev</a>@endif
        @foreach($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
        <a href="{{ $url }}" class="page-btn {{ $page == $orders->currentPage() ? 'active' : '' }}">{{ $page }}</a>
        @endforeach
        @if($orders->hasMorePages())<a href="{{ $orders->nextPageUrl() }}" class="page-btn">Next →</a>
        @else<span class="page-btn disabled">Next →</span>@endif
    </div>
    @endif
</div>

</body>
</html>
