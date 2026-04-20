@extends('layouts.auth')
@section('title', 'Masuk — Toko Inventory Aimar')

@section('content')
<h6>Masuk ke Akun Anda</h6>

<form method="POST" action="{{ route('login.post') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Email</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="email@contoh.com" required autofocus>
        </div>
        @error('email')
            <div class="text-danger mt-1" style="font-size:.78rem;"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" name="password" id="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="••••••••" required>
            <button class="btn btn-outline-secondary" type="button" onclick="togglePwd()" style="border-left:none;">
                <i class="bi bi-eye" id="pwd-icon"></i>
            </button>
        </div>
        @error('password')
            <div class="text-danger mt-1" style="font-size:.78rem;"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember" style="font-size:.82rem;color:var(--muted-text);">Ingat saya</label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary w-100">
        <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
    </button>
</form>

<div class="demo-box">
    <div class="demo-title"><i class="bi bi-info-circle me-1"></i>Akun Demo</div>
    <div style="color:var(--brown-text);line-height:1.8;">
        <span class="badge" style="background:var(--cream-600);color:var(--cream-50);font-size:.6rem;">Admin</span>
        pakcik@gmail.com / pakcik123<br>
        <span class="badge" style="background:var(--cream-600);color:var(--cream-50);font-size:.6rem;">Admin</span>
        aimar@gmail.com / aimar123<br>
        <span class="badge" style="background:var(--cream-300);color:var(--cream-800);font-size:.6rem;">Belanja</span>
        bnzk@gmail.com / nuha123
    </div>
</div>
@endsection

@section('footer')
    Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
@endsection

@push('scripts')
<script>
function togglePwd() {
    const input = document.getElementById('password');
    const icon  = document.getElementById('pwd-icon');
    if (input.type === 'password') { input.type = 'text'; icon.className = 'bi bi-eye-slash'; }
    else { input.type = 'password'; icon.className = 'bi bi-eye'; }
}
</script>
@endpush