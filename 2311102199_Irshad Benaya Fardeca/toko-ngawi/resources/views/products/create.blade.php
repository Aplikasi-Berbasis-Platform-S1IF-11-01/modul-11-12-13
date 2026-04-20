@extends('layouts.app')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk Baru')

@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
    <span style="color:#94a3b8;font-size:14px">/ Tambah Produk Baru</span>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <div style="font-weight:700;font-size:15px;color:#0f172a">
                    <i class="bi bi-plus-circle me-2 text-primary"></i>Form Tambah Produk
                </div>
                <div style="font-size:12px;color:#94a3b8;margin-top:2px">
                    Isi semua kolom yang wajib diisi (bertanda <span class="text-danger">*</span>)
                </div>
            </div>
            <div class="card-body p-4">

                @if($errors->any())
                    <div class="alert alert-danger mb-4">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        <strong>Terdapat {{ $errors->count() }} kesalahan:</strong>
                        <ul class="mb-0 mt-1 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('products.store') }}">
                    @csrf

                    <div class="row g-3">
                        {{-- Nama Produk --}}
                        <div class="col-12">
                            <label class="form-label" for="name">
                                Nama Produk <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Contoh: Beras Pandan Wangi 5kg"
                                maxlength="255"
                                required
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Kategori --}}
                        <div class="col-md-6">
                            <label class="form-label" for="category">
                                Kategori <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                id="category"
                                name="category"
                                value="{{ old('category') }}"
                                class="form-control @error('category') is-invalid @enderror"
                                placeholder="Contoh: Sembako, Minuman, Snack..."
                                list="categoryList"
                                maxlength="100"
                                required
                            >
                            <datalist id="categoryList">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}">
                                @endforeach
                                <option value="Sembako">
                                <option value="Minuman">
                                <option value="Mie & Snack">
                                <option value="Bumbu Dapur">
                                <option value="Kebersihan">
                                <option value="Rokok">
                                <option value="Lainnya">
                            </datalist>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Satuan --}}
                        <div class="col-md-6">
                            <label class="form-label" for="unit">
                                Satuan <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                id="unit"
                                name="unit"
                                value="{{ old('unit', 'pcs') }}"
                                class="form-control @error('unit') is-invalid @enderror"
                                placeholder="pcs, kg, liter, karung..."
                                list="unitList"
                                maxlength="50"
                                required
                            >
                            <datalist id="unitList">
                                <option value="pcs">
                                <option value="kg">
                                <option value="gram">
                                <option value="liter">
                                <option value="ml">
                                <option value="botol">
                                <option value="bungkus">
                                <option value="karung">
                                <option value="kotak">
                                <option value="sachet">
                                <option value="renceng">
                                <option value="galon">
                                <option value="lusin">
                            </datalist>
                            @error('unit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Harga --}}
                        <div class="col-md-6">
                            <label class="form-label" for="price">
                                Harga (Rp) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius:8px 0 0 8px;border-color:#e2e8f0;background:#f8fafc;font-size:13px;font-weight:600">Rp</span>
                                <input
                                    type="number"
                                    id="price"
                                    name="price"
                                    value="{{ old('price') }}"
                                    class="form-control @error('price') is-invalid @enderror"
                                    placeholder="0"
                                    min="0"
                                    step="100"
                                    style="border-radius:0 8px 8px 0"
                                    required
                                >
                            </div>
                            @error('price')
                                <div class="text-danger mt-1" style="font-size:13px">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Stok --}}
                        <div class="col-md-6">
                            <label class="form-label" for="stock">
                                Stok Awal <span class="text-danger">*</span>
                            </label>
                            <input
                                type="number"
                                id="stock"
                                name="stock"
                                value="{{ old('stock', 0) }}"
                                class="form-control @error('stock') is-invalid @enderror"
                                placeholder="0"
                                min="0"
                                required
                            >
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="col-12">
                            <label class="form-label" for="description">
                                Deskripsi <span class="text-muted" style="font-weight:400">(Opsional)</span>
                            </label>
                            <textarea
                                id="description"
                                name="description"
                                rows="3"
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="Deskripsi singkat tentang produk ini..."
                                maxlength="1000"
                            >{{ old('description') }}</textarea>
                            <div style="font-size:12px;color:#94a3b8;margin-top:4px">
                                Maks. 1000 karakter
                            </div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-x me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-floppy me-1"></i> Simpan Produk
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
