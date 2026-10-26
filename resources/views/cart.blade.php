<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Review your cart and submit orders with instant confirmation on ShopNest.">
    <title>Shopping Cart & Checkout — ShopNest</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:          #0a0a0f;
            --bg-card:     #13131a;
            --bg-glass:    rgba(255,255,255,0.04);
            --border:      rgba(255,255,255,0.08);
            --border-glow: rgba(168,85,247,0.3);
            --accent:      #7c3aed;
            --accent2:     #a855f7;
            --accent-glow: rgba(124,58,237,0.35);
            --green:       #22c55e;
            --green-glow:  rgba(34,197,94,0.25);
            --red:         #ef4444;
            --amber:       #f59e0b;
            --text:        #f1f5f9;
            --muted:       #94a3b8;
            --subtle:      #1e293b;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            line-height: 1.5;
        }

        /* ─── NAV ─── */
        nav {
            position: sticky; top: 0; z-index: 100;
            background: rgba(10,10,15,0.88);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            display: flex; align-items: center; justify-content: space-between;
            height: 64px;
        }
        .nav-logo {
            font-size: 1.35rem; font-weight: 800;
            background: linear-gradient(135deg, #fff 20%, #a855f7 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            text-decoration: none;
            letter-spacing: -0.5px;
            display: flex; align-items: center; gap: 0.5rem;
        }
        .nav-actions { display: flex; align-items: center; gap: 0.85rem; }
        .nav-link {
            color: var(--muted); text-decoration: none;
            font-size: 0.85rem; font-weight: 500;
            padding: 0.45rem 0.85rem; border-radius: 8px;
            transition: all 0.15s;
        }
        .nav-link:hover { color: var(--text); background: var(--bg-glass); }
        .nav-badge-pill {
            background: rgba(124,58,237,0.18);
            border: 1px solid rgba(168,85,247,0.3);
            color: var(--accent2);
            font-size: 0.75rem; font-weight: 700;
            padding: 0.35rem 0.75rem; border-radius: 20px;
            display: inline-flex; align-items: center; gap: 0.4rem;
        }
        .nav-btn {
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            color: #fff; text-decoration: none; border: none;
            padding: 0.45rem 1rem; border-radius: 8px;
            font-size: 0.85rem; font-weight: 600; cursor: pointer;
            transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.4rem;
        }
        .nav-btn:hover { opacity: 0.9; transform: translateY(-1px); box-shadow: 0 4px 16px var(--accent-glow); }

        /* ─── PAGE HEADER / BREADCRUMB ─── */
        .cart-header {
            background: linear-gradient(180deg, rgba(124,58,237,0.12) 0%, rgba(10,10,15,0) 100%);
            border-bottom: 1px solid var(--border);
            padding: 2.2rem 2rem 1.8rem;
        }
        .cart-header-inner {
            max-width: 1280px; margin: 0 auto;
            display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;
        }
        .cart-title-wrap h1 {
            font-size: 1.85rem; font-weight: 800; letter-spacing: -0.5px;
            background: linear-gradient(135deg, #fff 40%, #c084fc 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .cart-title-wrap p { color: var(--muted); font-size: 0.9rem; margin-top: 0.25rem; }

        /* Progress Steps */
        .steps {
            display: flex; align-items: center; gap: 0.5rem;
            background: var(--bg-card); border: 1px solid var(--border);
            padding: 0.4rem 0.8rem; border-radius: 30px;
        }
        .step {
            display: flex; align-items: center; gap: 0.4rem;
            font-size: 0.78rem; font-weight: 600; color: var(--muted);
            padding: 0.25rem 0.5rem; border-radius: 20px;
        }
        .step.active {
            color: #fff; background: rgba(124,58,237,0.25);
            border: 1px solid rgba(168,85,247,0.4);
        }
        .step-num {
            width: 18px; height: 18px; border-radius: 50%;
            background: var(--subtle); color: var(--text);
            font-size: 0.7rem; display: inline-flex; align-items: center; justify-content: center;
        }
        .step.active .step-num { background: var(--accent); color: #fff; }
        .step-sep { color: var(--muted); opacity: 0.4; font-size: 0.75rem; }

        /* ─── MAIN CONTAINER ─── */
        .main-container {
            max-width: 1280px; width: 100%; margin: 2rem auto;
            padding: 0 1.5rem; flex: 1;
        }

        /* ─── TWO-COLUMN CART GRID ─── */
        .cart-grid {
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 2rem;
            align-items: start;
        }

        /* ─── LEFT COLUMN: ITEMS ─── */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }
        .card-head {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex; justify-content: space-between; align-items: center;
        }
        .card-title {
            font-size: 1.1rem; font-weight: 700;
            display: flex; align-items: center; gap: 0.5rem;
        }
        .clear-cart-btn {
            background: transparent; border: none;
            color: var(--muted); font-size: 0.8rem; font-weight: 600;
            cursor: pointer; transition: color 0.15s;
            display: flex; align-items: center; gap: 0.3rem;
        }
        .clear-cart-btn:hover { color: var(--red); }

        .item-list { divide-y: 1px solid var(--border); }
        .cart-item-row {
            padding: 1.25rem 1.5rem;
            display: grid;
            grid-template-columns: 60px 1fr auto auto 40px;
            gap: 1.2rem;
            align-items: center;
            border-bottom: 1px solid var(--border);
            transition: background 0.15s;
        }
        .cart-item-row:last-child { border-bottom: none; }
        .cart-item-row:hover { background: rgba(255,255,255,0.015); }

        .item-visual {
            width: 60px; height: 60px; border-radius: 12px;
            background: linear-gradient(135deg, rgba(124,58,237,0.2), rgba(168,85,247,0.05));
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.8rem; flex-shrink: 0;
        }
        .item-details { min-width: 0; }
        .item-title {
            font-size: 0.95rem; font-weight: 600; color: var(--text);
            margin-bottom: 0.25rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .item-meta {
            display: flex; align-items: center; gap: 0.6rem;
            font-size: 0.78rem; color: var(--muted);
        }
        .item-sku {
            font-family: monospace; background: var(--bg-glass);
            padding: 2px 6px; border-radius: 4px; border: 1px solid var(--border);
        }
        .item-unit-price { color: var(--accent2); font-weight: 600; }

        /* Quantity Stepper */
        .qty-control {
            display: inline-flex; align-items: center;
            background: var(--bg); border: 1px solid var(--border);
            border-radius: 10px; overflow: hidden;
        }
        .qty-btn {
            width: 32px; height: 32px;
            background: transparent; border: none;
            color: var(--text); font-size: 1rem; font-weight: 700;
            cursor: pointer; transition: background 0.15s, color 0.15s;
            display: flex; align-items: center; justify-content: center;
        }
        .qty-btn:hover { background: var(--subtle); color: var(--accent2); }
        .qty-display {
            width: 38px; height: 32px;
            text-align: center; border: none; background: transparent;
            color: var(--text); font-weight: 700; font-size: 0.9rem;
            font-family: 'Inter', sans-serif; outline: none;
        }

        /* Line Total */
        .line-total {
            font-size: 1.05rem; font-weight: 700; color: var(--text);
            text-align: right; min-width: 90px;
        }

        /* Remove Action */
        .item-remove {
            background: transparent; border: none;
            color: var(--muted); font-size: 1.1rem;
            cursor: pointer; padding: 6px; border-radius: 8px;
            transition: all 0.15s; display: flex; align-items: center; justify-content: center;
        }
        .item-remove:hover { color: var(--red); background: rgba(239,68,68,0.1); }

        /* Trust Badges Bar */
        .trust-grid {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;
            margin-top: 1.5rem;
        }
        .trust-card {
            background: var(--bg-card); border: 1px solid var(--border);
            border-radius: 12px; padding: 1rem;
            display: flex; align-items: center; gap: 0.75rem;
        }
        .trust-icon { font-size: 1.4rem; }
        .trust-text h4 { font-size: 0.8rem; font-weight: 700; color: var(--text); }
        .trust-text p { font-size: 0.72rem; color: var(--muted); margin-top: 2px; }

        /* ─── RIGHT COLUMN: SUMMARY & CHECKOUT FORM ─── */
        .checkout-sidebar {
            position: sticky; top: 84px;
            display: flex; flex-direction: column; gap: 1.5rem;
        }

        /* Free Shipping Alert Bar */
        .shipping-progress-box {
            background: rgba(124,58,237,0.1);
            border: 1px solid rgba(168,85,247,0.25);
            border-radius: 12px; padding: 0.9rem 1.1rem;
        }
        .shipping-progress-title {
            font-size: 0.8rem; font-weight: 600;
            display: flex; justify-content: space-between; margin-bottom: 0.4rem;
        }
        .shipping-progress-bar {
            width: 100%; height: 6px; background: var(--subtle);
            border-radius: 4px; overflow: hidden;
        }
        .shipping-progress-fill {
            height: 100%; background: linear-gradient(90deg, var(--accent), var(--green));
            transition: width 0.3s ease;
        }

        /* Order Summary Lines */
        .summary-body { padding: 1.25rem 1.5rem; }
        .summary-row {
            display: flex; justify-content: space-between; align-items: center;
            font-size: 0.875rem; color: var(--muted); margin-bottom: 0.65rem;
        }
        .summary-row.total-row {
            border-top: 1px solid var(--border);
            padding-top: 1rem; margin-top: 0.75rem; margin-bottom: 0;
            font-size: 1.15rem; font-weight: 800; color: var(--text);
        }
        .total-amount {
            background: linear-gradient(135deg, #fff 30%, #a855f7 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            font-size: 1.35rem; font-weight: 800;
        }

        /* Form Inputs */
        .form-section {
            padding: 1.25rem 1.5rem;
            border-top: 1px solid var(--border);
        }
        .form-section-title {
            font-size: 0.78rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 1px; color: var(--muted);
            margin-bottom: 1rem; display: flex; align-items: center; gap: 0.4rem;
        }
        .user-auth-badge {
            background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.25);
            color: #86efac; border-radius: 8px; padding: 0.6rem 0.85rem;
            font-size: 0.8rem; margin-bottom: 1rem;
            display: flex; align-items: center; justify-content: space-between;
        }
        .user-auth-badge a { color: #86efac; font-weight: 700; text-decoration: underline; }

        .guest-auth-hint {
            background: rgba(124,58,237,0.1); border: 1px solid rgba(168,85,247,0.2);
            border-radius: 8px; padding: 0.6rem 0.85rem;
            font-size: 0.8rem; color: var(--muted); margin-bottom: 1rem;
        }
        .guest-auth-hint a { color: var(--accent2); font-weight: 600; text-decoration: none; }
        .guest-auth-hint a:hover { text-decoration: underline; }

        .form-grid { display: flex; flex-direction: column; gap: 0.75rem; }
        .form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; }
        .form-field { display: flex; flex-direction: column; gap: 0.3rem; }
        .form-field label {
            font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;
            color: var(--muted);
        }
        .form-field input, .form-field textarea {
            width: 100%; padding: 0.65rem 0.85rem;
            background: var(--bg); border: 1px solid var(--border);
            border-radius: 10px; color: var(--text);
            font-size: 0.875rem; font-family: 'Inter', sans-serif;
            outline: none; transition: border-color 0.15s, box-shadow 0.15s;
        }
        .form-field input:focus, .form-field textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }
        .form-field input::placeholder, .form-field textarea::placeholder { color: #475569; }
        .form-field input.has-error {
            border-color: var(--red) !important;
            box-shadow: 0 0 0 2px rgba(239,68,68,0.25) !important;
        }

        /* Order Submit Button */
        .submit-btn {
            width: 100%; padding: 0.95rem;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent2) 100%);
            border: none; border-radius: 12px;
            color: #fff; font-size: 1rem; font-weight: 700;
            font-family: 'Inter', sans-serif; cursor: pointer;
            transition: all 0.2s; margin-top: 1rem;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            box-shadow: 0 4px 20px var(--accent-glow);
        }
        .submit-btn:hover {
            opacity: 0.95; transform: translateY(-1px);
            box-shadow: 0 8px 28px rgba(168,85,247,0.45);
        }
        .submit-btn:disabled {
            opacity: 0.5; cursor: not-allowed; transform: none; box-shadow: none;
        }

        /* ─── EMPTY STATE ─── */
        .empty-cart-state {
            display: none;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            text-align: center;
            padding: 4.5rem 2rem;
            max-width: 650px;
            margin: 2rem auto;
            box-shadow: 0 12px 40px rgba(0,0,0,0.4);
            position: relative; overflow: hidden;
        }
        .empty-cart-state::before {
            content: ''; position: absolute; top: -50px; left: 50%; transform: translateX(-50%);
            width: 300px; height: 150px;
            background: radial-gradient(ellipse, rgba(124,58,237,0.25), transparent 70%);
            pointer-events: none;
        }
        .empty-cart-icon {
            font-size: 4rem; margin-bottom: 1rem;
            display: inline-block; animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        .empty-cart-title { font-size: 1.5rem; font-weight: 800; margin-bottom: 0.5rem; }
        .empty-cart-desc { color: var(--muted); font-size: 0.95rem; max-width: 420px; margin: 0 auto 1.8rem; }

        /* ─── SUCCESS OVERLAY / RECEIPT MODAL ─── */
        .order-success-modal {
            display: none;
            position: fixed; inset: 0; z-index: 200;
            background: rgba(10,10,15,0.85);
            backdrop-filter: blur(12px);
            align-items: center; justify-content: center;
            padding: 1.5rem;
            animation: fadeIn 0.25s ease;
        }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .success-box {
            background: var(--bg-card);
            border: 1px solid rgba(168,85,247,0.4);
            box-shadow: 0 16px 48px rgba(0,0,0,0.6), 0 0 0 1px var(--border);
            border-radius: 20px;
            max-width: 580px; width: 100%;
            overflow: hidden;
            animation: scaleUp 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes scaleUp { from { transform: scale(0.95); opacity: 0; } to { transform: scale(1); opacity: 1; } }

        .success-head {
            background: linear-gradient(135deg, rgba(34,197,94,0.15) 0%, rgba(124,58,237,0.15) 100%);
            border-bottom: 1px solid var(--border);
            padding: 2.2rem 2rem 1.8rem; text-align: center;
        }
        .success-badge-icon {
            width: 64px; height: 64px; border-radius: 50%;
            background: linear-gradient(135deg, var(--green), #16a34a);
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 2rem; color: #fff; margin-bottom: 1rem;
            box-shadow: 0 8px 24px var(--green-glow);
        }
        .success-head h2 { font-size: 1.5rem; font-weight: 800; letter-spacing: -0.5px; }
        .order-tag {
            display: inline-block;
            font-family: monospace; font-size: 0.95rem; font-weight: 700;
            color: var(--accent2); background: rgba(168,85,247,0.15);
            border: 1px solid rgba(168,85,247,0.3);
            padding: 4px 12px; border-radius: 20px; margin-top: 0.5rem;
        }
        .success-body { padding: 1.5rem 2rem; }
        .success-summary {
            background: var(--bg); border: 1px solid var(--border);
            border-radius: 12px; padding: 1rem 1.25rem; margin-bottom: 1.25rem;
        }
        .success-actions { display: flex; gap: 0.75rem; flex-wrap: wrap; }
        .btn-primary {
            flex: 1; padding: 0.8rem; border-radius: 10px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            color: #fff; font-weight: 700; font-size: 0.875rem; text-align: center;
            text-decoration: none; border: none; cursor: pointer; transition: all 0.2s;
        }
        .btn-primary:hover { opacity: 0.9; }
        .btn-secondary {
            flex: 1; padding: 0.8rem; border-radius: 10px;
            background: var(--subtle); border: 1px solid var(--border);
            color: var(--text); font-weight: 600; font-size: 0.875rem; text-align: center;
            text-decoration: none; cursor: pointer; transition: all 0.2s;
        }
        .btn-secondary:hover { background: var(--bg-glass); }

        /* Toast Notifications */
        .toast-wrap {
            position: fixed; bottom: 1.5rem; right: 1.5rem; z-index: 300;
            display: flex; flex-direction: column; gap: 0.5rem; pointer-events: none;
        }
        .toast {
            min-width: 260px; padding: 0.85rem 1.25rem; border-radius: 12px;
            font-size: 0.875rem; font-weight: 600;
            display: flex; align-items: center; gap: 0.6rem; pointer-events: auto;
            box-shadow: 0 8px 32px rgba(0,0,0,0.5);
            animation: toastIn 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .toast.success { background: #0f351e; border: 1px solid #22c55e55; color: #86efac; }
        .toast.error   { background: #3b0d0d; border: 1px solid #ef444455; color: #fca5a5; }
        @keyframes toastIn { from { opacity: 0; transform: translateY(12px) scale(0.95); } to { opacity: 1; transform: translateY(0) scale(1); } }

        /* Spinner */
        .spinner {
            width: 18px; height: 18px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: #fff; border-radius: 50%;
            animation: spin 0.6s linear infinite; display: inline-block;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* Responsive */
        @media (max-width: 960px) {
            .cart-grid { grid-template-columns: 1fr; }
            .checkout-sidebar { position: static; }
            .trust-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 640px) {
            .cart-item-row {
                grid-template-columns: 50px 1fr 32px;
                grid-template-areas:
                    "visual info remove"
                    "visual qty total";
                gap: 0.75rem;
            }
            .item-visual { grid-area: visual; width: 50px; height: 50px; font-size: 1.5rem; }
            .item-details { grid-area: info; }
            .item-remove { grid-area: remove; }
            .qty-control { grid-area: qty; }
            .line-total { grid-area: total; text-align: right; }
            .form-row-2 { grid-template-columns: 1fr; }
            nav { padding: 0 1rem; }
            .cart-header { padding: 1.5rem 1rem; }
        }
    </style>
</head>
<body>

<!-- NAVIGATION -->
<nav>
    <a href="{{ route('browse') }}" class="nav-logo">
        🛍 ShopNest
    </a>
    <div class="nav-actions">
        <a href="{{ route('browse') }}" class="nav-link">
            🔍 Browse Products
        </a>
        <div class="nav-badge-pill" id="navBadge">
            🛒 <span id="navCartCount">0</span> Items
        </div>

        @auth
            @if(Auth::user()->role === 'customer')
                <a href="{{ route('customer.dashboard') }}" class="nav-link">
                    👤 My Dashboard
                </a>
            @elseif(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    ⚙️ Admin Panel
                </a>
            @endif

            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit" class="nav-link" style="background:none;border:none;cursor:pointer">
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="nav-link">Log in</a>
            <a href="{{ route('register') }}" class="nav-btn">Register</a>
        @endauth
    </div>
</nav>

<!-- PAGE HEADER -->
<div class="cart-header">
    <div class="cart-header-inner">
        <div class="cart-title-wrap">
            <h1>Review Cart & Checkout</h1>
            <p id="cartSubtitle">Review your selected items and provide delivery details below.</p>
        </div>
        <div class="steps">
            <div class="step active">
                <span class="step-num">1</span> Cart Review
            </div>
            <span class="step-sep">›</span>
            <div class="step active">
                <span class="step-num">2</span> Shipping
            </div>
            <span class="step-sep">›</span>
            <div class="step">
                <span class="step-num">3</span> Confirmation
            </div>
        </div>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="main-container">

    <!-- EMPTY CART STATE -->
    <div class="empty-cart-state" id="emptyCartState">
        <div class="empty-cart-icon">🛒</div>
        <h2 class="empty-cart-title">Your Cart is Empty</h2>
        <p class="empty-cart-desc">
            You haven't added any products to your cart yet. Explore our curated catalogue to discover electronics, books, apparel, and more!
        </p>
        <a href="{{ route('browse') }}" class="nav-btn" style="padding:0.85rem 2rem;font-size:0.95rem">
            Explore Catalogue Now →
        </a>
    </div>

    <!-- CART & CHECKOUT FORM GRID -->
    <div class="cart-grid" id="cartGrid">

        <!-- LEFT COLUMN: CART ITEMS -->
        <div>
            <div class="card">
                <div class="card-head">
                    <div class="card-title">
                        <span>Items in Your Order</span>
                        <span class="nav-badge-pill" id="itemCountBadge">0 Items</span>
                    </div>
                    <button class="clear-cart-btn" onclick="clearCart()">
                        🗑 Clear All
                    </button>
                </div>

                <!-- DYNAMIC ITEMS LIST -->
                <div class="item-list" id="cartItemList">
                    <!-- Javascript populates items here -->
                </div>
            </div>

            <!-- TRUST BADGES -->
            <div class="trust-grid">
                <div class="trust-card">
                    <span class="trust-icon">⚡</span>
                    <div class="trust-text">
                        <h4>Free Express Shipping</h4>
                        <p>On orders above ₹500 across India</p>
                    </div>
                </div>
                <div class="trust-card">
                    <span class="trust-icon">🔒</span>
                    <div class="trust-text">
                        <h4>Secure Checkout</h4>
                        <p>256-bit encrypted transactions</p>
                    </div>
                </div>
                <div class="trust-card">
                    <span class="trust-icon">🔄</span>
                    <div class="trust-text">
                        <h4>Instant Confirmation</h4>
                        <p>Real-time order stock reservation</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: ORDER SUMMARY & SHIPPING DETAILS -->
        <div class="checkout-sidebar">

            <!-- FREE SHIPPING PROGRESS -->
            <div class="shipping-progress-box" id="shippingProgressBox">
                <div class="shipping-progress-title">
                    <span id="shippingProgressText">⚡ Add ₹500 for FREE Shipping</span>
                    <span id="shippingProgressPercent" style="color:var(--accent2)">0%</span>
                </div>
                <div class="shipping-progress-bar">
                    <div class="shipping-progress-fill" id="shippingProgressFill" style="width: 0%"></div>
                </div>
            </div>

            <!-- SUMMARY & CHECKOUT FORM CARD -->
            <div class="card">
                <div class="card-head">
                    <div class="card-title">
                        <span>Order Summary</span>
                    </div>
                </div>

                <div class="summary-body">
                    <div class="summary-row">
                        <span>Subtotal (<span id="summaryItemCount">0</span> items)</span>
                        <span id="summarySubtotal">₹0.00</span>
                    </div>
                    <div class="summary-row">
                        <span>GST (18%)</span>
                        <span id="summaryTax">₹0.00</span>
                    </div>
                    <div class="summary-row">
                        <span>Delivery Fee</span>
                        <span id="summaryShipping">₹49.00</span>
                    </div>
                    <div class="summary-row total-row">
                        <span>Total Payable</span>
                        <span class="total-amount" id="summaryTotal">₹0.00</span>
                    </div>
                </div>

                <!-- SHIPPING FORM -->
                <div class="form-section">
                    <div class="form-section-title">
                        📍 Shipping & Contact Details
                    </div>

                    @auth
                        <div class="user-auth-badge">
                            <div>
                                👤 Logged in as <strong>{{ Auth::user()->name }}</strong>
                            </div>
                            <span style="font-size:0.75rem;opacity:0.8">Linked to account</span>
                        </div>
                    @else
                        <div class="guest-auth-hint">
                            Have an account? <a href="{{ route('login') }}">Log in</a> to track orders easily in your dashboard.
                        </div>
                    @endauth

                    <form id="orderForm" onsubmit="event.preventDefault(); submitOrder();">
                        <div class="form-grid">
                            <div class="form-row-2">
                                <div class="form-field">
                                    <label for="c_name">Full Name *</label>
                                    <input
                                        type="text"
                                        id="c_name"
                                        placeholder="Full name"
                                        value="{{ Auth::user()->name ?? '' }}"
                                        required
                                    >
                                </div>
                                <div class="form-field">
                                    <label for="c_phone">Phone Number</label>
                                    <input
                                        type="tel"
                                        id="c_phone"
                                        placeholder="+91 9876543210"
                                    >
                                </div>
                            </div>

                            <div class="form-field">
                                <label for="c_email">Email Address *</label>
                                <input
                                    type="email"
                                    id="c_email"
                                    placeholder="you@email.com"
                                    value="{{ Auth::user()->email ?? '' }}"
                                    required
                                >
                            </div>

                            <div class="form-field">
                                <label for="c_street">Street Address *</label>
                                <input
                                    type="text"
                                    id="c_street"
                                    placeholder="House/Flat number, Street, Landmark"
                                    required
                                >
                            </div>

                            <div class="form-row-2">
                                <div class="form-field">
                                    <label for="c_city">City *</label>
                                    <input
                                        type="text"
                                        id="c_city"
                                        placeholder="City"
                                        required
                                    >
                                </div>
                                <div class="form-field">
                                    <label for="c_state">State *</label>
                                    <input
                                        type="text"
                                        id="c_state"
                                        placeholder="State"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="form-row-2">
                                <div class="form-field">
                                    <label for="c_postal">Postal Code (PIN) *</label>
                                    <input
                                        type="text"
                                        id="c_postal"
                                        placeholder="e.g. 560001"
                                        required
                                    >
                                </div>
                                <div class="form-field">
                                    <label for="c_country">Country *</label>
                                    <input
                                        type="text"
                                        id="c_country"
                                        value="India"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="form-field">
                                <label for="c_notes">Delivery Notes (Optional)</label>
                                <input
                                    type="text"
                                    id="c_notes"
                                    placeholder="e.g. Leave package with neighbor, call on arrival"
                                >
                            </div>

                            <button type="submit" class="submit-btn" id="submitOrderBtn">
                                <span>🔒 Submit Order</span>
                                <span id="btnTotalBadge"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SUCCESS CONFIRMATION MODAL -->
<div class="order-success-modal" id="successModal">
    <div class="success-box">
        <div class="success-head">
            <div class="success-badge-icon">✓</div>
            <h2>Order Placed Successfully!</h2>
            <p style="color:var(--muted);font-size:0.875rem;margin-top:0.25rem">
                Thank you for your purchase. We have received your order!
            </p>
            <div class="order-tag" id="confirmedOrderNum">ORD-XXXXXXXX</div>
        </div>

        <div class="success-body">
            <div class="success-summary">
                <div class="summary-row">
                    <span>Customer</span>
                    <strong id="confirmedCustomer" style="color:var(--text)"></strong>
                </div>
                <div class="summary-row">
                    <span>Email</span>
                    <span id="confirmedEmail"></span>
                </div>
                <div class="summary-row">
                    <span>Delivery Address</span>
                    <span id="confirmedAddress" style="text-align:right;max-width:260px"></span>
                </div>
                <div class="summary-row total-row">
                    <span>Total Paid</span>
                    <span class="total-amount" id="confirmedTotal"></span>
                </div>
            </div>

            <div class="success-actions">
                @auth
                    @if(Auth::user()->role === 'customer')
                        <a href="{{ route('customer.dashboard') }}" class="btn-primary">
                            📊 View in My Orders
                        </a>
                    @else
                        <a href="{{ route('browse') }}" class="btn-primary">
                            🛍 Continue Shopping
                        </a>
                    @endif
                @else
                    <a href="{{ route('browse') }}" class="btn-primary">
                        🛍 Continue Shopping
                    </a>
                @endauth
                <a href="#" id="receiptLink" class="btn-secondary">
                    📄 View Full Receipt
                </a>
            </div>
        </div>
    </div>
</div>

<!-- FLOATING TOASTS CONTAINER -->
<div class="toast-wrap" id="toastContainer"></div>

<script>
    const CART_KEY = 'shopnest_cart';

    // ── Load Cart from LocalStorage ──────────────────────────────────────────
    function getCart() {
        try {
            return JSON.parse(localStorage.getItem(CART_KEY) || '{}');
        } catch (e) {
            return {};
        }
    }

    function saveCart(cart) {
        localStorage.setItem(CART_KEY, JSON.stringify(cart));
    }

    // ── Cart Operations ──────────────────────────────────────────────────────
    function updateQty(id, delta) {
        const cart = getCart();
        if (!cart[id]) return;

        cart[id].qty += delta;
        if (cart[id].qty <= 0) {
            delete cart[id];
            showToast('🗑 Item removed from cart', 'success');
        }
        saveCart(cart);
        renderPage();
    }

    function setQtyDirect(id, value) {
        const cart = getCart();
        if (!cart[id]) return;

        let qty = parseInt(value, 10);
        if (isNaN(qty) || qty < 1) qty = 1;
        if (qty > 100) qty = 100;

        cart[id].qty = qty;
        saveCart(cart);
        renderPage();
    }

    function removeItem(id) {
        const cart = getCart();
        if (cart[id]) {
            const name = cart[id].name;
            delete cart[id];
            saveCart(cart);
            renderPage();
            showToast(`🗑 Removed "${name}" from cart`, 'success');
        }
    }

    function clearCart() {
        if (!confirm('Are you sure you want to clear your entire cart?')) return;
        localStorage.removeItem(CART_KEY);
        renderPage();
        showToast('Cart cleared', 'success');
    }

    // ── Render Cart Page ─────────────────────────────────────────────────────
    function renderPage() {
        const cart = getCart();
        const items = Object.values(cart);
        const totalCount = items.reduce((sum, item) => sum + item.qty, 0);

        // Update Nav & Badges
        document.getElementById('navCartCount').textContent = totalCount;
        document.getElementById('itemCountBadge').textContent = `${totalCount} ${totalCount === 1 ? 'Item' : 'Items'}`;
        document.getElementById('summaryItemCount').textContent = totalCount;

        const emptyState = document.getElementById('emptyCartState');
        const cartGrid   = document.getElementById('cartGrid');
        const listEl     = document.getElementById('cartItemList');

        if (items.length === 0) {
            emptyState.style.display = 'block';
            cartGrid.style.display   = 'none';
            return;
        }

        emptyState.style.display = 'none';
        cartGrid.style.display   = 'grid';

        // Rebuild items list
        listEl.innerHTML = '';
        items.forEach(item => {
            const row = document.createElement('div');
            row.className = 'cart-item-row';
            const lineTotal = item.price * item.qty;

            row.innerHTML = `
                <div class="item-visual">${item.emoji || '📦'}</div>
                <div class="item-details">
                    <div class="item-title" title="${escapeHtml(item.name)}">${escapeHtml(item.name)}</div>
                    <div class="item-meta">
                        <span class="item-sku">SKU: ${escapeHtml(item.sku || 'N/A')}</span>
                        <span>•</span>
                        <span class="item-unit-price">₹${Number(item.price).toLocaleString('en-IN', {minimumFractionDigits: 2})} each</span>
                    </div>
                </div>
                <div class="qty-control">
                    <button type="button" class="qty-btn" onclick="updateQty(${item.id}, -1)">−</button>
                    <input
                        type="text"
                        class="qty-display"
                        value="${item.qty}"
                        onchange="setQtyDirect(${item.id}, this.value)"
                    >
                    <button type="button" class="qty-btn" onclick="updateQty(${item.id}, 1)">+</button>
                </div>
                <div class="line-total">
                    ₹${lineTotal.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2})}
                </div>
                <button
                    type="button"
                    class="item-remove"
                    title="Remove item"
                    onclick="removeItem(${item.id})"
                >
                    ✕
                </button>
            `;
            listEl.appendChild(row);
        });

        // Calculate Pricing
        const subtotal = items.reduce((sum, item) => sum + (item.price * item.qty), 0);
        const tax      = Math.round((subtotal * 0.18) * 100) / 100;
        const shipping = subtotal >= 500 ? 0 : 49;
        const total    = subtotal + tax + shipping;

        document.getElementById('summarySubtotal').textContent = `₹${subtotal.toLocaleString('en-IN', {minimumFractionDigits: 2})}`;
        document.getElementById('summaryTax').textContent      = `₹${tax.toLocaleString('en-IN', {minimumFractionDigits: 2})}`;
        document.getElementById('summaryShipping').innerHTML   = shipping === 0
            ? '<span style="color:var(--green);font-weight:700">FREE</span>'
            : '₹49.00';
        document.getElementById('summaryTotal').textContent    = `₹${total.toLocaleString('en-IN', {minimumFractionDigits: 2})}`;
        document.getElementById('btnTotalBadge').textContent  = `(₹${total.toLocaleString('en-IN', {minimumFractionDigits: 2})})`;

        // Shipping Progress Bar
        const freeThreshold = 500;
        const progressFill  = document.getElementById('shippingProgressFill');
        const progressText  = document.getElementById('shippingProgressText');
        const progressPct   = document.getElementById('shippingProgressPercent');

        if (subtotal >= freeThreshold) {
            progressFill.style.width = '100%';
            progressFill.style.background = 'var(--green)';
            progressText.innerHTML = '🎉 <strong style="color:var(--green)">You unlocked FREE Shipping!</strong>';
            progressPct.textContent = '100%';
        } else {
            const needed = freeThreshold - subtotal;
            const pct = Math.min(100, Math.round((subtotal / freeThreshold) * 100));
            progressFill.style.width = `${pct}%`;
            progressFill.style.background = 'linear-gradient(90deg, var(--accent), var(--accent2))';
            progressText.innerHTML = `⚡ Add <strong>₹${needed.toLocaleString('en-IN', {minimumFractionDigits: 2})}</strong> more for FREE Shipping`;
            progressPct.textContent = `${pct}%`;
        }
    }

    // ── Submit Order ─────────────────────────────────────────────────────────
    async function submitOrder() {
        const cart  = getCart();
        const items = Object.values(cart);

        if (items.length === 0) {
            showToast('Your cart is empty!', 'error');
            return;
        }

        // Gather form fields
        const name    = document.getElementById('c_name').value.trim();
        const email   = document.getElementById('c_email').value.trim();
        const phone   = document.getElementById('c_phone').value.trim();
        const street  = document.getElementById('c_street').value.trim();
        const city    = document.getElementById('c_city').value.trim();
        const state   = document.getElementById('c_state').value.trim();
        const postal  = document.getElementById('c_postal').value.trim();
        const country = document.getElementById('c_country').value.trim();
        const notes   = document.getElementById('c_notes').value.trim();

        // Validation
        const required = [
            { el: document.getElementById('c_name'), val: name },
            { el: document.getElementById('c_email'), val: email },
            { el: document.getElementById('c_street'), val: street },
            { el: document.getElementById('c_city'), val: city },
            { el: document.getElementById('c_state'), val: state },
            { el: document.getElementById('c_postal'), val: postal },
            { el: document.getElementById('c_country'), val: country },
        ];

        let hasError = false;
        required.forEach(f => {
            if (!f.val) {
                f.el.classList.add('has-error');
                hasError = true;
            } else {
                f.el.classList.remove('has-error');
            }
        });

        if (hasError) {
            showToast('Please fill in all required shipping fields.', 'error');
            return;
        }

        const payload = {
            customer_name:    name,
            customer_email:   email,
            customer_phone:   phone || null,
            notes:            notes || null,
            shipping_address: {
                street,
                city,
                state,
                postal_code: postal,
                country
            },
            items: items.map(i => ({
                product_id: i.id,
                quantity:   i.qty
            }))
        };

        const submitBtn = document.getElementById('submitOrderBtn');
        const origContent = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner"></span> Processing Order…';

        try {
            const res = await fetch('/api/orders', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept':       'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload)
            });

            const data = await res.json();

            if (res.ok && data.success) {
                // Order created successfully!
                const order = data.data;

                // Clear cart from storage
                localStorage.removeItem(CART_KEY);
                renderPage();

                // Show confirmation modal
                const custName = (order.customer && order.customer.name) || order.customer_name || name;
                const custEmail = (order.customer && order.customer.email) || order.customer_email || email;
                const ordTotal = (order.pricing && order.pricing.total) || order.total || 0;

                document.getElementById('confirmedOrderNum').textContent = order.order_number;
                document.getElementById('confirmedCustomer').textContent = custName;
                document.getElementById('confirmedEmail').textContent    = custEmail;
                document.getElementById('confirmedAddress').textContent  = `${street}, ${city}, ${state} ${postal}, ${country}`;
                document.getElementById('confirmedTotal').textContent    = `₹${Number(ordTotal).toLocaleString('en-IN', {minimumFractionDigits:2})}`;

                // Set receipt URL
                document.getElementById('receiptLink').href = `/cart/success/${encodeURIComponent(order.order_number)}`;

                document.getElementById('successModal').style.display = 'flex';
                showToast(`🎉 Order ${order.order_number} confirmed!`, 'success');
            } else {
                // Display error message
                let errorMsg = data.message || 'Failed to place order. Please check inputs.';
                if (data.errors) {
                    const firstErrKey = Object.keys(data.errors)[0];
                    errorMsg = data.errors[firstErrKey][0];
                }
                showToast(`❌ ${errorMsg}`, 'error');
            }
        } catch (err) {
            console.error(err);
            showToast('❌ Network error. Please check your connection and try again.', 'error');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = origContent;
        }
    }

    // ── Toast System ─────────────────────────────────────────────────────────
    function showToast(message, type = 'success') {
        const container = document.getElementById('toastContainer');
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = type === 'success' ? `✓ ${message}` : `⚠ ${message}`;
        container.appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(8px)';
            toast.style.transition = 'all 0.25s ease';
            setTimeout(() => toast.remove(), 260);
        }, 3600);
    }

    function escapeHtml(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    // Initial render on load
    document.addEventListener('DOMContentLoaded', () => {
        renderPage();
    });

    // Listen to changes in other tabs
    window.addEventListener('storage', (e) => {
        if (e.key === CART_KEY) {
            renderPage();
        }
    });
</script>

</body>
</html>
