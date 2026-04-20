@extends('layouts.auth')
@section('title', 'Login — Toko Aimar')

@section('content')
<h6 class="fw-700 mb-4 text-center text-muted">Masuk ke Akun Anda</h6>

<form method="POST" action="{{ route('login.post') }}">
    @csrf

    {{-- Email --}}
    <div class="mb-3">
        <label class="form-label fw-600 small">Email</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope text-muted"></i></span>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="email@contoh.com" required autofocus>
        </div>
        @error('email')
            <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
        @enderror
    </div>

    {{-- Password --}}
    <div class="mb-3">
        <label class="form-label fw-600 small">Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock text-muted"></i></span>
            <input type="password" name="password" id="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="••••••••" required>
            <button class="btn btn-outline-secondary" type="button" onclick="togglePwd()">
                <i class="bi bi-eye" id="pwd-icon"></i>
            </button>
        </div>
        @error('password')
            <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
        @enderror
    </div>

    {{-- Remember --}}
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <div class="form-check mb-0">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label small" for="remember">Ingat saya</label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary w-100">
        <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
    </button>
</form>

{{-- Demo accounts --}}
<div class="mt-4 p-3 bg-light rounded-3 small">
    <p class="fw-600 mb-2 text-muted"><i class="bi bi-info-circle"></i> Akun Demo:</p>
    <div class="row g-1">
        <div class="col-12"><span class="badge bg-success me-1">Admin</span> pakcik@tokoaimar.com / pakcik123</div>
        <div class="col-12"><span class="badge bg-success me-1">Admin</span> aimar@tokoaimar.com / aimar123</div>
        <div class="col-12"><span class="badge bg-info text-dark me-1">Belanja</span> jakobi@gmail.com / jakobi123</div>
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
