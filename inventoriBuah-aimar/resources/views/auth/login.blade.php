<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AIMAR FRUIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            background: #fff;
        }

        .login-header {
            background: #212529;
            color: white;
            padding: 30px;
            text-align: center;
        }

        .login-header i {
            font-size: 50px;
            margin-bottom: 10px;
        }

        .btn-primary {
            background: #764ba2;
            border: none;
            padding: 12px;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: #667eea;
            transform: translateY(-2px);
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #764ba2;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="login-header">
            <i class="bi bi-shop"></i>
            <h4>Inventory System</h4>
            <small class="text-secondary">Toko AIMAR FRUIT</small>
        </div>

        <div class="p-4">
            @if ($errors->any())
                <div class="alert alert-danger py-2">
                    <small><i class="bi bi-exclamation-triangle-fill"></i> Email atau Password salah, King!</small>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="aimar@toko.com" required
                            autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary fw-bold">
                        MASUK SEKARANG <i class="bi bi-box-arrow-in-right ms-2"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="text-center pb-4">
            <small class="text-muted">#KingNasirPembantaiNgawiTimur</small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
