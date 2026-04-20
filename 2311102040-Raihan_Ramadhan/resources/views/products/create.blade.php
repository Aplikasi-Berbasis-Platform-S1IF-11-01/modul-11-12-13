@extends('layouts.app')

@section('content')

<div class="card-custom">
    <h3>Tambah Produk</h3>

    <form method="POST" action="/products/store" enctype="multipart/form-data">
        @csrf

        <input type="text" name="name" class="form-control mb-3" placeholder="Nama Produk">
        <input type="number" name="stock" class="form-control mb-3" placeholder="Stock">
        <input type="number" name="price" class="form-control mb-3" placeholder="Harga">

        <!-- Upload Gambar -->
        <input type="file" name="image" class="form-control mb-3">

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>

@endsection