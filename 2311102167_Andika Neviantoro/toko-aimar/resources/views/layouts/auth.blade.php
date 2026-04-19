<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko Aimar')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root { --primary: #2c6e49; --primary-dark: #1b4332; --accent: #f4a261; }
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 50%, #52b788 100%);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .auth-card {
            width: 100%; max-width: 420px;
            background: #fff; border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,.25);
            overflow: hidden;
        }
        .auth-header {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            padding: 2rem; text-align: center; color: #fff;
        }
        .auth-header .logo {
            width: 64px; height: 64px; background: var(--accent);
            border-radius: 16px; display: inline-flex; align-items: center;
            justify-content: center; font-size: 1.8rem; margin-bottom: 1rem;
        }
        .auth-header h4 { font-weight: 700; margin-bottom: .25rem; }
        .auth-header p { opacity: .75; font-size: .85rem; margin: 0; }
        .auth-body { padding: 2rem; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 .25rem rgba(44,110,73,.15); }
        .btn-primary { background: var(--primary); border-color: var(--primary); font-weight: 600; padding: .7rem; }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }
        .auth-footer { text-align: center; padding: 0 2rem 1.5rem; }
        .auth-footer a { color: var(--primary); font-weight: 600; text-decoration: none; }
        .input-group-text { background: #f8f9fa; border-right: none; }
        .form-control { border-left: none; }
        .input-group .form-control:focus { border-left: none; }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="auth-header">
            <div class="logo"><i class="bi bi-shop-window"></i></div>
            <h4>Toko Aimar</h4>
            <p>Milik Pak Cik & Mas Aimar</p>
        </div>
        <div class="auth-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show small" role="alert">
                    {{ session('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
        <div class="auth-footer">@yield('footer')</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
