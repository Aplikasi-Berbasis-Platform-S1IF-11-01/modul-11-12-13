@extends('layouts.app')

@section('title', 'Edit Produk - Inventaris Toko')

@section('content')

<!-- Page Header -->
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm me-3">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h4 class="page-title mb-0">✏️ Edit Produk</h4>
        <p class="page-subtitle mb-0">Mengubah data: <strong>{{ $product->nama_produk }}</strong></p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header py-3" style="background: linear-gradient(135deg, #856404, #e6ac0a);">
                <h6 class="mb-0 text-white">
                    <i class="bi bi-pencil-square me-2"></i> Form Edit Produk
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

                <form method="POST" action="{{ route('products.update', $product) }}">
                    @csrf
                    @method('PUT')

                    <!-- Nama Produk -->
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-tag me-1 text-warning"></i> Nama Produk <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            name="nama_produk"
                            class="form-control @error('nama_produk') is-invalid @enderror"
                            value="{{ old('nama_produk', $product->nama_produk) }}"
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
                            <i class="bi bi-grid me-1 text-warning"></i> Kategori <span class="text-danger">*</span>
                        </label>
                        <select
                            name="kategori"
                            class="form-select @error('kategori') is-invalid @enderror"
                            required
                        >
                            <option value="" disabled>-- Pilih Kategori --</option>
                            @foreach($kategoriList as $kat)
                                <option value="{{ $kat }}"
                                    {{ old('kategori', $product->kategori) == $kat ? 'selected' : '' }}>
                                    {{ $kat }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Stok & Harga -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="bi bi-stack me-1 text-warning"></i> Stok <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input
                                    type="number"
                                    name="stok"
                                    class="form-control @error('stok') is-invalid @enderror"
                                    value="{{ old('stok', $product->stok) }}"
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
                                <i class="bi bi-cash me-1 text-warning"></i> Harga (Rp) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 8px 0 0 8px;">Rp</span>
                                <input
                                    type="number"
                                    name="harga"
                                    id="hargaInput"
                                    class="form-control @error('harga') is-invalid @enderror"
                                    value="{{ old('harga', $product->harga) }}"
                                    min="0"
                                    required
                                >
                            </div>
                            @error('harga')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted" id="hargaPreview">
                                = Rp {{ number_format($product->harga, 0, ',', '.') }}
                            </small>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-card-text me-1 text-warning"></i> Deskripsi
                            <span class="text-muted">(opsional)</span>
                        </label>
                        <textarea
                            name="deskripsi"
                            class="form-control @error('deskripsi') is-invalid @enderror"
                            rows="3"
                            maxlength="1000"
                        >{{ old('deskripsi', $product->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning px-4">
                            <i class="bi bi-check-circle me-1"></i> Update Produk
                        </button>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-x-circle me-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info produk lama -->
        <div class="card mt-3" style="background: #fffbf0; border: 1px solid #ffc10730;">
            <div class="card-body p-3">
                <h6 class="text-muted mb-2" style="font-size: 0.825rem;">
                    <i class="bi bi-clock-history me-1"></i> Data sebelum diedit:
                </h6>
                <div class="row g-2" style="font-size: 0.825rem;">
                    <div class="col-6"><span class="text-muted">Nama:</span> {{ $product->nama_produk }}</div>
                    <div class="col-6"><span class="text-muted">Kategori:</span> {{ $product->kategori }}</div>
                    <div class="col-6"><span class="text-muted">Stok:</span> {{ $product->stok }} pcs</div>
                    <div class="col-6"><span class="text-muted">Harga:</span> Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
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
