@extends('layouts.auth')

@section('content')
<div class="auth-card">
    <div class="row g-0">
        <div class="col-lg-6">
            <div class="auth-left d-flex flex-column justify-content-between h-100">
                <div>
                    <div class="brand-pill mb-4">
                        <span class="brand-icon"><i class="bi bi-shield-lock"></i></span>
                        <span>Inventori Toko iLutS</span>
                    </div>

                    <h1 class="fw-bold mb-3" style="font-size: 2.5rem; line-height: 1.2;">
                        Reset password akun kamu dengan mudah
                    </h1>

                    <p class="text-white-50 mb-0" style="font-size: 1rem; max-width: 520px;">
                        Masukkan email yang terdaftar, lalu sistem akan mengirimkan link untuk membuat password baru.
                    </p>
                </div>

                <div class="feature-box mt-4">
                    <h5 class="fw-bold mb-4">Informasi</h5>

                    <div class="feature-item">
                        <div class="feature-icon"><i class="bi bi-envelope-paper"></i></div>
                        <div>
                            <div class="fw-semibold">Kirim Link Reset</div>
                            <small class="text-white-50">Sistem akan mengirim tautan reset password ke email yang terdaftar.</small>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon"><i class="bi bi-lock"></i></div>
                        <div>
                            <div class="fw-semibold">Password Baru</div>
                            <small class="text-white-50">Gunakan password yang kuat agar akun admin lebih aman.</small>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon"><i class="bi bi-person-check"></i></div>
                        <div>
                            <div class="fw-semibold">Akses Aman</div>
                            <small class="text-white-50">Setelah reset berhasil, login kembali untuk mengakses sistem.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="auth-right d-flex flex-column justify-content-center h-100">
                <div class="mb-4">
                    <span class="login-badge mb-3">Forgot Password</span>
                    <h2 class="fw-bold mb-2">Lupa password?</h2>
                    <p class="text-secondary mb-0">
                        Masukkan email kamu untuk menerima link reset password.
                    </p>
                </div>

                @if (session('status'))
                    <div class="alert alert-success border-0" style="border-radius:16px;">
                        Link reset password telah dikirim ke email kamu.
                        @if(config('mail.default') === 'log')
                            Silakan cek file <strong>storage/logs/laravel.log</strong> untuk melihat link reset password.
                        @endif
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autocomplete="email"
                                   autofocus
                                   placeholder="Masukkan email">
                        </div>
                        @error('email')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-login">
                            <i class="bi bi-send me-2"></i>Kirim Link Reset Password
                        </button>
                    </div>

                    <p class="text-center footer-note mb-0">
                        Ingat password?
                        <a href="{{ route('login') }}" class="muted-link">Kembali ke login</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection