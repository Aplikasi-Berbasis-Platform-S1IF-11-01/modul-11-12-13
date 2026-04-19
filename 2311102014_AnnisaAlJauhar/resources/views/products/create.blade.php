@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Produk Baru</h5>
                <a href="{{ route('products.index') }}" class="btn btn-light btn-sm ms-auto">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
            <div class="card-body p-4">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold" style="color:#c2185b;">Nama Produk</label>
                            <input type="text" name="name" class="form-control"
                                placeholder="Contoh: Indomie Goreng" value="{{ old('name') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold" style="color:#c2185b;">Kategori</label>
                            <select name="category" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach(['Makanan', 'Minuman', 'Sembako', 'Kebersihan', 'Elektronik', 'Lainnya'] as $cat)
                                    <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold" style="color:#c2185b;">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3"
                                placeholder="Deskripsi produk (opsional)">{{ old('description') }}</textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold" style="color:#c2185b;">Stok</label>
                            <input type="number" name="stock" class="form-control"
                                placeholder="0" value="{{ old('stock') }}" min="0" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold" style="color:#c2185b;">Harga (Rp)</label>
                            <input type="number" name="price" class="form-control"
                                placeholder="0" value="{{ old('price') }}" min="0" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold" style="color:#c2185b;">Satuan</label>
                            <select name="unit" class="form-select" required>
                                @foreach(['pcs', 'kg', 'liter', 'lusin', 'pack', 'dus'] as $unit)
                                    <option value="{{ $unit }}" {{ old('unit') == $unit ? 'selected' : '' }}>{{ $unit }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan Produk
                        </button>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection