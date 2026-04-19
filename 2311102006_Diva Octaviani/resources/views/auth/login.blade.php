<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <title>La'Vabie — Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"/>
</head>
<body class="login-page">

<div class="login-wrap">
    <div class="login-card">

        {{-- Brand --}}
        <div class="login-brand">
            <div class="login-brand-name">La'<em>Vabie</em></div>
            <div class="login-brand-sub">TOKO BUSANA & FASHION</div>
        </div>

        <p class="login-subtitle">Silakan masukkan akun Anda untuk melanjutkan</p>

        @if($errors->any())
            <div class="login-error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') }}"
                       placeholder="admin@lavabie.com" required/>
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control"
                       placeholder="••••••••" required/>
            </div>
            <button type="submit" class="btn btn-primary w-100">Masuk</button>
        </form>

        <p class="login-hint">Demo: admin@lavabie.com / password123</p>
    </div>
</div>

</body>
</html>