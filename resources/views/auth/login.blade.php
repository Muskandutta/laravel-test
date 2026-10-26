<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — ShopNest</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #07070d; --bg-card: #0f0f18; --border: rgba(255,255,255,0.08);
            --accent: #7c3aed; --accent2: #a855f7; --accent-glow: rgba(124,58,237,0.4);
            --text: #f1f5f9; --muted: #64748b; --red: #ef4444;
        }
        body {
            font-family: 'Inter', sans-serif; background: var(--bg);
            color: var(--text); min-height: 100vh;
            display: grid; grid-template-columns: 1fr 1fr;
        }
        /* Left decorative panel */
        .panel {
            background: linear-gradient(135deg, #1e1035 0%, #0d0d1a 100%);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; padding: 3rem;
            position: relative; overflow: hidden;
        }
        .panel::before {
            content: ''; position: absolute;
            width: 600px; height: 600px; border-radius: 50%;
            background: radial-gradient(circle, rgba(124,58,237,0.2), transparent 70%);
            top: 50%; left: 50%; transform: translate(-50%, -50%);
        }
        .panel-logo { font-size: 2.5rem; font-weight: 800; letter-spacing: -1px;
            background: linear-gradient(135deg, #fff, #a855f7);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            margin-bottom: 1rem; position: relative; }
        .panel-tagline { color: rgba(255,255,255,0.5); font-size: 1rem; text-align: center; max-width: 300px; position: relative; }
        .panel-graphic { font-size: 8rem; margin-bottom: 2rem; position: relative; filter: drop-shadow(0 0 40px rgba(124,58,237,0.5)); }
        .feature-list { list-style: none; margin-top: 2rem; position: relative; display: flex; flex-direction: column; gap: 0.75rem; }
        .feature-list li { display: flex; align-items: center; gap: 0.6rem; color: rgba(255,255,255,0.7); font-size: 0.9rem; }
        .feature-list li::before { content: '✓'; color: #a855f7; font-weight: 700; }

        /* Right form panel */
        .form-panel {
            display: flex; align-items: center; justify-content: center; padding: 2rem;
        }
        .form-card { width: 100%; max-width: 420px; }
        .form-title { font-size: 1.8rem; font-weight: 800; letter-spacing: -0.5px; margin-bottom: 0.4rem; }
        .form-sub { color: var(--muted); font-size: 0.9rem; margin-bottom: 2rem; }

        .alert {
            padding: 0.85rem 1rem; border-radius: 10px; font-size: 0.875rem;
            margin-bottom: 1.25rem; display: flex; align-items: flex-start; gap: 0.5rem;
        }
        .alert-success { background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.25); color: #86efac; }
        .alert-error   { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.25); color: #fca5a5; }

        .form-group { margin-bottom: 1.1rem; }
        .form-label { display: block; font-size: 0.78rem; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.6px; color: var(--muted); margin-bottom: 6px; }
        .form-input {
            width: 100%; padding: 0.75rem 1rem;
            background: var(--bg-card); border: 1px solid var(--border);
            border-radius: 10px; color: var(--text);
            font-size: 0.95rem; font-family: 'Inter', sans-serif; outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px var(--accent-glow); }
        .form-input::placeholder { color: var(--muted); }
        .input-error { border-color: var(--red) !important; }
        .error-msg { color: var(--red); font-size: 0.78rem; margin-top: 4px; }

        .remember-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; }
        .checkbox-label { display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: var(--muted); cursor: pointer; }
        .checkbox-label input[type=checkbox] { accent-color: var(--accent); width: 15px; height: 15px; }

        .submit-btn {
            width: 100%; padding: 0.85rem;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            border: none; border-radius: 10px;
            color: #fff; font-size: 0.95rem; font-weight: 700;
            font-family: 'Inter', sans-serif; cursor: pointer;
            transition: all 0.2s; letter-spacing: 0.3px;
        }
        .submit-btn:hover { opacity: 0.9; transform: translateY(-1px); box-shadow: 0 8px 24px var(--accent-glow); }
        .submit-btn:active { transform: translateY(0); }

        .divider { text-align: center; color: var(--muted); font-size: 0.8rem; margin: 1.25rem 0; position: relative; }
        .divider::before { content: ''; position: absolute; top: 50%; left: 0; right: 0; height: 1px; background: var(--border); }
        .divider span { background: var(--bg); padding: 0 0.75rem; position: relative; }

        .link-btn {
            display: block; text-align: center; padding: 0.75rem;
            border: 1px solid var(--border); border-radius: 10px;
            color: var(--text); text-decoration: none; font-size: 0.9rem;
            font-weight: 500; transition: all 0.15s;
        }
        .link-btn:hover { border-color: var(--accent); color: var(--accent2); background: rgba(124,58,237,0.05); }

        @media(max-width: 768px) {
            body { grid-template-columns: 1fr; }
            .panel { display: none; }
        }
    </style>
</head>
<body>
    <!-- LEFT PANEL -->
    <div class="panel">
        <div class="panel-graphic">🛍</div>
        <div class="panel-logo">ShopNest</div>
        <p class="panel-tagline">Your premium shopping destination for electronics, clothing, books & more.</p>
        <ul class="feature-list">
            <li>Browse 17+ curated products</li>
            <li>Real-time inventory tracking</li>
            <li>Secure checkout with GST billing</li>
            <li>Track your orders live</li>
        </ul>
    </div>

    <!-- RIGHT FORM PANEL -->
    <div class="form-panel">
        <div class="form-card">
            <h1 class="form-title">Welcome back 👋</h1>
            <p class="form-sub">Sign in to your ShopNest account</p>

            @if(session('success'))
                <div class="alert alert-success">✓ {{ session('success') }}</div>
            @endif

            @if($errors->has('email') && !$errors->has('password'))
                <div class="alert alert-error">✕ {{ $errors->first('email') }}</div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input
                        type="email" id="email" name="email"
                        class="form-input {{ $errors->has('email') ? 'input-error' : '' }}"
                        placeholder="you@example.com"
                        value="{{ old('email') }}"
                        autocomplete="email" required autofocus
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input
                        type="password" id="password" name="password"
                        class="form-input {{ $errors->has('password') ? 'input-error' : '' }}"
                        placeholder="••••••••"
                        autocomplete="current-password" required
                    >
                    @error('password')<div class="error-msg">{{ $message }}</div>@enderror
                </div>

                <div class="remember-row">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        Remember me
                    </label>
                </div>

                <button type="submit" class="submit-btn">Sign In →</button>
            </form>

            <div class="divider"><span>Don't have an account?</span></div>
            <a href="{{ route('register') }}" class="link-btn">Create a Customer Account</a>

            <p style="text-align:center;color:var(--muted);font-size:0.75rem;margin-top:1.5rem">
                Admin accounts are created by system administrators only.
            </p>
        </div>
    </div>
</body>
</html>
