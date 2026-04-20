@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card glass-card border-0">
            <div class="card-body p-4 p-md-5">
                <div class="mb-4">
                    <span class="badge-soft d-inline-block mb-2">Form Edit</span>
                    <h3 class="section-title mb-1">Edit Data Produk</h3>
                    <p class="text-secondary mb-0">Perbarui informasi produk agar data inventori tetap akurat.</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger" style="border-radius:16px;">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" value="{{ old('nama_produk', $product->nama_produk) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kategori</label>
                            <input type="text" name="kategori" class="form-control" value="{{ old('kategori', $product->kategori) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Harga</label>
                            <input type="number" name="harga" class="form-control" value="{{ old('harga', $product->harga) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Stok</label>
                            <input type="number" name="stok" class="form-control" value="{{ old('stok', $product->stok) }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea name="deskripsi" rows="4" class="form-control">{{ old('deskripsi', $product->deskripsi) }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-gradient btn-modern">Update Produk</button>
                        <a href="{{ route('products.index') }}" class="btn btn-light border btn-modern">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection