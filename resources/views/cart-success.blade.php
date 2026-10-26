<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt #{{ $order->order_number }} — ShopNest</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #0a0a0f;
            --bg-card: #13131a;
            --border: rgba(255,255,255,0.08);
            --accent: #7c3aed;
            --accent2: #a855f7;
            --accent-glow: rgba(124,58,237,0.3);
            --green: #22c55e;
            --text: #f1f5f9;
            --muted: #94a3b8;
            --subtle: #1e293b;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            line-height: 1.5;
        }
        nav {
            position: sticky; top: 0; z-index: 100;
            background: rgba(10,10,15,0.9);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            display: flex; align-items: center; justify-content: space-between;
            height: 64px;
        }
        .nav-logo {
            font-size: 1.35rem; font-weight: 800;
            background: linear-gradient(135deg, #fff, #a855f7);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            text-decoration: none;
        }
        .nav-actions { display: flex; align-items: center; gap: 0.8rem; }
        .nav-link {
            color: var(--muted); text-decoration: none; font-size: 0.85rem;
            padding: 0.45rem 0.8rem; border-radius: 8px; transition: all 0.15s;
        }
        .nav-link:hover { color: var(--text); background: rgba(255,255,255,0.05); }

        .receipt-container {
            max-width: 800px; width: 100%; margin: 3rem auto;
            padding: 0 1.5rem; flex: 1;
        }
        .receipt-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 16px 48px rgba(0,0,0,0.4);
        }
        .receipt-head {
            background: linear-gradient(135deg, rgba(34,197,94,0.12) 0%, rgba(124,58,237,0.12) 100%);
            border-bottom: 1px solid var(--border);
            padding: 2.5rem 2rem 2rem;
            text-align: center;
        }
        .badge-icon {
            width: 60px; height: 60px; border-radius: 50%;
            background: linear-gradient(135deg, var(--green), #16a34a);
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 1.8rem; color: #fff; margin-bottom: 1rem;
            box-shadow: 0 8px 24px rgba(34,197,94,0.3);
        }
        .receipt-head h1 { font-size: 1.7rem; font-weight: 800; letter-spacing: -0.5px; }
        .receipt-head p { color: var(--muted); font-size: 0.9rem; margin-top: 0.25rem; }
        .order-badge {
            display: inline-block;
            font-family: monospace; font-size: 1rem; font-weight: 700;
            color: var(--accent2); background: rgba(168,85,247,0.15);
            border: 1px solid rgba(168,85,247,0.3);
            padding: 6px 16px; border-radius: 24px; margin-top: 0.75rem;
        }

        .receipt-body { padding: 2rem; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem; }
        .info-block {
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--border);
            border-radius: 12px; padding: 1.25rem;
        }
        .info-title {
            font-size: 0.75rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 1px; color: var(--muted); margin-bottom: 0.5rem;
        }
        .info-text { font-size: 0.9rem; line-height: 1.6; }

        /* Items Table */
        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 2rem; }
        .items-table th {
            text-align: left; padding: 0.75rem 1rem; font-size: 0.75rem;
            text-transform: uppercase; letter-spacing: 0.5px; color: var(--muted);
            border-bottom: 1px solid var(--border);
        }
        .items-table td {
            padding: 1rem; font-size: 0.875rem;
            border-bottom: 1px solid var(--border);
        }
        .items-table tr:last-child td { border-bottom: none; }

        /* Pricing Summary */
        .price-summary {
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--border);
            border-radius: 12px; padding: 1.25rem 1.5rem; margin-left: auto; max-width: 320px;
        }
        .price-row {
            display: flex; justify-content: space-between;
            font-size: 0.875rem; color: var(--muted); margin-bottom: 0.5rem;
        }
        .price-row.total {
            border-top: 1px solid var(--border);
            padding-top: 0.75rem; margin-top: 0.75rem; margin-bottom: 0;
            font-size: 1.15rem; font-weight: 800; color: var(--text);
        }

        .receipt-actions {
            display: flex; gap: 1rem; margin-top: 2rem; justify-content: center;
        }
        .btn {
            padding: 0.75rem 1.5rem; border-radius: 10px; font-size: 0.875rem; font-weight: 600;
            text-decoration: none; cursor: pointer; border: none; transition: all 0.2s;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            color: #fff;
        }
        .btn-primary:hover { opacity: 0.9; transform: translateY(-1px); }
        .btn-outline {
            background: var(--subtle); color: var(--text); border: 1px solid var(--border);
        }
        .btn-outline:hover { background: rgba(255,255,255,0.08); }

        @media print {
            nav, .receipt-actions { display: none; }
            body { background: #fff; color: #000; }
            .receipt-card { border: 1px solid #ccc; box-shadow: none; }
            .order-badge { color: #000; border-color: #000; }
        }
    </style>
</head>
<body>

<nav>
    <a href="{{ route('browse') }}" class="nav-logo">🛍 ShopNest</a>
    <div class="nav-actions">
        <a href="{{ route('browse') }}" class="nav-link">← Continue Shopping</a>
        @auth
            @if(Auth::user()->role === 'customer')
                <a href="{{ route('customer.dashboard') }}" class="nav-link">My Dashboard</a>
            @endif
        @endauth
    </div>
</nav>

<div class="receipt-container">
    <div class="receipt-card">
        <div class="receipt-head">
            <div class="badge-icon">✓</div>
            <h1>Order Confirmed!</h1>
            <p>A confirmation email has been sent to <strong>{{ $order->customer_email }}</strong></p>
            <div class="order-badge">{{ $order->order_number }}</div>
        </div>

        <div class="receipt-body">
            <div class="grid-2">
                <div class="info-block">
                    <div class="info-title">👤 Customer Details</div>
                    <div class="info-text">
                        <strong>{{ $order->customer_name }}</strong><br>
                        {{ $order->customer_email }}<br>
                        @if($order->customer_phone)
                            {{ $order->customer_phone }}<br>
                        @endif
                        <span style="color:var(--muted);font-size:0.8rem">Placed on: {{ $order->created_at->format('M d, Y h:i A') }}</span>
                    </div>
                </div>

                <div class="info-block">
                    <div class="info-title">📍 Shipping Address</div>
                    <div class="info-text">
                        {{ $order->shipping_address['street'] ?? '' }}<br>
                        {{ $order->shipping_address['city'] ?? '' }}, {{ $order->shipping_address['state'] ?? '' }} {{ $order->shipping_address['postal_code'] ?? '' }}<br>
                        {{ $order->shipping_address['country'] ?? 'India' }}
                        @if($order->notes)
                            <div style="margin-top:0.4rem;font-size:0.8rem;color:var(--muted)">Note: "{{ $order->notes }}"</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Items -->
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>SKU</th>
                        <th style="text-align:center">Qty</th>
                        <th style="text-align:right">Price</th>
                        <th style="text-align:right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td><strong>{{ $item->product_name }}</strong></td>
                        <td style="font-family:monospace;color:var(--muted)">{{ $item->product_sku }}</td>
                        <td style="text-align:center">{{ $item->quantity }}</td>
                        <td style="text-align:right">₹{{ number_format($item->unit_price, 2) }}</td>
                        <td style="text-align:right"><strong>₹{{ number_format($item->total_price, 2) }}</strong></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Financial Summary -->
            <div class="price-summary">
                <div class="price-row">
                    <span>Subtotal</span>
                    <span>₹{{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div class="price-row">
                    <span>GST (18%)</span>
                    <span>₹{{ number_format($order->tax, 2) }}</span>
                </div>
                <div class="price-row">
                    <span>Shipping</span>
                    <span>{{ $order->shipping_charge == 0 ? 'FREE' : '₹' . number_format($order->shipping_charge, 2) }}</span>
                </div>
                <div class="price-row total">
                    <span>Total Amount</span>
                    <span style="color:var(--accent2)">₹{{ number_format($order->total, 2) }}</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="receipt-actions">
                <button onclick="window.print()" class="btn btn-outline">
                    🖨 Print Receipt
                </button>
                @auth
                    @if(Auth::user()->role === 'customer')
                        <a href="{{ route('customer.dashboard') }}" class="btn btn-primary">
                            📊 View in My Orders
                        </a>
                    @else
                        <a href="{{ route('browse') }}" class="btn btn-primary">
                            🛍 Continue Shopping
                        </a>
                    @endif
                @else
                    <a href="{{ route('browse') }}" class="btn btn-primary">
                        🛍 Continue Shopping
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>

</body>
</html>
