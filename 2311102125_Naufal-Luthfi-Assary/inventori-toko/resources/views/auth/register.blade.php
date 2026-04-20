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

                    <h1 class="fw-bold mb-3" style="font-size: 2.5rem; line-height: 1.2;">
                        Buat akun admin untuk mulai mengelola inventori
                    </h1>

                    <p class="text-white-50 mb-0" style="font-size: 1rem; max-width: 520px;">
                        Dengan akun admin, kamu bisa mengelola produk, stok, kategori, dan data toko dengan lebih aman dan terstruktur.
                    </p>
                </div>

                <div class="feature-box mt-4">
                    <h5 class="fw-bold mb-4">Yang bisa kamu lakukan</h5>

                    <div class="feature-item">
                        <div class="feature-icon"><i class="bi bi-plus-circle"></i></div>
                        <div>
                            <div class="fw-semibold">Tambah Produk</div>
                            <small class="text-white-50">Masukkan data barang baru ke sistem.</small>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon"><i class="bi bi-pencil-square"></i></div>
                        <div>
                            <div class="fw-semibold">Edit Produk</div>
                            <small class="text-white-50">Perbarui harga, stok, dan deskripsi produk.</small>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon"><i class="bi bi-archive"></i></div>
                        <div>
                            <div class="fw-semibold">Kelola Inventori</div>
                            <small class="text-white-50">Pantau data barang dalam tabel interaktif.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="auth-right d-flex flex-column justify-content-center h-100">
                <div class="mb-4">
                    <span class="login-badge mb-3">Admin Register</span>
                    <h2 class="fw-bold mb-2">Buat akun baru</h2>
                    <p class="text-secondary mb-0">
                        Daftarkan akun admin untuk mengakses sistem inventori toko.
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input id="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name"
                                   value="{{ old('name') }}"
                                   required
                                   autocomplete="name"
                                   autofocus
                                   placeholder="Masukkan nama lengkap">
                        </div>
                        @error('name')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>

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
                                   autocomplete="new-password"
                                   placeholder="Masukkan password">
                            <button class="btn password-toggle" type="button" onclick="togglePassword('password', 'toggleIcon1')">
                                <i class="bi bi-eye" id="toggleIcon1"></i>
                            </button>
                        </div>
                        @error('password')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                            <input id="password-confirm" type="password"
                                   class="form-control"
                                   name="password_confirmation"
                                   required
                                   autocomplete="new-password"
                                   placeholder="Ulangi password">
                            <button class="btn password-toggle" type="button" onclick="togglePassword('password-confirm', 'toggleIcon2')">
                                <i class="bi bi-eye" id="toggleIcon2"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-login">
                            <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                        </button>
                    </div>

                    <p class="text-center footer-note mb-0">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="muted-link">Login di sini</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }
</script>
@endsection