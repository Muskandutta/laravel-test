<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Browse our premium collection of electronics, clothing, books, and more. Fast delivery, best prices.">
    <title>Browse Products — ShopNest</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #0a0a0f;
            --bg-card:   #13131a;
            --bg-glass:  rgba(255,255,255,0.04);
            --border:    rgba(255,255,255,0.08);
            --accent:    #7c3aed;
            --accent2:   #a855f7;
            --accent-glow: rgba(124,58,237,0.35);
            --green:     #22c55e;
            --red:       #ef4444;
            --amber:     #f59e0b;
            --text:      #f1f5f9;
            --muted:     #64748b;
            --subtle:    #334155;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* ─── NAV ─── */
        nav {
            position: sticky; top: 0; z-index: 100;
            background: rgba(10,10,15,0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            display: flex; align-items: center; justify-content: space-between;
            height: 64px;
        }
        .nav-logo {
            font-size: 1.4rem; font-weight: 800;
            background: linear-gradient(135deg, #a855f7, #7c3aed);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
        }
        .nav-actions { display: flex; align-items: center; gap: 0.75rem; }
        .nav-link {
            color: var(--muted); text-decoration: none; font-size: 0.85rem; font-weight: 500;
            padding: 0.45rem 0.75rem; border-radius: 8px; transition: all 0.15s;
        }
        .nav-link:hover { color: var(--text); background: var(--bg-glass); }
        .cart-link-btn {
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            color: #fff; text-decoration: none;
            padding: 0.45rem 1rem; border-radius: 8px;
            font-size: 0.85rem; font-weight: 600;
            display: inline-flex; align-items: center; gap: 0.45rem;
            transition: all 0.2s;
        }
        .cart-link-btn:hover { opacity: 0.9; transform: translateY(-1px); }
        .quick-cart-btn {
            background: rgba(255,255,255,0.06); border: 1px solid var(--border);
            color: var(--text); padding: 0.45rem 0.85rem; border-radius: 8px;
            font-size: 0.85rem; font-weight: 600; cursor: pointer;
            transition: all 0.15s;
        }
        .quick-cart-btn:hover { background: rgba(255,255,255,0.12); }
        .logout-link-btn {
            background: none; border: 1px solid rgba(239,68,68,0.3); color: #fca5a5;
            padding: 0.4rem 0.75rem; border-radius: 8px; font-size: 0.8rem; font-weight: 600;
            cursor: pointer; transition: all 0.15s; font-family: 'Inter', sans-serif;
        }
        .logout-link-btn:hover { background: rgba(239,68,68,0.15); }
        .view-cart-full-btn {
            display: block; width: 100%; text-align: center;
            background: rgba(124,58,237,0.15); border: 1px solid rgba(168,85,247,0.35);
            color: #c084fc; padding: 0.65rem; border-radius: 10px;
            font-size: 0.85rem; font-weight: 700; text-decoration: none; margin-bottom: 0.85rem;
            transition: all 0.2s;
        }
        .view-cart-full-btn:hover { background: rgba(124,58,237,0.28); color: #fff; }
        .cart-btn {
            background: var(--accent);
            color: #fff; border: none;
            padding: 0.5rem 1.2rem; border-radius: 8px;
            font-size: 0.875rem; font-weight: 600; cursor: pointer;
            display: flex; align-items: center; gap: 0.4rem;
            transition: all 0.2s;
        }
        .cart-btn:hover { background: var(--accent2); transform: translateY(-1px); }
        .cart-badge {
            background: #fff; color: var(--accent);
            border-radius: 50%; width: 18px; height: 18px;
            font-size: 0.7rem; font-weight: 700;
            display: inline-flex; align-items: center; justify-content: center;
        }

        /* ─── HERO STRIP ─── */
        .hero {
            background: linear-gradient(135deg, #1e1035 0%, #0a0a0f 60%);
            border-bottom: 1px solid var(--border);
            padding: 3rem 2rem 2.5rem;
            text-align: center;
            position: relative; overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute; top: -60px; left: 50%; transform: translateX(-50%);
            width: 500px; height: 200px;
            background: radial-gradient(ellipse, rgba(124,58,237,0.3) 0%, transparent 70%);
            pointer-events: none;
        }
        .hero h1 {
            font-size: clamp(1.8rem, 4vw, 3rem);
            font-weight: 800; letter-spacing: -1px;
            background: linear-gradient(135deg, #fff 30%, #a855f7 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }
        .hero p { color: var(--muted); font-size: 1rem; margin-bottom: 2rem; }

        /* ─── SEARCH BAR ─── */
        .search-wrap {
            max-width: 560px; margin: 0 auto;
            position: relative;
        }
        .search-icon {
            position: absolute; left: 1rem; top: 50%; transform: translateY(-50%);
            color: var(--muted); pointer-events: none;
        }
        .search-input {
            width: 100%; padding: 0.85rem 1rem 0.85rem 2.8rem;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px; color: var(--text);
            font-size: 0.95rem; font-family: 'Inter', sans-serif;
            outline: none; transition: border-color 0.2s, box-shadow 0.2s;
        }
        .search-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }
        .search-input::placeholder { color: var(--muted); }

        /* ─── MAIN LAYOUT ─── */
        .layout {
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: 0;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* ─── SIDEBAR ─── */
        .sidebar {
            padding: 2rem 1.5rem;
            border-right: 1px solid var(--border);
            position: sticky; top: 64px;
            height: calc(100vh - 64px); overflow-y: auto;
        }
        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-thumb { background: var(--subtle); border-radius: 4px; }

        .filter-section { margin-bottom: 2rem; }
        .filter-label {
            font-size: 0.7rem; font-weight: 700; letter-spacing: 1.5px;
            text-transform: uppercase; color: var(--muted);
            margin-bottom: 0.75rem; display: block;
        }

        .cat-list { list-style: none; display: flex; flex-direction: column; gap: 4px; }
        .cat-item a {
            display: flex; align-items: center; justify-content: space-between;
            padding: 0.6rem 0.75rem; border-radius: 8px;
            color: var(--muted); text-decoration: none; font-size: 0.875rem;
            transition: all 0.15s;
        }
        .cat-item a:hover { background: var(--bg-glass); color: var(--text); }
        .cat-item a.active { background: rgba(124,58,237,0.15); color: var(--accent2); font-weight: 600; }
        .cat-count {
            background: var(--bg-glass); border: 1px solid var(--border);
            color: var(--muted); font-size: 0.7rem; font-weight: 600;
            padding: 1px 6px; border-radius: 20px;
        }

        .toggle-row {
            display: flex; align-items: center; justify-content: space-between;
            padding: 0.5rem 0;
        }
        .toggle-label { font-size: 0.875rem; color: var(--text); }
        .toggle {
            position: relative; width: 40px; height: 22px;
        }
        .toggle input { opacity: 0; width: 0; height: 0; }
        .toggle-slider {
            position: absolute; inset: 0;
            background: var(--subtle); border-radius: 22px;
            cursor: pointer; transition: 0.2s;
        }
        .toggle-slider::before {
            content: ''; position: absolute;
            width: 16px; height: 16px; border-radius: 50%;
            left: 3px; top: 3px; background: #fff;
            transition: 0.2s;
        }
        .toggle input:checked + .toggle-slider { background: var(--accent); }
        .toggle input:checked + .toggle-slider::before { transform: translateX(18px); }

        /* Sort */
        .sort-select {
            width: 100%; padding: 0.6rem 0.75rem;
            background: var(--bg-card); border: 1px solid var(--border);
            border-radius: 8px; color: var(--text);
            font-size: 0.875rem; font-family: 'Inter', sans-serif;
            outline: none; cursor: pointer; appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 16px;
        }
        .sort-select:focus { border-color: var(--accent); }

        .apply-btn {
            width: 100%; padding: 0.75rem;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            border: none; border-radius: 10px;
            color: #fff; font-size: 0.9rem; font-weight: 600;
            font-family: 'Inter', sans-serif; cursor: pointer;
            transition: all 0.2s; margin-top: 0.5rem;
        }
        .apply-btn:hover { opacity: 0.9; transform: translateY(-1px); box-shadow: 0 8px 24px var(--accent-glow); }

        .clear-link {
            display: block; text-align: center;
            color: var(--muted); font-size: 0.8rem; text-decoration: none;
            margin-top: 0.75rem; transition: color 0.15s;
        }
        .clear-link:hover { color: var(--text); }

        /* ─── PRODUCT GRID ─── */
        .main { padding: 2rem; }

        .results-bar {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 1.5rem;
        }
        .results-count { font-size: 0.875rem; color: var(--muted); }
        .results-count strong { color: var(--text); }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            gap: 1.25rem;
        }

        /* ─── PRODUCT CARD ─── */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px; overflow: hidden;
            display: flex; flex-direction: column;
            transition: transform 0.2s, border-color 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }
        .card:hover {
            transform: translateY(-4px);
            border-color: rgba(124,58,237,0.4);
            box-shadow: 0 16px 48px rgba(0,0,0,0.4), 0 0 0 1px rgba(124,58,237,0.1);
        }
        .card-img {
            width: 100%; aspect-ratio: 4/3;
            background: linear-gradient(135deg, #1e1035, #13131a);
            display: flex; align-items: center; justify-content: center;
            font-size: 3rem; position: relative; overflow: hidden;
        }
        .card-img::after {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(to bottom, transparent 60%, rgba(0,0,0,0.4));
        }
        .card-badges {
            position: absolute; top: 0.75rem; left: 0.75rem;
            display: flex; flex-wrap: wrap; gap: 4px; z-index: 1;
        }
        .badge {
            font-size: 0.65rem; font-weight: 700; letter-spacing: 0.5px;
            text-transform: uppercase; padding: 2px 8px; border-radius: 20px;
        }
        .badge-low  { background: rgba(245,158,11,0.15); color: var(--amber); border: 1px solid rgba(245,158,11,0.3); }
        .badge-out  { background: rgba(239,68,68,0.15);  color: var(--red);   border: 1px solid rgba(239,68,68,0.3); }
        .badge-cat  { background: rgba(124,58,237,0.15); color: var(--accent2); border: 1px solid rgba(124,58,237,0.25); }

        .card-body { padding: 1rem; flex: 1; display: flex; flex-direction: column; gap: 0.4rem; }
        .card-cat  { font-size: 0.7rem; color: var(--accent2); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .card-name { font-size: 0.9rem; font-weight: 600; color: var(--text); line-height: 1.4; }
        .card-sku  { font-size: 0.7rem; color: var(--muted); font-family: monospace; }

        .card-footer {
            padding: 0.75rem 1rem 1rem;
            display: flex; align-items: center; justify-content: space-between;
            border-top: 1px solid var(--border);
        }
        .card-price { font-size: 1.1rem; font-weight: 700; color: var(--text); }
        .card-stock { font-size: 0.72rem; color: var(--muted); margin-top: 2px; }
        .stock-dot  { width: 6px; height: 6px; border-radius: 50%; display: inline-block; margin-right: 4px; }
        .stock-dot.in  { background: var(--green); box-shadow: 0 0 6px var(--green); }
        .stock-dot.out { background: var(--red); }
        .stock-dot.low { background: var(--amber); }

        .add-btn {
            background: var(--accent); border: none;
            color: #fff; padding: 0.45rem 1rem;
            border-radius: 8px; font-size: 0.8rem; font-weight: 600;
            font-family: 'Inter', sans-serif; cursor: pointer;
            transition: all 0.15s; white-space: nowrap;
        }
        .add-btn:hover { background: var(--accent2); transform: scale(1.04); }
        .add-btn:disabled { background: var(--subtle); color: var(--muted); cursor: not-allowed; transform: none; }

        /* ─── EMPTY STATE ─── */
        .empty {
            grid-column: 1/-1; text-align: center;
            padding: 5rem 2rem; color: var(--muted);
        }
        .empty-icon { font-size: 4rem; margin-bottom: 1rem; opacity: 0.4; }
        .empty h3   { font-size: 1.2rem; color: var(--text); margin-bottom: 0.5rem; }

        /* ─── PAGINATION ─── */
        .pagination { display: flex; justify-content: center; gap: 0.5rem; margin-top: 2.5rem; flex-wrap: wrap; }
        .page-btn {
            min-width: 38px; height: 38px; padding: 0 0.75rem;
            display: flex; align-items: center; justify-content: center;
            background: var(--bg-card); border: 1px solid var(--border);
            border-radius: 8px; color: var(--muted);
            text-decoration: none; font-size: 0.875rem; font-weight: 500;
            transition: all 0.15s;
        }
        .page-btn:hover  { border-color: var(--accent); color: var(--text); }
        .page-btn.active { background: var(--accent); border-color: var(--accent); color: #fff; }
        .page-btn.disabled { opacity: 0.3; pointer-events: none; }

        /* ─── CART DRAWER ─── */
        .drawer-overlay {
            position: fixed; inset: 0; background: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px); z-index: 200;
            opacity: 0; pointer-events: none; transition: opacity 0.25s;
        }
        .drawer-overlay.open { opacity: 1; pointer-events: all; }

        .drawer {
            position: fixed; top: 0; right: 0; bottom: 0;
            width: min(440px, 100vw);
            background: var(--bg-card);
            border-left: 1px solid var(--border);
            z-index: 201; display: flex; flex-direction: column;
            transform: translateX(100%); transition: transform 0.3s cubic-bezier(.4,0,.2,1);
        }
        .drawer.open { transform: translateX(0); }

        .drawer-head {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }
        .drawer-title { font-size: 1.1rem; font-weight: 700; }
        .close-btn {
            background: var(--bg-glass); border: 1px solid var(--border);
            color: var(--muted); width: 34px; height: 34px;
            border-radius: 8px; cursor: pointer; font-size: 1.1rem;
            display: flex; align-items: center; justify-content: center; transition: all 0.15s;
        }
        .close-btn:hover { color: var(--text); border-color: var(--text); }

        .drawer-body { flex: 1; overflow-y: auto; padding: 1.25rem; display: flex; flex-direction: column; gap: 0.75rem; }
        .drawer-body::-webkit-scrollbar { width: 4px; }
        .drawer-body::-webkit-scrollbar-thumb { background: var(--subtle); border-radius: 4px; }

        .cart-item {
            background: var(--bg-glass); border: 1px solid var(--border);
            border-radius: 12px; padding: 0.85rem;
            display: flex; align-items: center; gap: 0.85rem;
        }
        .cart-item-icon { font-size: 1.6rem; flex-shrink: 0; }
        .cart-item-info { flex: 1; min-width: 0; }
        .cart-item-name { font-size: 0.85rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .cart-item-price { font-size: 0.8rem; color: var(--muted); margin-top: 2px; }
        .qty-ctrl { display: flex; align-items: center; gap: 0.4rem; }
        .qty-btn {
            width: 26px; height: 26px; border-radius: 6px;
            background: var(--subtle); border: none;
            color: var(--text); font-size: 1rem; cursor: pointer;
            display: flex; align-items: center; justify-content: center; transition: background 0.15s;
        }
        .qty-btn:hover { background: var(--accent); }
        .qty-val { font-size: 0.875rem; font-weight: 600; min-width: 20px; text-align: center; }
        .remove-btn { background: none; border: none; color: var(--red); cursor: pointer; font-size: 1rem; padding: 4px; }

        .cart-empty { text-align: center; color: var(--muted); padding: 3rem; }

        .drawer-foot {
            padding: 1.25rem; border-top: 1px solid var(--border);
        }
        .order-summary { margin-bottom: 1rem; }
        .sum-row { display: flex; justify-content: space-between; font-size: 0.85rem; color: var(--muted); margin-bottom: 0.35rem; }
        .sum-row.total { color: var(--text); font-weight: 700; font-size: 1rem; border-top: 1px solid var(--border); padding-top: 0.5rem; margin-top: 0.5rem; }

        /* Order form */
        .order-form { display: flex; flex-direction: column; gap: 0.6rem; margin-top: 1rem; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 0.6rem; }
        .form-group { display: flex; flex-direction: column; gap: 4px; }
        .form-label { font-size: 0.7rem; color: var(--muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-input {
            padding: 0.55rem 0.75rem;
            background: var(--bg); border: 1px solid var(--border);
            border-radius: 8px; color: var(--text);
            font-size: 0.85rem; font-family: 'Inter', sans-serif; outline: none;
            transition: border-color 0.15s;
        }
        .form-input:focus { border-color: var(--accent); }
        .form-input::placeholder { color: var(--muted); }

        .place-btn {
            width: 100%; padding: 0.85rem;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            border: none; border-radius: 12px;
            color: #fff; font-size: 0.95rem; font-weight: 700;
            font-family: 'Inter', sans-serif; cursor: pointer;
            transition: all 0.2s; margin-top: 0.75rem;
        }
        .place-btn:hover { opacity: 0.9; transform: translateY(-1px); box-shadow: 0 8px 24px var(--accent-glow); }
        .place-btn:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }

        /* Toast */
        .toast-wrap { position: fixed; bottom: 1.5rem; right: 1.5rem; z-index: 300; display: flex; flex-direction: column; gap: 0.5rem; }
        .toast {
            min-width: 240px; padding: 0.85rem 1.25rem;
            border-radius: 12px; font-size: 0.875rem; font-weight: 500;
            display: flex; align-items: center; gap: 0.6rem;
            animation: slideIn 0.3s ease; box-shadow: 0 8px 32px rgba(0,0,0,0.4);
        }
        .toast.success { background: #14532d; border: 1px solid #22c55e44; color: #86efac; }
        .toast.error   { background: #450a0a; border: 1px solid #ef444444; color: #fca5a5; }
        @keyframes slideIn { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }

        /* Spinner */
        .spinner { width: 16px; height: 16px; border: 2px solid rgba(255,255,255,0.3); border-top-color: #fff; border-radius: 50%; animation: spin 0.6s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* Responsive */
        @media (max-width: 768px) {
            .layout { grid-template-columns: 1fr; }
            .sidebar { position: static; height: auto; border-right: none; border-bottom: 1px solid var(--border); }
        }
    </style>
</head>
<body>

<!-- NAV -->
<nav>
    <a href="{{ route('browse') }}" class="nav-logo" style="text-decoration:none">🛍 ShopNest</a>
    <div class="nav-actions">
        <a href="{{ route('cart.index') }}" class="cart-link-btn" title="Go to dedicated Cart & Checkout page">
            🛒 Cart <span class="cart-badge" id="cartCount">0</span>
        </a>
        <button class="quick-cart-btn" id="cartToggle" onclick="toggleDrawer()" title="Quick Cart Drawer">
            ⚡ Quick Drawer
        </button>

        @auth
            @if(Auth::user()->role === 'customer')
                <a href="{{ route('customer.dashboard') }}" class="nav-link">👤 My Orders</a>
            @elseif(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="nav-link">⚙️ Admin</a>
            @endif
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit" class="logout-link-btn">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="nav-link">Log in</a>
            <a href="{{ route('register') }}" class="cart-btn" style="padding:0.45rem 0.95rem;font-size:0.85rem;text-decoration:none">Register</a>
        @endauth
    </div>
</nav>

<!-- HERO -->
<div class="hero">
    <h1>Discover Premium Products</h1>
    <p>{{ $products->total() }} products across {{ $categories->count() }} categories</p>
    <form method="GET" action="{{ route('browse') }}" id="searchForm">
        <div class="search-wrap">
            <span class="search-icon">🔍</span>
            <input
                type="text" name="search"
                class="search-input"
                placeholder="Search by name, SKU or description…"
                value="{{ request('search') }}"
                id="searchInput"
                autocomplete="off"
            >
        </div>
        <!-- preserve other filters when searching -->
        @if(request('category_id'))<input type="hidden" name="category_id" value="{{ request('category_id') }}">@endif
        @if(request('in_stock'))<input type="hidden" name="in_stock" value="1">@endif
        @if(request('sort_by'))<input type="hidden" name="sort_by" value="{{ request('sort_by') }}">@endif
        @if(request('sort_dir'))<input type="hidden" name="sort_dir" value="{{ request('sort_dir') }}">@endif
    </form>
</div>

<!-- LAYOUT -->
<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <form method="GET" action="{{ route('browse') }}" id="filterForm">
            @if(request('search'))<input type="hidden" name="search" value="{{ request('search') }}">@endif

            <!-- Categories -->
            <div class="filter-section">
                <span class="filter-label">Categories</span>
                <ul class="cat-list">
                    <li class="cat-item">
                        <a href="{{ route('browse', array_filter(['search' => request('search'), 'in_stock' => request('in_stock'), 'sort_by' => request('sort_by'), 'sort_dir' => request('sort_dir')])) }}"
                           class="{{ !request('category_id') ? 'active' : '' }}">
                            All Products
                            <span class="cat-count">{{ $products->total() }}</span>
                        </a>
                    </li>
                    @foreach($categories as $cat)
                    <li class="cat-item">
                        <a href="{{ route('browse', array_filter(['search' => request('search'), 'category_id' => $cat->id, 'in_stock' => request('in_stock'), 'sort_by' => request('sort_by'), 'sort_dir' => request('sort_dir')])) }}"
                           class="{{ request('category_id') == $cat->id ? 'active' : '' }}">
                            {{ $cat->name }}
                            <span class="cat-count">{{ $cat->products_count }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
                @if(request('category_id'))<input type="hidden" name="category_id" value="{{ request('category_id') }}">@endif
            </div>

            <!-- In Stock toggle -->
            <div class="filter-section">
                <span class="filter-label">Availability</span>
                <div class="toggle-row">
                    <span class="toggle-label">In Stock Only</span>
                    <label class="toggle">
                        <input type="checkbox" name="in_stock" value="1" {{ request('in_stock') ? 'checked' : '' }} onchange="this.form.submit()">
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>

            <!-- Sort -->
            <div class="filter-section">
                <span class="filter-label">Sort By</span>
                <select name="sort_by" class="sort-select" style="margin-bottom:0.5rem" onchange="updateSortDir()">
                    <option value="name"       {{ request('sort_by','name') === 'name'       ? 'selected' : '' }}>Name</option>
                    <option value="price"      {{ request('sort_by') === 'price'             ? 'selected' : '' }}>Price</option>
                    <option value="created_at" {{ request('sort_by') === 'created_at'        ? 'selected' : '' }}>Newest First</option>
                </select>
                <select name="sort_dir" class="sort-select" id="sortDir">
                    <option value="asc"  {{ request('sort_dir','asc') === 'asc'  ? 'selected' : '' }}>↑ Ascending</option>
                    <option value="desc" {{ request('sort_dir') === 'desc' ? 'selected' : '' }}>↓ Descending</option>
                </select>
                <button type="submit" class="apply-btn" style="margin-top:0.75rem">Apply Sort</button>
            </div>

            @if(request()->anyFilled(['search','category_id','in_stock','sort_by']))
            <a href="{{ route('browse') }}" class="clear-link">✕ Clear all filters</a>
            @endif
        </form>
    </aside>

    <!-- PRODUCT GRID -->
    <main class="main">
        <div class="results-bar">
            <span class="results-count">
                Showing <strong>{{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }}</strong>
                of <strong>{{ $products->total() }}</strong> products
            </span>
        </div>

        <div class="product-grid">
            @forelse($products as $product)
            <div class="card" onclick="openProductQuickView({{ $product->id }})">
                <div class="card-img">
                    @php
                        $emojis = ['Electronics'=>'💻','Clothing'=>'👕','Books'=>'📚','Home & Kitchen'=>'🏠'];
                        $emoji = $emojis[$product->category->name] ?? '📦';
                    @endphp
                    {{ $emoji }}
                    <div class="card-badges">
                        @if(!$product->is_in_stock)
                            <span class="badge badge-out">Out of Stock</span>
                        @elseif($product->is_low_stock)
                            <span class="badge badge-low">Low Stock</span>
                        @endif
                        <span class="badge badge-cat">{{ $product->category->name }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-cat">{{ $product->category->name }}</div>
                    <div class="card-name">{{ $product->name }}</div>
                    <div class="card-sku">SKU: {{ $product->sku }}</div>
                </div>
                <div class="card-footer" onclick="event.stopPropagation()">
                    <div>
                        <div class="card-price">₹{{ number_format($product->price, 2) }}</div>
                        <div class="card-stock">
                            @if($product->is_in_stock)
                                <span class="stock-dot {{ $product->is_low_stock ? 'low' : 'in' }}"></span>
                                {{ $product->stock_quantity }} left
                            @else
                                <span class="stock-dot out"></span>Out of stock
                            @endif
                        </div>
                    </div>
                    <button
                        class="add-btn"
                        onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, '{{ $product->sku }}', '{{ $emoji }}')"
                        {{ !$product->is_in_stock ? 'disabled' : '' }}
                    >
                        {{ $product->is_in_stock ? '+ Add' : 'Sold Out' }}
                    </button>
                </div>
            </div>
            @empty
            <div class="empty">
                <div class="empty-icon">🔍</div>
                <h3>No products found</h3>
                <p>Try adjusting your search or filters.</p>
            </div>
            @endforelse
        </div>

        <!-- PAGINATION -->
        @if($products->hasPages())
        <div class="pagination">
            @if($products->onFirstPage())
                <span class="page-btn disabled">← Prev</span>
            @else
                <a href="{{ $products->previousPageUrl() }}" class="page-btn">← Prev</a>
            @endif

            @foreach ($products->getUrlRange(max(1, $products->currentPage()-2), min($products->lastPage(), $products->currentPage()+2)) as $page => $url)
                <a href="{{ $url }}" class="page-btn {{ $page == $products->currentPage() ? 'active' : '' }}">{{ $page }}</a>
            @endforeach

            @if($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}" class="page-btn">Next →</a>
            @else
                <span class="page-btn disabled">Next →</span>
            @endif
        </div>
        @endif
    </main>
</div>

<!-- CART DRAWER -->
<div class="drawer-overlay" id="overlay" onclick="toggleDrawer()"></div>
<div class="drawer" id="drawer">
    <div class="drawer-head">
        <span class="drawer-title">🛒 Your Cart</span>
        <button class="close-btn" onclick="toggleDrawer()">✕</button>
    </div>

    <div class="drawer-body" id="cartBody">
        <div class="cart-empty" id="cartEmpty">
            <div style="font-size:2.5rem;margin-bottom:.75rem">🛒</div>
            <p>Your cart is empty.<br>Add products to get started!</p>
        </div>
    </div>

    <div class="drawer-foot" id="drawerFoot" style="display:none">
        <a href="{{ route('cart.index') }}" class="view-cart-full-btn">
            Open Dedicated Cart & Checkout Page →
        </a>

        <div class="order-summary" id="orderSummary"></div>

        <!-- Order Form -->
        <div id="orderFormSection">
            <div style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:var(--muted);margin-bottom:0.75rem">
                Quick Checkout (Shipping Details)
            </div>
            <div class="order-form">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Full Name *</label>
                        <input class="form-input" id="f_name" placeholder="User Name" value="{{ Auth::user()->name ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <input class="form-input" id="f_phone" placeholder="+91 0000000000">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Email *</label>
                    <input class="form-input" id="f_email" type="email" placeholder="you@email.com" value="{{ Auth::user()->email ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Street *</label>
                    <input class="form-input" id="f_street" placeholder="123 MG Road" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">City *</label>
                        <input class="form-input" id="f_city" placeholder="Bangalore" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">State *</label>
                        <input class="form-input" id="f_state" placeholder="Karnataka" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Postal Code *</label>
                        <input class="form-input" id="f_postal" placeholder="560001" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Country *</label>
                        <input class="form-input" id="f_country" value="India" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Order Notes</label>
                    <input class="form-input" id="f_notes" placeholder="Deliver before 6 PM…">
                </div>
                <button class="place-btn" id="placeOrderBtn" onclick="placeOrder()">
                    Place Order
                </button>
            </div>
        </div>
    </div>
</div>

<!-- TOAST CONTAINER -->
<div class="toast-wrap" id="toastWrap"></div>

<script>
    const CART_KEY = 'shopnest_cart';

    // ─── Cart State (Synchronized with localStorage) ─────────────────────────
    function getStoredCart() {
        try {
            return JSON.parse(localStorage.getItem(CART_KEY) || '{}');
        } catch (e) {
            return {};
        }
    }

    let cart = getStoredCart();

    function saveCartState() {
        localStorage.setItem(CART_KEY, JSON.stringify(cart));
    }

    function addToCart(id, name, price, sku, emoji) {
        cart = getStoredCart();
        if (cart[id]) {
            cart[id].qty++;
        } else {
            cart[id] = { id, name, price, sku, emoji, qty: 1 };
        }
        saveCartState();
        renderCart();
        showToast('✅ ' + name + ' added to cart!', 'success');
    }

    function removeFromCart(id) {
        cart = getStoredCart();
        delete cart[id];
        saveCartState();
        renderCart();
    }

    function changeQty(id, delta) {
        cart = getStoredCart();
        if (!cart[id]) return;
        cart[id].qty += delta;
        if (cart[id].qty <= 0) { removeFromCart(id); return; }
        saveCartState();
        renderCart();
    }

    function renderCart() {
        const items = Object.values(cart);
        const count = items.reduce((s, i) => s + i.qty, 0);

        const countBadge = document.getElementById('cartCount');
        if (countBadge) countBadge.textContent = count;

        const body   = document.getElementById('cartBody');
        const empty  = document.getElementById('cartEmpty');
        const foot   = document.getElementById('drawerFoot');

        if (items.length === 0) {
            empty.style.display = 'block';
            foot.style.display  = 'none';
            // clear dynamic items
            [...body.querySelectorAll('.cart-item')].forEach(e => e.remove());
            return;
        }

        empty.style.display = 'none';
        foot.style.display  = 'block';

        // Rebuild items
        [...body.querySelectorAll('.cart-item')].forEach(e => e.remove());
        items.forEach(item => {
            const el = document.createElement('div');
            el.className = 'cart-item';
            el.innerHTML = `
                <div class="cart-item-icon">${item.emoji}</div>
                <div class="cart-item-info">
                    <div class="cart-item-name">${item.name}</div>
                    <div class="cart-item-price">₹${(item.price * item.qty).toLocaleString('en-IN', {minimumFractionDigits:2})}</div>
                </div>
                <div class="qty-ctrl">
                    <button class="qty-btn" onclick="changeQty(${item.id}, -1)">−</button>
                    <span class="qty-val">${item.qty}</span>
                    <button class="qty-btn" onclick="changeQty(${item.id}, +1)">+</button>
                </div>
                <button class="remove-btn" onclick="removeFromCart(${item.id})">🗑</button>
            `;
            body.appendChild(el);
        });

        // Pricing summary
        const subtotal = items.reduce((s, i) => s + i.price * i.qty, 0);
        const tax      = subtotal * 0.18;
        const shipping = subtotal >= 500 ? 0 : 49;
        const total    = subtotal + tax + shipping;

        document.getElementById('orderSummary').innerHTML = `
            <div class="sum-row"><span>Subtotal</span><span>₹${subtotal.toLocaleString('en-IN',{minimumFractionDigits:2})}</span></div>
            <div class="sum-row"><span>GST (18%)</span><span>₹${tax.toLocaleString('en-IN',{minimumFractionDigits:2})}</span></div>
            <div class="sum-row"><span>Shipping</span><span>${shipping === 0 ? '<span style="color:var(--green)">Free</span>' : '₹49'}</span></div>
            <div class="sum-row total"><span>Total</span><span>₹${total.toLocaleString('en-IN',{minimumFractionDigits:2})}</span></div>
        `;
    }

    // ─── Drawer ──────────────────────────────────────────────────────────────
    function toggleDrawer() {
        const drawer  = document.getElementById('drawer');
        const overlay = document.getElementById('overlay');
        drawer.classList.toggle('open');
        overlay.classList.toggle('open');
    }

    // ─── Place Order ─────────────────────────────────────────────────────────
    async function placeOrder() {
        cart = getStoredCart();
        const items = Object.values(cart);
        if (items.length === 0) { showToast('❌ Cart is empty!', 'error'); return; }

        const name    = document.getElementById('f_name').value.trim();
        const email   = document.getElementById('f_email').value.trim();
        const street  = document.getElementById('f_street').value.trim();
        const city    = document.getElementById('f_city').value.trim();
        const state   = document.getElementById('f_state').value.trim();
        const postal  = document.getElementById('f_postal').value.trim();
        const country = document.getElementById('f_country').value.trim();

        if (!name || !email || !street || !city || !state || !postal || !country) {
            showToast('❌ Please fill all required fields.', 'error'); return;
        }

        const btn = document.getElementById('placeOrderBtn');
        btn.disabled = true;
        btn.innerHTML = '<div class="spinner" style="margin:0 auto"></div>';

        const payload = {
            customer_name:    name,
            customer_email:   email,
            customer_phone:   document.getElementById('f_phone').value.trim() || null,
            notes:            document.getElementById('f_notes').value.trim() || null,
            shipping_address: { street, city, state, postal_code: postal, country },
            items: items.map(i => ({ product_id: i.id, quantity: i.qty })),
        };

        try {
            const res = await fetch('/api/orders', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload),
            });
            const data = await res.json();

            if (res.ok && data.success) {
                cart = {};
                localStorage.removeItem(CART_KEY);
                renderCart();
                toggleDrawer();
                showToast(`🎉 Order ${data.data.order_number} placed successfully!`, 'success');
                // Clear form
                ['f_name','f_email','f_phone','f_street','f_city','f_state','f_postal','f_notes'].forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.value = id === 'f_country' ? 'India' : '';
                });
            } else {
                let msg = data.message || 'Order failed. Please try again.';
                if (data.errors) {
                    const firstErr = Object.values(data.errors)[0];
                    msg = Array.isArray(firstErr) ? firstErr[0] : firstErr;
                }
                showToast('❌ ' + msg, 'error');
            }
        } catch (e) {
            showToast('❌ Network error. Please check connection.', 'error');
        } finally {
            btn.disabled = false;
            btn.textContent = 'Place Order';
        }
    }

    // ─── Toast ───────────────────────────────────────────────────────────────
    function showToast(msg, type = 'success') {
        const wrap = document.getElementById('toastWrap');
        const t = document.createElement('div');
        t.className = `toast ${type}`;
        t.textContent = msg;
        wrap.appendChild(t);
        setTimeout(() => { t.style.opacity = '0'; t.style.transition = 'opacity 0.3s'; setTimeout(() => t.remove(), 300); }, 3500);
    }

    // ─── Search on Enter ─────────────────────────────────────────────────────
    document.getElementById('searchInput').addEventListener('keydown', e => {
        if (e.key === 'Enter') document.getElementById('searchForm').submit();
    });

    function updateSortDir() { /* auto, handled by select onchange form submit */ }

    // Initial render and cross-tab sync
    document.addEventListener('DOMContentLoaded', () => {
        cart = getStoredCart();
        renderCart();
    });

    window.addEventListener('storage', (e) => {
        if (e.key === CART_KEY) {
            cart = getStoredCart();
            renderCart();
        }
    });
</script>
</body>
</html>
