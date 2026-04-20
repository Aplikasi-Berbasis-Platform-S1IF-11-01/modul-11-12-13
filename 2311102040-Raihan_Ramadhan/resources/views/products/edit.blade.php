@extends('layouts.app')

@section('content')

<div class="card-custom">
    <h3>Edit Produk</h3>

    <form method="POST" action="/products/update/{{ $data->id }}" enctype="multipart/form-data">
        @csrf

        <input type="text" name="name" value="{{ $data->name }}" class="form-control mb-3">
        <input type="number" name="stock" value="{{ $data->stock }}" class="form-control mb-3">
        <input type="number" name="price" value="{{ $data->price }}" class="form-control mb-3">

        <!-- Preview gambar lama -->
        @if($data->image)
            <img src="{{ asset('storage/'.$data->image) }}" width="100" class="mb-3" style="border-radius:8px;">
        @endif

        <!-- Upload gambar baru -->
        <input type="file" name="image" class="form-control mb-3">

        <button class="btn btn-warning">Update</button>
    </form>
</div>

@endsection