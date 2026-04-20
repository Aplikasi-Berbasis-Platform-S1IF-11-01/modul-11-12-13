<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Inventaris Toko</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #1a1a2e;
            --accent: #e94560;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f0f2f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Background decorative circles */
        body::before, body::after {
            content: '';
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
        }

        body::before {
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(233,69,96,.08) 0%, transparent 70%);
            top: -150px; left: -100px;
        }

        body::after {
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(26,26,46,.06) 0%, transparent 70%);
            bottom: -100px; right: -50px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 440px;
            z-index: 1;
        }

        /* Branding di atas card */
        .login-brand {
            text-align: center;
            margin-bottom: 28px;
        }

        .login-brand .brand-logo {
            width: 56px; height: 56px;
            background: var(--primary);
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 14px;
        }

        .login-brand h1 {
            font-family: 'Syne', sans-serif;
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--primary);
            margin: 0 0 4px;
        }

        .login-brand p {
            font-size: .85rem;
            color: #888;
            margin: 0;
        }

        /* Card login */
        .login-card {
            background: #fff;
            border-radius: 20px;
            padding: 36px 40px;
            box-shadow: 0 4px 24px rgba(0,0,0,.08), 0 1px 3px rgba(0,0,0,.05);
        }

        .login-card h2 {
            font-family: 'Syne', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 6px;
        }

        .login-card p.subtitle {
            font-size: .85rem;
            color: #888;
            margin-bottom: 28px;
        }

        .form-label {
            font-weight: 600;
            font-size: .85rem;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-control {
            border-radius: 10px;
            border: 1.5px solid #e8eaed;
            padding: 11px 14px;
            font-size: .9rem;
            transition: all .2s;
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(233,69,96,.12);
        }

        .input-group .form-control {
            border-right: none;
        }

        .input-group-text {
            background: #fff;
            border: 1.5px solid #e8eaed;
            border-left: none;
            border-radius: 0 10px 10px 0;
            color: #888;
            cursor: pointer;
        }

        .input-group:focus-within .form-control,
        .input-group:focus-within .input-group-text {
            border-color: var(--accent);
        }

        .input-group:focus-within .input-group-text {
            box-shadow: 3px 0 0 3px rgba(233,69,96,.12);
        }

        .btn-login {
            background: var(--primary);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-size: .95rem;
            font-weight: 600;
            color: #fff;
            width: 100%;
            transition: all .2s;
            cursor: pointer;
        }

        .btn-login:hover {
            background: var(--accent);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(233,69,96,.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Demo credentials box */
        .demo-box {
            background: #f8f9ff;
            border: 1.5px dashed #c7d2fe;
            border-radius: 10px;
            padding: 12px 16px;
            margin-top: 20px;
        }

        .demo-box p {
            font-size: .78rem;
            color: #6366f1;
            margin: 0;
            font-weight: 500;
        }

        .demo-box strong {
            font-weight: 700;
        }

        .invalid-feedback {
            font-size: .82rem;
        }

        .alert {
            border-radius: 10px;
            font-size: .88rem;
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <!-- Branding -->
    <div class="login-brand">
        <div class="brand-logo">🏪</div>
        <h1>Toko Inventaris</h1>
        <p>Pak Cik & Mas Aimar</p>
    </div>

    <!-- Login Card -->
    <div class="login-card">
        <h2>Selamat Datang!</h2>
        <p class="subtitle">Masuk ke sistem untuk mengelola inventaris toko</p>

        <!-- Flash messages -->
        @if(session('error'))
            <div class="alert alert-danger mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info mb-4" role="alert">
                <i class="bi bi-info-circle-fill me-2"></i>
                {{ session('info') }}
            </div>
        @endif

        <!-- Form Login -->
        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    placeholder="contoh@email.com"
                    autocomplete="email"
                    autofocus
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                    >
                    <span class="input-group-text" id="togglePassword">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </span>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>
                Masuk ke Sistem
            </button>
        </form>

        <!-- Demo credentials -->
        <div class="demo-box">
            <p><strong>🔑 Demo Login:</strong></p>
            <p>Email: <strong>admin@toko.com</strong></p>
            <p>Password: <strong>password</strong></p>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.className = 'bi bi-eye-slash';
        } else {
            passwordInput.type = 'password';
            eyeIcon.className = 'bi bi-eye';
        }
    });
</script>
</body>
</html>