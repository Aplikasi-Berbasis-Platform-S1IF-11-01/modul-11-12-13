<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Inventaris Toko Mas Aimar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Poppins', sans-serif; }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1e3a5f 0%, #2d6a9f 50%, #1e8bc3 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 1rem;
        }

        .login-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, #1e3a5f 0%, #2d6a9f 100%);
            padding: 2.5rem 2rem 2rem;
            text-align: center;
            color: white;
        }

        .login-header .store-icon {
            font-size: 4rem;
            display: block;
            margin-bottom: 0.5rem;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.3));
        }

        .login-header h4 {
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 0.2rem;
        }

        .login-header p {
            font-size: 0.85rem;
            opacity: 0.8;
            margin: 0;
        }

        .login-body {
            background: white;
            padding: 2rem 2rem 1.5rem;
        }

        .form-control {
            border-radius: 10px;
            border: 1.5px solid #dee2e6;
            padding: 0.7rem 1rem 0.7rem 2.8rem;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .form-control:focus {
            border-color: #2d6a9f;
            box-shadow: 0 0 0 0.2rem rgba(45, 106, 159, 0.15);
        }

        .input-group-icon {
            position: relative;
        }
        .input-group-icon i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            z-index: 5;
            font-size: 1rem;
        }

        .form-label {
            font-weight: 500;
            font-size: 0.875rem;
            color: #495057;
            margin-bottom: 0.4rem;
        }

        .btn-login {
            background: linear-gradient(135deg, #1e3a5f 0%, #2d6a9f 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            font-weight: 600;
            font-size: 0.95rem;
            color: white;
            width: 100%;
            transition: all 0.2s;
            margin-top: 0.5rem;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(45, 106, 159, 0.4);
            color: white;
        }

        .alert {
            border-radius: 10px;
            border: none;
            font-size: 0.875rem;
        }

        .login-footer {
            text-align: center;
            padding: 1rem 2rem 1.5rem;
            background: white;
            border-top: 1px solid #f0f0f0;
        }
        .login-footer p {
            font-size: 0.75rem;
            color: #adb5bd;
            margin: 0;
        }

        /* Demo credentials box */
        .demo-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
            font-size: 0.8rem;
            color: #6c757d;
        }
        .demo-box strong { color: #495057; }

        /* Password toggle */
        .btn-toggle-pw {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #adb5bd;
            cursor: pointer;
            z-index: 5;
            padding: 0;
        }
    </style>
</head>
<body>

<div class="login-wrapper">

    <!-- Alert session -->
    @if(session('info'))
        <div class="alert alert-info mb-3">
            <i class="bi bi-info-circle me-2"></i>{{ session('info') }}
        </div>
    @endif

    <div class="login-card">

        <!-- Header -->
        <div class="login-header">
            <span class="store-icon">🛒</span>
            <h4>Inventaris Toko Mas Aimar</h4>
            <p>Masuk untuk mengelola produk toko</p>
        </div>

        <!-- Body -->
        <div class="login-body">

            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Demo credentials -->
            <div class="demo-box">
                <i class="bi bi-info-circle me-1"></i>
                <strong>Demo:</strong> admin@toko.com / password123
            </div>

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group-icon">
                        <i class="bi bi-envelope"></i>
                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Masukkan email..."
                            value="{{ old('email') }}"
                            required
                            autofocus
                        >
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group-icon" style="position: relative;">
                        <i class="bi bi-lock"></i>
                        <input
                            type="password"
                            name="password"
                            id="passwordField"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Masukkan password..."
                            required
                            style="padding-right: 2.8rem;"
                        >
                        <button type="button" class="btn-toggle-pw" onclick="togglePassword()">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember me -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember">
                    <label class="form-check-label" for="remember" style="font-size: 0.875rem;">
                        Ingat saya
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Masuk
                </button>
            </form>
        </div>

        <!-- Footer watermark -->
        <div class="login-footer">
            <p>2311102025 - Reli Gita Nurhidayati</p>
            <p>Praktikum ABP | Modul 11, 12, 13</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword() {
        const field = document.getElementById('passwordField');
        const icon = document.getElementById('eyeIcon');
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
</script>
</body>
</html>
