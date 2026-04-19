@extends('layouts.app')
@section('title', 'Edit Produk')
@section('page-title', '✎ Edit <em>Produk</em>')
@section('page-sub', 'Perbarui data produk La\'Vabie')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">✎ Form Edit Produk</div>
            <div class="card-body">
                <form method="POST" action="{{ route('products.update', $product) }}">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name', $product->name) }}" required/>
                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="category" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            @foreach(['Atasan','Bawahan','Dress','Hijab','Aksesoris'] as $cat)
                                <option {{ old('category', $product->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                        @error('category') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Harga</label>
                        <input type="number" name="price" class="form-control"
                               value="{{ old('price', $product->price) }}" min="1" required/>
                        @error('price') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection