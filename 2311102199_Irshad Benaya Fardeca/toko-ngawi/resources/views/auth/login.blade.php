<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Toko Pak Cik & Mas Aimar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 50%, #0ea5e9 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 440px;
        }

        .login-card {
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,.2);
        }

        .brand-logo {
            width: 56px; height: 56px;
            background: #2563eb;
            border-radius: 14px;
            display: grid; place-items: center;
            font-size: 26px; color: #fff;
            margin: 0 auto 16px;
        }

        .login-title {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            text-align: center;
            margin-bottom: 4px;
        }

        .login-subtitle {
            font-size: 14px;
            color: #64748b;
            text-align: center;
            margin-bottom: 32px;
        }

        .form-label { font-size: 13px; font-weight: 600; color: #374151; }

        .form-control {
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            padding: 11px 14px;
            font-size: 14px;
            transition: border-color .2s, box-shadow .2s;
        }
        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,.12);
        }
        .form-control.is-invalid { border-color: #dc2626; }

        .input-group-text {
            border-radius: 0 10px 10px 0 !important;
            border: 1.5px solid #e2e8f0;
            border-left: none;
            background: #f8fafc;
            cursor: pointer;
        }
        .input-group .form-control { border-radius: 10px 0 0 10px !important; }

        .btn-login {
            background: #2563eb;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-size: 15px;
            font-weight: 700;
            color: #fff;
            width: 100%;
            transition: background .2s, transform .1s;
        }
        .btn-login:hover { background: #1d4ed8; color: #fff; transform: translateY(-1px); }
        .btn-login:active { transform: translateY(0); }

        .demo-accounts {
            background: #f8fafc;
            border-radius: 12px;
            padding: 16px;
            margin-top: 24px;
            border: 1px solid #e2e8f0;
        }
        .demo-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: #94a3b8;
            margin-bottom: 10px;
        }
        .demo-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
        }
        .demo-item:last-child { border-bottom: none; }
        .demo-name { font-weight: 600; color: #334155; }
        .demo-cred { color: #64748b; font-family: monospace; }

        .alert-danger {
            border-radius: 10px;
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            font-size: 14px;
            padding: 12px 16px;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="brand-logo"><i class="bi bi-shop"></i></div>
            <h1 class="login-title">Toko Pak Cik & Mas Aimar</h1>
            <p class="login-subtitle">Sistem Inventaris Toko — Masuk untuk melanjutkan</p>

            {{-- Error Alert --}}
            @if ($errors->any())
                <div class="alert-danger mb-3">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success mb-3" style="border-radius:10px;font-size:14px;">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="email">Alamat Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        placeholder="contoh@email.com"
                        autocomplete="email"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required
                        >
                        <span class="input-group-text" onclick="togglePassword()">
                            <i class="bi bi-eye" id="pwIcon"></i>
                        </span>
                    </div>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember" style="font-size:13px;color:#64748b;">
                        Ingat saya
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                </button>
            </form>

            {{-- Demo Accounts --}}
            <div class="demo-accounts">
                <div class="demo-title">🔑 Akun Demo</div>
                <div class="demo-item">
                    <span class="demo-name">👴 Pak Cik</span>
                    <span class="demo-cred">pakcik@toko.com / pakcik123</span>
                </div>
                <div class="demo-item">
                    <span class="demo-name">👨 Mas Aimar</span>
                    <span class="demo-cred">aimar@toko.com / aimar123</span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const pw = document.getElementById('password');
            const icon = document.getElementById('pwIcon');
            if (pw.type === 'password') {
                pw.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                pw.type = 'password';
                icon.className = 'bi bi-eye';
            }
        }
    </script>
</body>
</html>
