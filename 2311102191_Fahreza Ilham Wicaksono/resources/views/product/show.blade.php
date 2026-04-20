@extends('layout')

@section('content')
    <div class="container">
        <div class="card">
            <h2>{{ $product->name }}</h2>

            <div class="form-group">
                <label class="form-label">Product Name</label>
                <div class="input-group">
                    <i class="fa fa-box"></i>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required readonly>
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
                <label class="form-label">Price</label>
                <div class="input-group">
                    <i class="fa fa-tag"></i>
                    <input type="number" name="price" class="form-control" value="{{ $product->price }}" required
                        readonly>
                </div>
            </div>

            <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection
