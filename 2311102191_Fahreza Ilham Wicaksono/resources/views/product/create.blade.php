@extends('layout')

@section('content')
    <div class="container">
        <div class="card">
            <h2>Create Product</h2>

            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label">Product Name</label>
                    <div class="input-group">
                        <i class="fa fa-box"></i>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
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
                        <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
                    </div>
                </div>

                <div class="btn-container">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan Data
                    </button>

                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
                </div>

            </form>
        </div>
    </div>
@endsection
