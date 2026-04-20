@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

<div class="mb-4">
    <a href="{{ route('products.index') }}" style="color:#6c757d; font-size:0.875rem; text-decoration:none;">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Produk
    </a>
    <h1 class="page-title mt-2">Tambah Produk Baru</h1>
    <p class="page-subtitle">Isi data produk untuk ditambahkan ke inventori toko</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header-custom">
                <h5>
                    <span class="icon-box"><i class="bi bi-plus-circle"></i></span>
                    Form Tambah Produk
                </h5>
            </div>

            <div class="p-4" style="background:white; border-radius: 0 0 16px 16px;">

                @if($errors->any())
                    <div class="mb-3 p-3" style="background:#fff1f2; border:1px solid #fecaca; border-radius:10px; font-size:0.83rem; color:#991b1b;">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        <strong>Ada kesalahan:</strong>
                        <ul class="mb-0 mt-1 ps-3">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Nama Produk <span style="color:#f72585;">*</span></label>
                            <input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror"
                                   placeholder="contoh: Indomie Goreng, Aqua 600ml..."
                                   value="{{ old('nama_produk') }}" required>
                            @error('nama_produk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kategori <span style="color:#f72585;">*</span></label>
                            <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $kat)
                                    <option value="{{ $kat }}" {{ old('kategori') === $kat ? 'selected' : '' }}>
                                        {{ $kat }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Stok <span style="color:#f72585;">*</span></label>
                            <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                                   placeholder="0" min="0"
                                   value="{{ old('stok') }}" required>
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Harga (Rp) <span style="color:#f72585;">*</span></label>
                            <div style="position:relative;">
                                <span style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#adb5bd; font-size:0.85rem; font-weight:600;">Rp</span>
                                <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                                       placeholder="0" min="0" step="100"
                                       style="padding-left: 2.5rem;"
                                       value="{{ old('harga') }}" required>
                            </div>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Deskripsi <span style="color:#adb5bd; font-weight:400;">(opsional)</span></label>
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                      rows="3" placeholder="Deskripsi singkat produk..."
                                      maxlength="500">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr style="border-color:#e9ecef; margin: 1.5rem 0;">

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary" style="border-radius:10px;">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-pink btn">
                            <i class="bi bi-plus-circle me-1"></i> Simpan Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
