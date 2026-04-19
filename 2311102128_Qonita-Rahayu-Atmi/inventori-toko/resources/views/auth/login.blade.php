<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login - AiCik Stock Inventari Toko">
    <title>Login | AiCik Stock</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary:    #7c3aed;
            --primary-dk: #5b21b6;
            --primary-lt: #ede9fe;
            --bg:         #f5f6fa;
            --bg-card:    #ffffff;
            --border:     #e5e7eb;
            --text:       #1e1b2e;
            --muted:      #6b7280;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        /* Decorative Background */
        .bg-pattern {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: radial-gradient(var(--border) 1px, transparent 1px);
            background-size: 30px 30px;
            opacity: 0.5;
            z-index: 0;
        }
        
        .login-container {
            position: relative; z-index: 10;
            width: 100%;
            max-width: 440px;
            padding: 1rem;
        }

        .login-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 3rem 2.5rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.04);
        }

        .brand {
            font-family: 'Poppins', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(90deg, #7c3aed, #9333ea);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-align: center;
        }
        .brand-sub { text-align: center; color: var(--muted); font-size: .85rem; margin-top: .25rem; margin-bottom: 2.5rem; font-weight: 500;}

        .form-group { margin-bottom: 1.25rem; }
        .form-label-login { display: block; font-size: .82rem; font-weight: 600; color: #374151; margin-bottom: .5rem; }

        .input-icon-wrap { position: relative; }
        .input-icon-wrap i {
            position: absolute; left: 1rem; top: 50%;
            transform: translateY(-50%);
            color: #9ca3af; font-size: 1.1rem;
            pointer-events: none;
        }
        .form-input {
            width: 100%;
            background: #f9fafb;
            border: 1px solid var(--border);
            color: var(--text);
            border-radius: 12px;
            padding: .85rem 1rem .85rem 2.7rem;
            font-size: .92rem;
            outline: none;
            transition: all .2s;
        }
        .form-input::placeholder { color: #9ca3af; }
        .form-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(124,58,237,.1);
            background: #ffffff;
        }
        .form-input.is-invalid { border-color: #ef4444; }
        .error-msg { font-size: .77rem; color: #ef4444; margin-top: .4rem; }

        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, var(--primary), #9333ea);
            border: none; color: #fff;
            border-radius: 12px;
            padding: .9rem;
            font-size: .95rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: transform .2s, box-shadow .2s;
            margin-top: .5rem;
        }
        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(124,58,237,.25);
        }
        .btn-login:active { transform: translateY(0); }

        .divider {
            border-top: 1px solid var(--border);
            margin: 1.8rem 0;
            position: relative;
            text-align: center;
        }
        .divider span {
            position: absolute; top: -10px; left: 50%;
            transform: translateX(-50%);
            background: var(--bg-card);
            padding: 0 .75rem;
            font-size: .75rem;
            font-weight: 500;
            color: var(--muted);
        }

        .hint-box {
            background: #f8fafc;
            border: 1px dashed var(--border);
            border-radius: 12px;
            padding: 1rem;
            font-size: .8rem;
            color: #475569;
            line-height: 1.6;
        }
        .hint-box strong { color: #64748b; }

        .alert-flash {
            background: #ecfdf5;
            border: 1px solid #10b981;
            color: #047857;
            border-radius: 12px;
            padding: .8rem 1rem;
            font-size: .85rem;
            margin-bottom: 1.5rem;
            display: flex; align-items: center; gap: .5rem;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="bg-pattern"></div>

    <div class="login-container">
        <div class="login-card">

            <div class="brand">AiCik Stock</div>
            <div class="brand-sub">Sistem Inventari Toko Pak Cik &amp; Mas Aimar</div>

            @if(session('success'))
            <div class="alert-flash">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}" id="login-form">
                @csrf

                <div class="form-group">
                    <label class="form-label-login" for="email">Alamat Email</label>
                    <div class="input-icon-wrap">
                        <i class="bi bi-envelope"></i>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            placeholder="admin@toko.com"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            required
                        >
                    </div>
                    @error('email')
                        <div class="error-msg"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label-login" for="password">Password</label>
                    <div class="input-icon-wrap">
                        <i class="bi bi-lock"></i>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            placeholder="••••••••"
                            autocomplete="current-password"
                            required
                        >
                    </div>
                    @error('password')
                        <div class="error-msg"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex align-items-center justify-content-between mb-4" style="font-size:.85rem;">
                    <label style="display:flex;align-items:center;gap:.5rem;color:#4b5563;cursor:pointer;font-weight:500;">
                        <input type="checkbox" name="remember" style="width:16px;height:16px;accent-color:var(--primary);"> Ingat saya
                    </label>
                </div>

                <button type="submit" class="btn-login" id="btn-login">
                    Masuk ke Sistem <i class="bi bi-arrow-right ms-1"></i>
                </button>
            </form>

            <div class="divider"><span>Info Akses</span></div>

            <div class="hint-box">
                <div><strong>Admin:</strong> admin@toko.com &nbsp;|&nbsp; <strong>Sandi:</strong> password123</div>
                <div style="margin-top:.4rem"><strong>Mas Aimar:</strong> aimar@toko.com &nbsp;|&nbsp; <strong>Sandi:</strong> password123</div>
                <div style="margin-top:.4rem"><strong>Mas Jakobi:</strong> jakobi@toko.com &nbsp;|&nbsp; <strong>Sandi:</strong> password123</div>
            </div>

        </div>
        <div style="text-align:center;margin-top:1.5rem;font-size:.78rem;color:var(--muted);position:relative;z-index:10;">
            &copy; 2026 AiCik Stock &mdash; Dibuat oleh Qonita Rahayu Atmi &bull; 2311102128
        </div>
    </div>

    <script>
        document.getElementById('login-form').addEventListener('submit', function() {
            const btn = document.getElementById('btn-login');
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Memverifikasi...';
            btn.disabled = true;
        });
    </script>
</body>
</html>

