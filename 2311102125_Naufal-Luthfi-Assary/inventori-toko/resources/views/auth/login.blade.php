@extends('layouts.auth')

@section('content')
<div class="auth-card">
    <div class="row g-0">
        <div class="col-lg-6">
            <div class="auth-left d-flex flex-column justify-content-between h-100">
                <div>
                    <div class="brand-pill mb-4">
                        <span class="brand-icon"><i class="bi bi-shop"></i></span>
                        <span>Inventori Toko iLutS</span>
                    </div>

                    <h1 class="fw-bold mb-3" style="font-size: 2.6rem; line-height: 1.2;">
                        Kelola inventori Toko dengan mudah dan aman 
                    </h1>

                    <p class="text-white-50 mb-0" style="font-size: 1rem; max-width: 520px;">
                        Sistem ini membantu dalam mengelola produk toko secara lebih rapi, cepat, dan aman.
                    </p>
                </div>

                <div class="feature-box mt-4">
                    <h5 class="fw-bold mb-4">Keunggulan Sistem</h5>

                    <div class="feature-item">
                        <div class="feature-icon"><i class="bi bi-box-seam"></i></div>
                        <div>
                            <div class="fw-semibold">CRUD Produk</div>
                            <small class="text-white-50">Tambah, edit, dan hapus produk dengan mudah.</small>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon"><i class="bi bi-table"></i></div>
                        <div>
                            <div class="fw-semibold">Tabel Interaktif</div>
                            <small class="text-white-50">Pencarian data lebih cepat dengan DataTables.</small>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon"><i class="bi bi-shield-lock"></i></div>
                        <div>
                            <div class="fw-semibold">Login Session</div>
                            <small class="text-white-50">Data inventori lebih aman karena hanya admin yang bisa masuk.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="auth-right d-flex flex-column justify-content-center h-100">
                <div class="mb-4">
                    <span class="login-badge mb-3">Admin Login</span>
                    <h2 class="fw-bold mb-2">Masuk ke akun kamu</h2>
                    <p class="text-secondary mb-0">
                        Login untuk mulai mengelola data produk toko.
                    </p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
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

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password"
                                   required
                                   autocomplete="current-password"
                                   placeholder="Masukkan password">
                            <button class="btn password-toggle" type="button" onclick="togglePassword()">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-secondary" for="remember">
                                Remember Me
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <a class="muted-link" href="{{ route('password.request') }}">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-login">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login Sekarang
                        </button>
                    </div>

                    @if (Route::has('register'))
                        <p class="text-center footer-note mb-0">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="muted-link">Daftar di sini</a>
                        </p>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('bi-eye');
            toggleIcon.classList.add('bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('bi-eye-slash');
            toggleIcon.classList.add('bi-eye');
        }
    }
</script>
@endsection