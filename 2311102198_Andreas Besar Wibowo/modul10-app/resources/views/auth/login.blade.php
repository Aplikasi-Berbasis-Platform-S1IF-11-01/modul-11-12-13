<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Inventaris Toko Andreas & Viani</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Sora:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #1a56db;
            --primary-dark: #1239a5;
            --accent: #f59e0b;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #0f172a;
            overflow: hidden;
        }

        /* Left Panel */
        .left-panel {
            flex: 1;
            background: linear-gradient(135deg, #1a56db 0%, #1e3a8a 50%, #0f172a 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 50px;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
            top: -150px;
            right: -100px;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(245, 158, 11, 0.1);
            bottom: -80px;
            left: -50px;
        }

        .brand-logo {
            font-family: 'Sora', sans-serif;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .brand-logo .store-icon {
            font-size: 72px;
            display: block;
            margin-bottom: 20px;
        }

        .brand-logo h1 {
            font-size: 32px;
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
        }

        .brand-logo h1 span {
            color: var(--accent);
        }

        .brand-logo p {
            margin-top: 12px;
            color: rgba(255, 255, 255, 0.55);
            font-size: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .features {
            margin-top: 50px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            width: 100%;
            max-width: 340px;
            position: relative;
            z-index: 1;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 14px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
        }

        .feature-item .fi-icon {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        /* Right Panel - Login Form */
        .right-panel {
            width: 480px;
            background: #f8fafc;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 50px;
        }

        .login-header {
            margin-bottom: 36px;
        }

        .login-header h2 {
            font-family: 'Sora', sans-serif;
            font-size: 26px;
            font-weight: 700;
            color: #1e293b;
        }

        .login-header p {
            margin-top: 6px;
            color: #64748b;
            font-size: 14px;
        }

        .form-label {
            font-weight: 600;
            font-size: 13px;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-control {
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 11px 14px;
            font-size: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #fff;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(26, 86, 219, 0.12);
            outline: none;
        }

        .input-group .form-control {
            border-right: none;
            border-radius: 10px 0 0 10px;
        }

        .input-group .input-group-text {
            border: 1.5px solid #e2e8f0;
            border-left: none;
            background: #fff;
            border-radius: 0 10px 10px 0;
            cursor: pointer;
            color: #64748b;
            transition: color 0.2s;
        }

        .input-group:focus-within .input-group-text {
            border-color: var(--primary);
        }

        .btn-login {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 13px;
            font-size: 15px;
            font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            width: 100%;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 8px;
        }

        .btn-login:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(26, 86, 219, 0.35);
        }

        .demo-accounts {
            margin-top: 28px;
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px 18px;
        }

        .demo-accounts h6 {
            font-size: 11.5px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 12px;
        }

        .demo-account {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
        }

        .demo-account:last-child {
            border-bottom: none;
        }

        .demo-account:hover .demo-email {
            color: var(--primary);
        }

        .demo-name {
            font-weight: 600;
            font-size: 13px;
            color: #374151;
        }

        .demo-email {
            font-size: 12px;
            color: #64748b;
            transition: color 0.2s;
        }

        .demo-pass {
            font-size: 11px;
            background: #f1f5f9;
            color: #64748b;
            padding: 2px 8px;
            border-radius: 4px;
        }

        .alert {
            border: none;
            border-radius: 10px;
            font-size: 13.5px;
            padding: 12px 16px;
        }

        @media (max-width: 768px) {
            .left-panel {
                display: none;
            }

            .right-panel {
                width: 100%;
                padding: 40px 28px;
            }
        }
    </style>
</head>

<body>

    {{-- Left Panel --}}
    <div class="left-panel">
        <div class="brand-logo">
            <span class="store-icon">🏪</span>
            <h1>Toko <span>Andreas</span><br>& Viani</h1>
            <p>Sistem Manajemen Inventaris Modern</p>
        </div>

        <div class="features">
            <div class="feature-item">
                <div class="fi-icon">📦</div>
                <span>Kelola stok produk dengan mudah dan akurat</span>
            </div>
            <div class="feature-item">
                <div class="fi-icon">📊</div>
                <span>Pantau data produk secara real-time</span>
            </div>
            <div class="feature-item">
                <div class="fi-icon">🔔</div>
                <span>Alert otomatis saat stok mendekati minimum</span>
            </div>
            <div class="feature-item">
                <div class="fi-icon">🔒</div>
                <span>Sistem login aman berbasis session</span>
            </div>
        </div>
    </div>

    {{-- Right Panel --}}
    <div class="right-panel">
        <div class="login-header">
            <h2>Selamat Datang 👋</h2>
            <p>Silakan login untuk mengakses sistem inventaris</p>
        </div>

        {{-- Error --}}
        @if($errors->any())
            <div class="alert alert-danger d-flex align-items-center gap-2 mb-4">
                <i class="bi bi-exclamation-circle-fill"></i>
                <div>{{ $errors->first() }}</div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center gap-2 mb-4">
                <i class="bi bi-exclamation-circle-fill"></i>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        {{-- Login Form --}}
        <form action="{{ route('login.post') }}" method="POST" novalidate>
            @csrf

            <div class="mb-4">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="email@toko.com" value="{{ old('email') }}" autofocus required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="passwordInput"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password"
                        required>
                    <span class="input-group-text" onclick="togglePassword()">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </span>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>
                Masuk ke Sistem
            </button>
        </form>

        {{-- Demo Accounts --}}
        <div class="demo-accounts">
            <h6>Akun Demo Tersedia</h6>
            <div class="demo-account" onclick="fillLogin('andreas@toko.com','password123')">
                <div>
                    <div class="demo-name">Andreas (Pemilik)</div>
                    <div class="demo-email">andreas@toko.com</div>
                </div>
                <span class="demo-pass">password123</span>
            </div>
            <div class="demo-account" onclick="fillLogin('viani@toko.com','password123')">
                <div>
                    <div class="demo-name">Viani (Pemilik)</div>
                    <div class="demo-email">viani@toko.com</div>
                </div>
                <span class="demo-pass">password123</span>
            </div>
            <div class="demo-account" onclick="fillLogin('admin@toko.com','admin123')">
                <div>
                    <div class="demo-name">Admin Toko</div>
                    <div class="demo-email">admin@toko.com</div>
                </div>
                <span class="demo-pass">admin123</span>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const input = document.getElementById('passwordInput');
            const icon = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'bi bi-eye';
            }
        }

        function fillLogin(email, pass) {
            document.querySelector('input[name="email"]').value = email;
            document.querySelector('input[name="password"]').value = pass;
        }
    </script>
</body>

</html>