@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h2 style="margin: 0;">Tambah Produk Baru</h2>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            <i class='bx bx-arrow-back'></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="name">Nama Produk</label>
                <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="description">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group" style="display: flex; gap: 1.5rem;">
                <div style="flex: 1;">
                    <label class="form-label" for="price">Harga (Rp)</label>
                    <input class="form-control" type="number" id="price" name="price" value="{{ old('price') }}" required min="0">
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div style="flex: 1;">
                    <label class="form-label" for="stock">Stok</label>
                    <input class="form-control" type="number" id="stock" name="stock" value="{{ old('stock', 0) }}" required min="0">
                    @error('stock')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div style="margin-top: 2rem;">
                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">
                    <i class='bx bx-save'></i> Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
