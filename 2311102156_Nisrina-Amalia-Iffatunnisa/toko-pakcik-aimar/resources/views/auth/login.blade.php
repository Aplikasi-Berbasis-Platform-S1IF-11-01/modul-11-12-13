<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Toko Suki</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #0f172a; color: #f8fafc; height: 100vh; display: flex; align-items: center; }
        .card-login { background: #1e293b; border: 1px solid #334155; border-radius: 16px; width: 100%; max-width: 400px; padding: 30px; }
        .form-control { background: #0f172a; border: 1px solid #334155; color: white; border-radius: 10px; }
        .form-control:focus { background: #0f172a; color: white; border-color: #38bdf8; box-shadow: none; }
        .btn-login { background: #38bdf8; color: #0f172a; font-weight: 700; width: 100%; border-radius: 10px; }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="card-login shadow-lg text-center">
            <h3 class="fw-bold mb-1">Toko Suki</h3>
            <p class="text-secondary small mb-4">Silakan login, Pak Cik & Mas Aimar</p>

            @if($errors->has('loginError'))
                <div class="alert alert-danger py-2 small">{{ $errors->first('loginError') }}</div>
            @endif

            <form action="/login" method="POST">
                @csrf
                <div class="mb-3 text-start">
                    <label class="small text-secondary">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="admin@suki.com" required>
                </div>
                <div class="mb-4 text-start">
                    <label class="small text-secondary">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn btn-login py-2">Masuk Ke Inventori</button>
            </form>
        </div>
    </div>
</body>
</html>