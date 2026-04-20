<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login Toko Mas Aimar</title>
</head>
<body class="bg-secondary">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="text-center">Login</h4>
                    <hr>
                    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
                    <form action="/login" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="admin@toko.com" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="password123" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Masuk Toko</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>