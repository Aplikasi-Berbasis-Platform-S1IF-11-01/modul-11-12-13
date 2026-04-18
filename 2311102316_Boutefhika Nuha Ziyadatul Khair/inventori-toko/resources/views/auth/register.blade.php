@extends('layouts.auth')
@section('title', 'Daftar — Toko Inventory Aimar')

@section('content')
<h6>Buat Akun Baru</h6>

<form method="POST" action="{{ route('register.post') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Nama lengkap" required autofocus>
        </div>
        @error('name') <div class="text-danger mt-1" style="font-size:.78rem;">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="email@contoh.com" required>
        </div>
        @error('email') <div class="text-danger mt-1" style="font-size:.78rem;">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Min. 8 karakter" required>
        </div>
        @error('password') <div class="text-danger mt-1" style="font-size:.78rem;">{{ $message }}</div> @enderror
    </div>

    <div class="mb-4">
        <label class="form-label">Konfirmasi Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
            <input type="password" name="password_confirmation"
                   class="form-control" placeholder="Ulangi password" required>
        </div>
    </div>

    <button type="submit" class="btn btn-primary w-100">
        <i class="bi bi-person-plus me-1"></i> Daftar Sekarang
    </button>
</form>
@endsection

@section('footer')
    Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
@endsection