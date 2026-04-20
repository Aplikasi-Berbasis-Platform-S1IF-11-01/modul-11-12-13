@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-custom p-4 shadow-sm">
            <h4 class="fw-bold mb-4" style="color: #d14781;">Edit Produk 📝</h4>
            
            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control rounded-pill" value="{{ $product->nama_produk }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control rounded-pill" value="{{ $product->harga }}" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Stok</label>
                    <input type="number" name="stok" class="form-control rounded-pill" value="{{ $product->stok }}" required>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary rounded-pill px-4">Batal</a>
                    <button type="submit" class="btn btn-pink rounded-pill px-4 shadow">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection