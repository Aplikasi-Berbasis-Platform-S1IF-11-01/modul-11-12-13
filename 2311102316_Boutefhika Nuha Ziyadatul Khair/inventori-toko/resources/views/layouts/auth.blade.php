<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko Inventory Aimar')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --cream-50:#fdfbf7;--cream-100:#f8f3e8;--cream-200:#f0e6d0;
            --cream-300:#e4d0b0;--cream-400:#c9a97a;--cream-500:#b08850;
            --cream-600:#8c6a38;--cream-700:#6b4f28;--cream-800:#4a3518;
            --brown-text:#3d2c14;--muted-text:#7a6148;--border:#e0d0b8;
        }
        body {
            min-height:100vh; font-family:'Inter','Segoe UI',sans-serif;
            background:var(--cream-100);
            background-image:radial-gradient(ellipse at 15% 15%,rgba(201,169,122,.18) 0%,transparent 55%),
                             radial-gradient(ellipse at 85% 85%,rgba(176,136,80,.12) 0%,transparent 55%);
            display:flex; align-items:center; justify-content:center;
        }
        .auth-wrap { width:100%; max-width:430px; padding:1rem; }
        .auth-card {
            background:#fff; border:1px solid var(--border);
            border-radius:20px; overflow:hidden;
            box-shadow:0 8px 40px rgba(61,44,20,.1);
        }
        .auth-header { background:var(--cream-800); padding:2rem; text-align:center; }
        .auth-logo {
            width:62px; height:62px; background:var(--cream-400);
            border-radius:14px; display:inline-flex; align-items:center;
            justify-content:center; font-size:1.7rem; margin-bottom:.9rem;
        }
        .auth-header h4 {
            font-family:'Playfair Display',serif; color:var(--cream-100);
            font-weight:700; margin-bottom:.25rem; font-size:1.3rem;
        }
        .auth-header p { color:var(--cream-500); font-size:.8rem; margin:0; }
        .auth-body { padding:2rem; }
        .auth-body h6 {
            font-family:'Playfair Display',serif; color:var(--brown-text);
            font-size:.95rem; font-weight:600; margin-bottom:1.5rem; text-align:center;
        }
        .form-label { font-size:.8rem; font-weight:500; color:var(--brown-text); }
        .form-control {
            border-color:var(--border); color:var(--brown-text);
            border-left:none; font-size:.88rem;
        }
        .form-control:focus { border-color:var(--cream-400); box-shadow:0 0 0 3px rgba(176,136,80,.12); }
        .input-group-text { background:var(--cream-50); border-color:var(--border); color:var(--muted-text); border-right:none; }
        .btn-primary {
            background:var(--cream-600); border-color:var(--cream-600);
            color:var(--cream-50); font-weight:500; padding:.65rem;
            border-radius:9px; font-size:.9rem;
        }
        .btn-primary:hover { background:var(--cream-700); border-color:var(--cream-700); color:var(--cream-50); }
        .btn-outline-secondary { border-color:var(--border); color:var(--muted-text); }
        .auth-footer { text-align:center; padding:0 2rem 1.75rem; font-size:.83rem; color:var(--muted-text); }
        .auth-footer a { color:var(--cream-600); font-weight:600; text-decoration:none; }
        .auth-footer a:hover { color:var(--cream-700); text-decoration:underline; }
        .demo-box { background:var(--cream-50); border:1px solid var(--cream-200); border-radius:10px; padding:.85rem 1rem; margin-top:1.25rem; font-size:.78rem; }
        .demo-box .demo-title { color:var(--muted-text); font-weight:600; margin-bottom:.4rem; font-size:.75rem; }
        .alert-success { background:#f0f7ec; border-color:#c6e0b8; color:#2e6b1e; border-radius:8px; font-size:.83rem; }
        .form-check-input:checked { background-color:var(--cream-600); border-color:var(--cream-600); }
        .text-danger { color:#b03030 !important; }
    </style>
</head>
<body>
    <div class="auth-wrap">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-logo">
                    <i class="bi bi-shop-window" style="color:var(--cream-800);"></i>
                </div>
                <h4>Toko Inventory Aimar</h4>
                <p>Simple Inventory Management</p>
            </div>
            <div class="auth-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @yield('content')
            </div>
            <div class="auth-footer">@yield('footer')</div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>