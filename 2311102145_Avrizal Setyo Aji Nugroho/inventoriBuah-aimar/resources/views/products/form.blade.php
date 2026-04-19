@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h5 class="mb-0">{{ isset($product) ? 'Edit Produk' : 'Tambah Produk Baru' }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}"
                        method="POST">
                        @csrf
                        @if (isset($product))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama_produk"
                                class="form-control @error('nama_produk') is-invalid @enderror"
                                value="{{ old('nama_produk', $product->nama_produk ?? '') }}" required>
                            @error('nama_produk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                                value="{{ old('stok', $product->stok ?? '') }}" required>
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga (Rp)</label>
                            <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                                value="{{ old('harga', $product->harga ?? '') }}" required>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan Produk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
