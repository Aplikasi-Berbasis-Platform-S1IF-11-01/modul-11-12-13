@extends('layouts.app')

@section('title', 'Tambah Produk - Inventaris Toko')

@section('content')

<!-- Page Header -->
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm me-3">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h4 class="page-title mb-0">➕ Tambah Produk Baru</h4>
        <p class="page-subtitle mb-0">Tambahkan produk baru ke inventaris Toko Mas Aimar</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header py-3" style="background: linear-gradient(135deg, #1e3a5f, #2d6a9f);">
                <h6 class="mb-0 text-white">
                    <i class="bi bi-plus-circle me-2"></i> Form Tambah Produk
                </h6>
            </div>
            <div class="card-body p-4">

                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Oops! Ada yang perlu diperbaiki:</strong>
                        <ul class="mb-0 mt-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('products.store') }}">
                    @csrf

                    <!-- Nama Produk -->
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-tag me-1 text-primary"></i> Nama Produk <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            name="nama_produk"
                            class="form-control @error('nama_produk') is-invalid @enderror"
                            placeholder="Contoh: Mie Instan, Kipas Angin, Kaos Polos..."
                            value="{{ old('nama_produk') }}"
                            required
                            autofocus
                        >
                        @error('nama_produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-grid me-1 text-primary"></i> Kategori <span class="text-danger">*</span>
                        </label>
                        <select
                            name="kategori"
                            class="form-select @error('kategori') is-invalid @enderror"
                            required
                        >
                            <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>-- Pilih Kategori --</option>
                            @foreach($kategoriList as $kat)
                                <option value="{{ $kat }}" {{ old('kategori') == $kat ? 'selected' : '' }}>
                                    {{ $kat }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Stok & Harga (2 kolom) -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="bi bi-stack me-1 text-primary"></i> Stok <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input
                                    type="number"
                                    name="stok"
                                    class="form-control @error('stok') is-invalid @enderror"
                                    placeholder="0"
                                    value="{{ old('stok') }}"
                                    min="0"
                                    required
                                >
                                <span class="input-group-text" style="border-radius: 0 8px 8px 0;">pcs</span>
                            </div>
                            @error('stok')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="bi bi-cash me-1 text-primary"></i> Harga (Rp) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 8px 0 0 8px;">Rp</span>
                                <input
                                    type="number"
                                    name="harga"
                                    id="hargaInput"
                                    class="form-control @error('harga') is-invalid @enderror"
                                    placeholder="0"
                                    value="{{ old('harga') }}"
                                    min="0"
                                    required
                                >
                            </div>
                            @error('harga')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted" id="hargaPreview"></small>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-card-text me-1 text-primary"></i> Deskripsi
                            <span class="text-muted">(opsional)</span>
                        </label>
                        <textarea
                            name="deskripsi"
                            class="form-control @error('deskripsi') is-invalid @enderror"
                            rows="3"
                            placeholder="Deskripsi singkat tentang produk ini..."
                            maxlength="1000"
                        >{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Maksimal 1000 karakter</small>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-circle me-1"></i> Simpan Produk
                        </button>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-x-circle me-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Info Panel -->
    <div class="col-lg-3 d-none d-lg-block">
        <div class="card mb-3">
            <div class="card-body p-3">
                <h6 class="fw-600 text-primary mb-2"><i class="bi bi-lightbulb me-1"></i> Tips</h6>
                <ul class="list-unstyled mb-0" style="font-size: 0.825rem; color: #6c757d;">
                    <li class="mb-2">📌 Nama produk harus <strong>jelas dan spesifik</strong></li>
                    <li class="mb-2">📌 Stok diisi dengan <strong>jumlah yang tersedia</strong> saat ini</li>
                    <li class="mb-2">📌 Harga diisi dalam <strong>satuan Rupiah</strong></li>
                    <li class="mb-2">📌 Deskripsi membantu Mas Jakobi <strong>mengenali produk</strong></li>
                </ul>
            </div>
        </div>

        <div class="card" style="background: linear-gradient(135deg, #f0f7ff, #e8f4fd);">
            <div class="card-body p-3 text-center">
                <div style="font-size: 2.5rem;">🛒</div>
                <p style="font-size: 0.8rem; color: #6c757d; margin: 0;">
                    Semangat ngisi produknya!<br>
                    Biar Mas Jakobi bisa belanja 😄
                </p>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Preview harga dalam format Rupiah
    document.getElementById('hargaInput').addEventListener('input', function() {
        const val = parseInt(this.value);
        const preview = document.getElementById('hargaPreview');
        if (val && val > 0) {
            preview.textContent = '= Rp ' + val.toLocaleString('id-ID');
        } else {
            preview.textContent = '';
        }
    });
</script>
@endpush
