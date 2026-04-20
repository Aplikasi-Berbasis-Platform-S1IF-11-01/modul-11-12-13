<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — TokoKu Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3451d1;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1a1f36 0%, #2d3561 50%, #1a1f36 100%);
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            padding: 1rem;
        }

        .login-wrapper {
            width: 100%; max-width: 440px;
        }

        .login-card {
            background: #fff;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 20px 60px rgba(0,0,0,.3);
        }

        .logo-wrap {
            width: 64px; height: 64px;
            background: var(--primary);
            border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.8rem; color: #fff;
            margin: 0 auto 1.25rem;
        }

        .login-title { font-weight: 700; color: #1a1f36; font-size: 1.4rem; }
        .login-sub   { color: #6b7280; font-size: .875rem; }

        .form-label { font-weight: 500; font-size: .875rem; color: #374151; }
        .form-control {
            border-radius: 10px; padding: .65rem 1rem;
            border-color: #d1d5db; font-size: .9rem;
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67,97,238,.15);
        }

        .input-group-text {
            border-radius: 10px 0 0 10px;
            background: #f9fafb;
            border-color: #d1d5db;
            color: #6b7280;
        }
        .input-group .form-control { border-radius: 0 10px 10px 0; }

        .btn-login {
            background: var(--primary); border-color: var(--primary);
            color: #fff; border-radius: 10px;
            padding: .7rem; font-weight: 600; font-size: .95rem;
            width: 100%; transition: background .2s;
        }
        .btn-login:hover { background: var(--primary-dark); border-color: var(--primary-dark); color: #fff; }

        .demo-box {
            background: #f0f4ff; border-radius: 10px; padding: .9rem 1rem;
            border: 1px solid #c7d2fe; margin-top: 1.25rem;
        }
        .demo-box .title { font-size: .78rem; font-weight: 600; color: var(--primary); margin-bottom: .35rem; }
        .demo-box p      { font-size: .8rem; color: #374151; margin: 0; line-height: 1.6; }

        .alert { border-radius: 10px; font-size: .875rem; }

        /* floating particles decoration */
        .particle {
            position: fixed;
            border-radius: 50%;
            opacity: .06;
            background: #fff;
            animation: float linear infinite;
        }
        @keyframes float {
            from { transform: translateY(100vh) rotate(0deg); }
            to   { transform: translateY(-10vh) rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Decorative particles -->
    <div class="particle" style="width:80px;height:80px;left:10%;animation-duration:15s;animation-delay:0s;"></div>
    <div class="particle" style="width:50px;height:50px;left:70%;animation-duration:12s;animation-delay:3s;"></div>
    <div class="particle" style="width:120px;height:120px;left:40%;animation-duration:20s;animation-delay:6s;"></div>
    <div class="particle" style="width:30px;height:30px;left:85%;animation-duration:10s;animation-delay:1s;"></div>

    <div class="login-wrapper">
        <div class="login-card">
            <!-- Logo -->
            <div class="text-center mb-4">
                <div class="logo-wrap"><i class="bi bi-shop"></i></div>
                <h4 class="login-title">TokoKu Inventaris</h4>
                <p class="login-sub">Masuk untuk mengelola inventaris toko Anda</p>
            </div>

            <!-- Alert -->
            @if(session('error'))
            <div class="alert alert-danger d-flex gap-2 align-items-center" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <div>{{ session('error') }}</div>
            </div>
            @endif
            @if(session('success'))
            <div class="alert alert-success d-flex gap-2 align-items-center" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <div>{{ session('success') }}</div>
            </div>
            @endif

            <!-- Form -->
            <form action="{{ route('login.post') }}" method="POST" novalidate>
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" id="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" placeholder="admin@toko.com" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" id="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="••••••••" required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePass">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn-login btn">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                </button>
            </form>

            <!-- Demo credentials -->
            <div class="demo-box">
                <div class="title"><i class="bi bi-info-circle me-1"></i>Akun Demo</div>
                <p>
                    <strong>Email:</strong> admin@toko.com<br>
                    <strong>Password:</strong> admin123
                </p>
            </div>
        </div>

        <p class="text-center text-white-50 small mt-3">
            &copy; {{ date('Y') }} TokoKu Inventaris — Tugas Modul 11, 12, 13
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('togglePass').addEventListener('click', function () {
            const input = document.getElementById('password');
            const icon  = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'bi bi-eye';
            }
        });
    </script>
</body>
</html>
