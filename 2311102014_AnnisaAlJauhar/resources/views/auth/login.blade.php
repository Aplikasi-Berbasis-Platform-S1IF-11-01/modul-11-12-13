<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Inventaris Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #fce4ec 0%, #f8bbd0 50%, #f48fb1 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(233,30,140,0.2);
            padding: 40px;
            width: 100%;
            max-width: 420px;
        }
        .login-logo {
            background: linear-gradient(135deg, #e91e8c, #f06292);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        .login-logo i { color: white; font-size: 2rem; }
        .login-title { color: #c2185b; font-weight: 700; text-align: center; }
        .login-subtitle { color: #999; text-align: center; font-size: 0.9rem; margin-bottom: 30px; }
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 2px solid #f8bbd0;
        }
        .form-control:focus {
            border-color: #e91e8c;
            box-shadow: 0 0 0 0.2rem rgba(233,30,140,0.15);
        }
        .btn-login {
            background: linear-gradient(90deg, #c2185b, #e91e8c);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            color: white;
            width: 100%;
            font-size: 1rem;
        }
        .btn-login:hover {
            background: linear-gradient(90deg, #ad1457, #c2185b);
            color: white;
        }
        .form-label { color: #c2185b; font-weight: 600; font-size: 0.9rem; }
        .alert { border-radius: 10px; }
        .input-group-text {
            background: #fce4ec;
            border: 2px solid #f8bbd0;
            border-right: none;
            color: #e91e8c;
        }
        .form-control.with-icon { border-left: none; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-logo">
            <i class="fas fa-store"></i>
        </div>
        <h4 class="login-title">Inventaris Toko</h4>
        <p class="login-subtitle">Toko Pak Cik & Mas Aimar 🛍️</p>

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control with-icon"
                        placeholder="admin@toko.com" value="{{ old('email') }}" required>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" class="form-control with-icon"
                        placeholder="••••••••" required>
                </div>
            </div>
            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt me-2"></i> Masuk ke Sistem
            </button>
        </form>

        <div class="text-center mt-4">
            <small class="text-muted">
                <i class="fas fa-info-circle me-1"></i>
                Default: admin@toko.com / password123
            </small>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>