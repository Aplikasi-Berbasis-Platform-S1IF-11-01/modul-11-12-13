@extends('layouts.app')
@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2 py-3">
                <i class="bi bi-plus-circle text-primary"></i>
                <span>Form Tambah Produk</span>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.products.store') }}" novalidate>
                    @csrf

                    <div class="row g-3">
                        {{-- Nama Produk --}}
                        <div class="col-12">
                            <label class="form-label fw-600">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Contoh: Mie Instan Goreng" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- SKU --}}
                        <div class="col-md-6">
                            <label class="form-label fw-600">SKU <span class="text-danger">*</span></label>
                            <input type="text" name="sku" value="{{ old('sku') }}"
                                   class="form-control @error('sku') is-invalid @enderror"
                                   placeholder="Contoh: SKU-00001" required>
                            @error('sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <div class="form-text">Kode unik produk, tidak boleh sama.</div>
                        </div>

                        {{-- Kategori --}}
                        <div class="col-md-6">
                            <label class="form-label fw-600">Kategori <span class="text-danger">*</span></label>
                            <input type="text" name="category" value="{{ old('category') }}"
                                   class="form-control @error('category') is-invalid @enderror"
                                   list="category-list" placeholder="Pilih atau ketik kategori" required>
                            <datalist id="category-list">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}">
                                @endforeach
                                <option value="Makanan & Minuman">
                                <option value="Elektronik">
                                <option value="Pakaian">
                                <option value="Alat Rumah Tangga">
                                <option value="Kesehatan & Kecantikan">
                                <option value="Olahraga">
                                <option value="Buku & Alat Tulis">
                            </datalist>
                            @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Harga --}}
                        <div class="col-md-6">
                            <label class="form-label fw-600">Harga (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="price" value="{{ old('price') }}"
                                       class="form-control @error('price') is-invalid @enderror"
                                       placeholder="0" min="0" step="500" required>
                            </div>
                            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Stok --}}
                        <div class="col-md-6">
                            <label class="form-label fw-600">Stok <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="stock" value="{{ old('stock', 0) }}"
                                       class="form-control @error('stock') is-invalid @enderror"
                                       placeholder="0" min="0" required>
                                <span class="input-group-text">pcs</span>
                            </div>
                            @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="col-12">
                            <label class="form-label fw-600">Deskripsi</label>
                            <textarea name="description" rows="3"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Deskripsi produk (opsional)...">{{ old('description') }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex gap-2 mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-lg me-1"></i> Simpan Produk
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary px-4">
                            <i class="bi bi-x-lg me-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
