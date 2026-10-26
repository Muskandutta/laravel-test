<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account — ShopNest</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #07070d; --bg-card: #0f0f18; --border: rgba(255,255,255,0.08);
            --accent: #7c3aed; --accent2: #a855f7; --accent-glow: rgba(124,58,237,0.4);
            --text: #f1f5f9; --muted: #64748b; --red: #ef4444; --green: #22c55e;
        }
        body {
            font-family: 'Inter', sans-serif; background: var(--bg);
            color: var(--text); min-height: 100vh;
            display: grid; grid-template-columns: 1fr 1fr;
        }
        .panel {
            background: linear-gradient(135deg, #0d1a1a 0%, #07070d 100%);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; padding: 3rem;
            position: relative; overflow: hidden;
        }
        .panel::before {
            content: ''; position: absolute;
            width: 500px; height: 500px; border-radius: 50%;
            background: radial-gradient(circle, rgba(16,185,129,0.15), transparent 70%);
            top: 50%; left: 50%; transform: translate(-50%,-50%);
        }
        .panel-graphic { font-size: 7rem; margin-bottom: 1.5rem; position: relative; filter: drop-shadow(0 0 40px rgba(16,185,129,0.4)); }
        .panel-logo { font-size: 2rem; font-weight: 800;
            background: linear-gradient(135deg, #fff, #10b981);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            margin-bottom: 0.75rem; position: relative; }
        .panel-sub { color: rgba(255,255,255,0.5); font-size: 0.9rem; text-align: center; max-width: 280px; position: relative; }
        .step-list { list-style: none; margin-top: 2.5rem; position: relative; display: flex; flex-direction: column; gap: 1rem; }
        .step-item { display: flex; align-items: center; gap: 0.85rem; }
        .step-num { width: 28px; height: 28px; border-radius: 50%;
            background: rgba(16,185,129,0.15); border: 1px solid rgba(16,185,129,0.3);
            color: #34d399; font-size: 0.75rem; font-weight: 700;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .step-text { color: rgba(255,255,255,0.65); font-size: 0.875rem; }

        .form-panel { display: flex; align-items: center; justify-content: center; padding: 2rem; }
        .form-card { width: 100%; max-width: 420px; }
        .form-title { font-size: 1.8rem; font-weight: 800; letter-spacing: -0.5px; margin-bottom: 0.4rem; }
        .form-sub { color: var(--muted); font-size: 0.9rem; margin-bottom: 2rem; }

        .alert { padding: 0.85rem 1rem; border-radius: 10px; font-size: 0.875rem; margin-bottom: 1.25rem; }
        .alert-error { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.25); color: #fca5a5; }

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

        .password-hint { font-size: 0.75rem; color: var(--muted); margin-top: 4px; }

        .terms-row { display: flex; align-items: flex-start; gap: 0.6rem; margin-bottom: 1.5rem; }
        .terms-row input { accent-color: var(--accent); margin-top: 2px; flex-shrink: 0; }
        .terms-row label { font-size: 0.82rem; color: var(--muted); cursor: pointer; line-height: 1.5; }
        .terms-row a { color: var(--accent2); text-decoration: none; }

        .submit-btn {
            width: 100%; padding: 0.85rem;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            border: none; border-radius: 10px;
            color: #fff; font-size: 0.95rem; font-weight: 700;
            font-family: 'Inter', sans-serif; cursor: pointer;
            transition: all 0.2s;
        }
        .submit-btn:hover { opacity: 0.9; transform: translateY(-1px); box-shadow: 0 8px 24px var(--accent-glow); }

        .divider { text-align: center; color: var(--muted); font-size: 0.8rem; margin: 1.25rem 0; position: relative; }
        .divider::before { content: ''; position: absolute; top: 50%; left: 0; right: 0; height: 1px; background: var(--border); }
        .divider span { background: var(--bg); padding: 0 0.75rem; position: relative; }

        .link-btn {
            display: block; text-align: center; padding: 0.75rem;
            border: 1px solid var(--border); border-radius: 10px;
            color: var(--text); text-decoration: none; font-size: 0.9rem; font-weight: 500;
            transition: all 0.15s;
        }
        .link-btn:hover { border-color: var(--accent); color: var(--accent2); background: rgba(124,58,237,0.05); }

        @media(max-width: 768px) { body { grid-template-columns: 1fr; } .panel { display: none; } }
    </style>
</head>
<body>
    <!-- LEFT PANEL -->
    <div class="panel">
        <div class="panel-graphic">🚀</div>
        <div class="panel-logo">Join ShopNest</div>
        <p class="panel-sub">Create your free account and start shopping in seconds.</p>
        <ol class="step-list">
            <li class="step-item"><span class="step-num">1</span><span class="step-text">Fill in your details below</span></li>
            <li class="step-item"><span class="step-num">2</span><span class="step-num" style="display:none"></span><span class="step-text">Instantly access your customer dashboard</span></li>
            <li class="step-item"><span class="step-num">3</span><span class="step-text">Browse products & place orders</span></li>
            <li class="step-item"><span class="step-num">4</span><span class="step-text">Track all your orders in one place</span></li>
        </ol>
    </div>

    <!-- RIGHT FORM PANEL -->
    <div class="form-panel">
        <div class="form-card">
            <h1 class="form-title">Create Account 🎉</h1>
            <p class="form-sub">It's free and takes less than a minute</p>

            @if($errors->any())
            <div class="alert alert-error">
                <strong>Please fix the errors below:</strong><br>
                @foreach($errors->all() as $error)
                    • {{ $error }}<br>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('register.post') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="name">Full Name</label>
                    <input
                        type="text" id="name" name="name"
                        class="form-input {{ $errors->has('name') ? 'input-error' : '' }}"
                        placeholder="User name"
                        value="{{ old('name') }}"
                        autocomplete="name" required autofocus
                    >
                    @error('name')<div class="error-msg">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input
                        type="email" id="email" name="email"
                        class="form-input {{ $errors->has('email') ? 'input-error' : '' }}"
                        placeholder="you@example.com"
                        value="{{ old('email') }}"
                        autocomplete="email" required
                    >
                    @error('email')<div class="error-msg">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input
                        type="password" id="password" name="password"
                        class="form-input {{ $errors->has('password') ? 'input-error' : '' }}"
                        placeholder="Min. 8 characters"
                        autocomplete="new-password" required
                    >
                    <div class="password-hint">Minimum 8 characters</div>
                    @error('password')<div class="error-msg">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                    <input
                        type="password" id="password_confirmation" name="password_confirmation"
                        class="form-input"
                        placeholder="Re-enter password"
                        autocomplete="new-password" required
                    >
                </div>

                <button type="submit" class="submit-btn">Create My Account →</button>
            </form>

            <div class="divider"><span>Already have an account?</span></div>
            <a href="{{ route('login') }}" class="link-btn">Sign In Instead</a>
        </div>
    </div>
</body>
</html>
