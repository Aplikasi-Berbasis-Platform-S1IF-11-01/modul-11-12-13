<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — TokoCimar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --navy:      #0f1f45;
            --navy-dark: #081236;
            --pink:      #f72585;
            --pink-light:#ff6eb4;
            --pink-pale: #fff0f7;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            background: var(--navy-dark);
            overflow: hidden;
        }

        /* LEFT PANEL */
        .left-panel {
            width: 45%;
            background: var(--navy);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding: 3rem 3.5rem;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(247,37,133,.25) 0%, transparent 70%);
            top: -80px;
            right: -80px;
            border-radius: 50%;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(247,37,133,.15) 0%, transparent 70%);
            bottom: -60px;
            left: -40px;
            border-radius: 50%;
        }

        .brand-logo {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: 1.6rem;
            color: white;
            margin-bottom: 3rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .brand-logo .dot { color: var(--pink); }

        .brand-logo .icon-wrap {
            background: var(--pink);
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .hero-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: 2.4rem;
            color: white;
            line-height: 1.2;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .hero-title span { color: var(--pink-light); }

        .hero-sub {
            color: rgba(255,255,255,.55);
            font-size: 0.95rem;
            line-height: 1.6;
            position: relative;
            z-index: 1;
            margin-bottom: 2.5rem;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .feature-list li {
            color: rgba(255,255,255,.7);
            font-size: 0.875rem;
            padding: 0.4rem 0;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .feature-list li i {
            color: var(--pink-light);
            font-size: 1rem;
        }

        /* RIGHT PANEL */
        .right-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: #f4f7ff;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(15,31,69,.15);
        }

        .login-card h2 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: 1.6rem;
            color: var(--navy);
            margin-bottom: 0.25rem;
        }

        .login-card p {
            color: #6c757d;
            font-size: 0.875rem;
            margin-bottom: 2rem;
        }

        .form-label {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600;
            font-size: 0.82rem;
            color: var(--navy);
            margin-bottom: 0.4rem;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap i.prefix {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            font-size: 0.9rem;
        }

        .form-control {
            padding: 0.6rem 0.9rem 0.6rem 2.3rem;
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            font-size: 0.875rem;
            transition: all .2s;
        }

        .form-control:focus {
            border-color: var(--pink);
            box-shadow: 0 0 0 3px rgba(247,37,133,.12);
            outline: none;
        }

        .btn-login {
            background: var(--pink);
            color: white;
            border: none;
            border-radius: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 0.9rem;
            padding: 0.7rem;
            width: 100%;
            transition: all .2s;
            margin-top: 0.5rem;
        }

        .btn-login:hover {
            background: #d91a6f;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(247,37,133,.35);
        }

        .demo-box {
            background: var(--pink-pale);
            border-radius: 12px;
            padding: 0.9rem 1.1rem;
            margin-top: 1.5rem;
            font-size: 0.78rem;
            color: #555;
            line-height: 1.8;
        }

        .demo-box strong {
            color: var(--navy);
        }

        .alert-danger-custom {
            background: #fff1f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            border-radius: 10px;
            font-size: 0.83rem;
            padding: 0.7rem 1rem;
            margin-bottom: 1.2rem;
        }

        @media (max-width: 768px) {
            .left-panel { display: none; }
            .right-panel { background: var(--navy-dark); }
            .login-card { box-shadow: 0 10px 40px rgba(0,0,0,.3); }
        }
    </style>
</head>
<body>
    {{-- LEFT PANEL --}}
    <div class="left-panel">
        <div class="brand-logo">
            <div class="icon-wrap"><i class="bi bi-shop text-white"></i></div>
            TokoCimar<span class="dot">.</span>
        </div>

        <h2 class="hero-title">
            Inventori <span>Cerdas</span><br>untuk Toko Cimar

        <p class="hero-sub">
            Kelola stok & produk toko Pak Cik dan Mas Aimar<br>
            dengan mudah, cepat, dan modern.
        </p>

        <ul class="feature-list">
            <li><i class="bi bi-check-circle-fill"></i> Manajemen produk lengkap (CRUD)</li>
            <li><i class="bi bi-check-circle-fill"></i> Data tersimpan aman di database</li>
            <li><i class="bi bi-check-circle-fill"></i> Sistem login dengan session</li>
            <li><i class="bi bi-check-circle-fill"></i> Mas Jakobi bisa belanja dengan tenang</li>
        </ul>
    </div>

    {{-- RIGHT PANEL --}}
    <div class="right-panel">
        <div class="login-card">
            <h2>Selamat Datang!</h2>
            <p>Masuk ke sistem inventori toko</p>

            {{-- Error --}}
            @if($errors->any())
                <div class="alert-danger-custom">
                    <i class="bi bi-exclamation-circle me-1"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert-danger-custom">
                    <i class="bi bi-exclamation-circle me-1"></i>
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-wrap">
                        <i class="bi bi-envelope prefix"></i>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               placeholder="email@toko.com"
                               value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-wrap">
                        <i class="bi bi-lock prefix"></i>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                               placeholder="Masukkan password" required>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Masuk ke Dashboard
                </button>
            </form>

            <div class="demo-box">
                <strong>Akun Demo:</strong><br>
                <strong>Pak Cik:</strong> pakcik@toko.com / password158<br>
                <strong>Mas Aimar:</strong> aimar@toko.com / password158
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
