<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Toko Suki</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background-color: #212529; /* Carbon Black */
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .card-login {
            background-color: #343A40; /* Gunmetal */
            border: 1px solid #6C757D; /* Slate Grey */
            border-radius: 12px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        .form-control, .input-group-text {
            background-color: #212529;
            border-color: #6C757D;
            color: #F8F9FA;
        }
        .form-control:focus {
            background-color: #212529;
            border-color: #CED4DA;
            color: #F8F9FA;
            box-shadow: none;
        }
        .text-muted-custom {
            color: #CED4DA !important; /* Pale Slate */
        }
        .btn-primary-custom {
            background-color: #F8F9FA; /* Bright Snow untuk kontras */
            color: #212529;
            border: none;
            font-weight: 600;
        }
        .btn-primary-custom:hover {
            background-color: #CED4DA;
            color: #212529;
        }
    </style>
</head>
<body>

<div class="card card-login p-4">
    <div class="text-center mb-4">
        <div class="fs-1 mb-2">🛒</div>
        <h4 class="fw-bold mb-1" style="color: #F8F9FA;">Toko Suki</h4>
        <small class="text-muted-custom">Sistem Inventaris Minimalis</small>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-0 small">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label text-muted-custom small mb-1">Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="admin@tokosuki.com" required autofocus>
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label text-muted-custom small mb-1">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary-custom w-100 py-2">
            Masuk
        </button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>