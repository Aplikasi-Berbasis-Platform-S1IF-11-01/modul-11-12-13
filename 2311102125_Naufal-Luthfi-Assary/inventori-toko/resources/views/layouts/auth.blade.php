<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Inventori Toko') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            margin: 0;
            background:
                radial-gradient(circle at top left, rgba(99,102,241,0.20), transparent 30%),
                radial-gradient(circle at bottom right, rgba(6,182,212,0.20), transparent 25%),
                linear-gradient(135deg, #eef4ff 0%, #f8fbff 50%, #f3f6fb 100%);
            color: #0f172a;
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
        }

        .auth-card {
            width: 100%;
            max-width: 1100px;
            border-radius: 30px;
            overflow: hidden;
            background: rgba(255,255,255,0.88);
            backdrop-filter: blur(18px);
            box-shadow: 0 30px 60px rgba(15, 23, 42, 0.12);
        }

        .auth-left {
            min-height: 620px;
            padding: 48px;
            color: white;
            background:
                radial-gradient(circle at top right, rgba(255,255,255,0.16), transparent 25%),
                linear-gradient(135deg, #0f172a 0%, #1d4ed8 50%, #06b6d4 100%);
            position: relative;
        }

        .auth-left::before {
            content: '';
            position: absolute;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
            top: -60px;
            right: -40px;
        }

        .auth-left::after {
            content: '';
            position: absolute;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            bottom: -70px;
            left: -40px;
        }

        .brand-pill {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            border-radius: 999px;
            background: rgba(255,255,255,0.14);
            border: 1px solid rgba(255,255,255,0.18);
            font-weight: 700;
        }

        .brand-icon {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: rgba(255,255,255,0.18);
        }

        .feature-box {
            border-radius: 24px;
            padding: 24px;
            background: rgba(255,255,255,0.10);
            border: 1px solid rgba(255,255,255,0.14);
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }

        .feature-item:last-child {
            margin-bottom: 0;
        }

        .feature-icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.14);
        }

        .auth-right {
            padding: 48px;
            background: rgba(255,255,255,0.78);
        }

        .login-badge {
            display: inline-block;
            background: #eef2ff;
            color: #4338ca;
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
        }

        .form-label {
            font-weight: 600;
            color: #334155;
        }

        .form-control {
            min-height: 52px;
            border-radius: 16px !important;
            border: 1px solid #dbe4f0;
            padding: 12px 14px;
            background: #fff;
        }

        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.14);
        }

        .input-group-text {
            border-radius: 16px 0 0 16px !important;
            border: 1px solid #dbe4f0;
            background: #f8fafc;
        }

        .password-toggle {
            border-radius: 0 16px 16px 0 !important;
            border: 1px solid #dbe4f0;
            background: #f8fafc;
        }

        .btn-login {
            min-height: 54px;
            border: none;
            border-radius: 16px;
            color: white;
            font-weight: 700;
            background: linear-gradient(135deg, #4f46e5, #06b6d4);
            box-shadow: 0 16px 30px rgba(79, 70, 229, 0.20);
        }

        .btn-login:hover {
            color: white;
            opacity: 0.96;
        }

        .muted-link {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        .muted-link:hover {
            text-decoration: underline;
        }

        .footer-note {
            font-size: 14px;
            color: #64748b;
        }

        @media (max-width: 991.98px) {
            .auth-left,
            .auth-right {
                padding: 32px 24px;
            }

            .auth-left {
                min-height: auto;
            }
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>