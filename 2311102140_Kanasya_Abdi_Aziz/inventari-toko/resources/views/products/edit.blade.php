@extends('layouts.app')

@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

@section('content')

<div class="mb-3">
    <a href="{{ route('products.index') }}" class="btn btn-sm" style="background:#f1f5f9;color:#475569;border-radius:8px;font-weight:600;font-size:.82rem;">
        <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="form-card">
            <div class="mb-4 pb-3" style="border-bottom:1px solid #f1f5f9;">
                <h5 class="mb-1 fw-bold" style="color:#0f172a;">✏️ Edit Produk</h5>
                <p class="text-muted mb-0" style="font-size:.85rem;">
                    Mengedit: <strong>{{ $product->name }}</strong>
                </p>
            </div>

            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $product->name) }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="category" class="form-select @error('category') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach(['Makanan', 'Minuman', 'Snack', 'Bumbu', 'Sembako', 'Kebersihan', 'Peralatan', 'Lainnya'] as $cat)
                                <option value="{{ $cat }}" {{ old('category', $product->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                        @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Satuan <span class="text-danger">*</span></label>
                        <select name="unit" class="form-select @error('unit') is-invalid @enderror">
                            <option value="">-- Pilih Satuan --</option>
                            @foreach(['pcs', 'kg', 'gram', 'liter', 'ml', 'pack', 'lusin', 'dus', 'karung'] as $unit)
                                <option value="{{ $unit }}" {{ old('unit', $product->unit) == $unit ? 'selected' : '' }}>{{ $unit }}</option>
                            @endforeach
                        </select>
                        @error('unit') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" style="background:#f8fafc;border:1.5px solid #e2e8f0;border-right:none;">Rp</span>
                            <input type="number" name="price"
                                class="form-control @error('price') is-invalid @enderror"
                                min="0" step="100"
                                value="{{ old('price', $product->price) }}"
                                style="border-left:none;">
                            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Jumlah Stok <span class="text-danger">*</span></label>
                        <input type="number" name="stock"
                            class="form-control @error('stock') is-invalid @enderror"
                            min="0"
                            value="{{ old('stock', $product->stock) }}">
                        @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Deskripsi <span class="text-muted">(opsional)</span></label>
                        <textarea name="description"
                            class="form-control @error('description') is-invalid @enderror"
                            rows="3">{{ old('description', $product->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-3 p-3" style="background:#f8fafc;border-radius:10px;font-size:.8rem;color:#64748b;">
                    <i class="bi bi-clock-history me-1"></i>
                    Dibuat: {{ $product->created_at->locale('id')->diffForHumans() }}
                    &nbsp;·&nbsp;
                    Terakhir diubah: {{ $product->updated_at->locale('id')->diffForHumans() }}
                </div>

                <div class="d-flex gap-2 justify-content-end mt-4 pt-3" style="border-top:1px solid #f1f5f9;">
                    <a href="{{ route('products.index') }}" class="btn px-4"
                        style="background:#f1f5f9;color:#475569;border-radius:8px;font-weight:600;font-size:.875rem;">
                        Batal
                    </a>
                    <button type="submit" class="btn px-4"
                        style="background:#1a56db;color:#fff;border-radius:8px;font-weight:600;font-size:.875rem;border:none;">
                        <i class="bi bi-floppy me-1"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection