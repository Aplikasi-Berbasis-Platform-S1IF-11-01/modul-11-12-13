<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Toko Aimar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            /* Background gradient modern biru ke ungu */
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        .login-header {
            background-color: #ffffff;
            padding: 2.5rem 2rem 1rem;
            border-bottom: none;
        }
        .login-body {
            padding: 1rem 2.5rem 2.5rem;
            background-color: #ffffff;
        }
        .btn-login {
            border-radius: 50px;
            font-weight: 600;
            padding: 0.8rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }
        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
            border-radius: 0.5rem 0 0 0.5rem;
        }
        .form-control {
            border-left: none;
            border-radius: 0 0.5rem 0.5rem 0;
            padding: 0.75rem 1rem;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #dee2e6;
        }
        .input-group:focus-within .input-group-text,
        .input-group:focus-within .form-control {
            border-color: #3498db;
            color: #3498db;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card login-card">
                    <div class="card-header login-header text-center">
                        <div class="mb-3">
                            <i class="bi bi-box-seam" style="font-size: 3rem; color: #3498db;"></i>
                        </div>
                        <h3 class="fw-bold mb-0 text-dark">Toko Aimar</h3>
                        <p class="text-muted mt-1 small">Sistem Manajemen Inventaris</p>
                    </div>
                    
                    <div class="card-body login-body">
                        @if($errors->any())
                            <div class="alert alert-danger rounded-3 py-2 small">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i> Email atau password salah!
                            </div>
                        @endif

                        <form action="{{ url('login') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label text-muted fw-semibold small">Alamat Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" placeholder="admin@tokoaimar.com" required value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-muted fw-semibold small">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btn-login mt-3">
                                Masuk ke Sistem <i class="bi bi-arrow-right-circle ms-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="text-center mt-4 text-white opacity-75 small">
                </div>
            </div>
        </div>
    </div>

</body>
</html>