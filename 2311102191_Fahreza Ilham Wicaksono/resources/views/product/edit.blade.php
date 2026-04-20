@extends('layout')

@section('content')
    <div class="container">
        <div class="card">
            <h2>Edit Product</h2>

            <form action="{{ route('products.update', $product->uuid) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">Nama Produk</label>
                    <div class="input-group">
                        <i class="fa fa-box"></i>
                        <input type="text" name="name" class="form-control" value="{{ $product->name ?? old('name') }}"
                            required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="category" class="form-label text-white-50 text-uppercase fw-semibold small">Category</label>

                    <select name="category" id="category" aria-placeholder="Select Category">
                        <option value="mouse"> Mouse</option>
                        <option value="keyboard"> Keyboard</option>
                        <option value="monitor"> Monitor</option>
                        <option value="headphone"> Headphone</option>
                        <option value="iem"> IEM</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Harga</label>
                    <div class="input-group">
                        <i class="fa fa-tag"></i>
                        <input type="number" name="price" class="form-control"
                            value="{{ $product->price ?? old('price') }}" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="fa fa-save"></i> Simpan Data
                </button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection
