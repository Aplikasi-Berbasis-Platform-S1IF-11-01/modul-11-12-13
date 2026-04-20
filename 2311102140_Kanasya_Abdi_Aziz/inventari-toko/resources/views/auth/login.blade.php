<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Inventari Toko Pak Cik & Mas Aimar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body {
            background: #0f172a;
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            position: relative; overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute; width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(26,86,219,.25) 0%, transparent 70%);
            top: -200px; right: -100px; border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        body::after {
            content: '';
            position: absolute; width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(245,158,11,.15) 0%, transparent 70%);
            bottom: -100px; left: -100px; border-radius: 50%;
            animation: float 8s ease-in-out infinite reverse;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-30px); }
        }
        .login-wrapper { position: relative; z-index: 10; width: 100%; max-width: 420px; padding: 1rem; }
        .login-card {
            background: rgba(255,255,255,.05);
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 20px; padding: 2.5rem;
            backdrop-filter: blur(20px);
        }
        .brand-badge {
            display: inline-flex; align-items: center; gap: .5rem;
            background: rgba(26,86,219,.2); border: 1px solid rgba(26,86,219,.3);
            color: #93c5fd; padding: .4rem 1rem; border-radius: 20px;
            font-size: .75rem; font-weight: 600; margin-bottom: 1.5rem;
        }
        .login-title { font-size: 1.75rem; font-weight: 800; color: #fff; margin-bottom: .25rem; }
        .login-subtitle { color: #64748b; font-size: .875rem; margin-bottom: 2rem; }
        .form-label { color: #94a3b8; font-size: .8rem; font-weight: 600; letter-spacing: .04em; text-transform: uppercase; }
        .form-control {
            background: rgba(255,255,255,.07); border: 1.5px solid rgba(255,255,255,.1);
            border-radius: 10px; color: #fff; padding: .7rem 1rem; font-size: .9rem; transition: all .2s;
        }
        .form-control::placeholder { color: #475569; }
        .form-control:focus {
            background: rgba(255,255,255,.1); border-color: #1a56db;
            box-shadow: 0 0 0 3px rgba(26,86,219,.2); color: #fff;
        }
        .form-control.is-invalid { border-color: #ef4444; }
        .input-group-text {
            background: rgba(255,255,255,.07); border: 1.5px solid rgba(255,255,255,.1);
            border-right: none; color: #64748b; border-radius: 10px 0 0 10px;
        }
        .input-group .form-control { border-left: none; border-radius: 0 10px 10px 0; }
        .btn-login {
            background: linear-gradient(135deg, #1a56db, #1e429f);
            border: none; border-radius: 10px; color: #fff;
            font-weight: 700; font-size: .95rem; padding: .75rem; width: 100%; transition: all .3s;
        }
        .btn-login:hover { background: linear-gradient(135deg, #1e429f, #1a56db); color: #fff; transform: translateY(-1px); }
        .divider { text-align: center; color: #334155; font-size: .75rem; margin: 1.25rem 0; position: relative; }
        .divider::before { content: ''; position: absolute; top: 50%; left: 0; right: 0; height: 1px; background: rgba(255,255,255,.08); }
        .divider span { background: rgba(15,23,42,1); padding: 0 .75rem; position: relative; }
        .hint-box { background: rgba(26,86,219,.1); border: 1px solid rgba(26,86,219,.2); border-radius: 10px; padding: .875rem 1rem; font-size: .8rem; color: #93c5fd; }
        .hint-box strong { display: block; margin-bottom: .25rem; color: #bfdbfe; }
        .invalid-feedback { color: #f87171; font-size: .8rem; }
    </style>
</head>
<body>
    <div class="login-wrapper">
        @if(session('success'))
        <div class="alert mb-3" style="background:rgba(16,185,129,.15); border:1px solid rgba(16,185,129,.3); color:#6ee7b7; border-radius:12px; font-size:.85rem;">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        </div>
        @endif

        <div class="login-card">
            <div class="brand-badge">🏪 Inventari Toko</div>
            <h1 class="login-title">Selamat Datang!</h1>
            <p class="login-subtitle">Masuk ke sistem inventari Toko Pak Cik & Mas Aimar</p>

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="admin@toko.com"
                            value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="••••••••" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk ke Sistem
                </button>
            </form>

            <div class="divider"><span>info akun</span></div>
        </div>

        <p class="text-center mt-3" style="color:#334155; font-size:.75rem;">
            Biar Mas Jakobi bisa belanja dengan nyaman 🛒
        </p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>