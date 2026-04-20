<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk - Toko Aimar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f3f4f6; }
        .card { border: none; border-radius: 1.2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .form-control { border-radius: 0.5rem; padding: 0.6rem 1rem; }
        .form-control:focus { border-color: #eab308; box-shadow: 0 0 0 3px rgba(234,179,8,0.1); }
    </style>
</head>
<body class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('products.index') }}" class="btn btn-light rounded-circle p-2 me-3 shadow-sm">
                        <i class="bi bi-arrow-left fs-5"></i>
                    </a>
                    <h3 class="fw-bold mb-0">Edit Data Produk</h3>
                </div>

                <div class="card bg-white p-4 p-md-5 border-top border-warning border-4">
                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT') <div class="mb-4">
                            <label class="form-label fw-semibold">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" name="nama_produk" class="form-control" value="{{ $product->nama_produk }}" required>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Harga (Rp) <span class="text-danger">*</span></label>
                                <input type="number" name="harga" class="form-control" value="{{ $product->harga }}" required>
                            </div>
                            <div class="col-md-6 mt-4 mt-md-0">
                                <label class="form-label fw-semibold">Update Stok <span class="text-danger">*</span></label>
                                <input type="number" name="stok" class="form-control" value="{{ $product->stok }}" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3">{{ $product->deskripsi }}</textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-5">
                            <a href="{{ route('products.index') }}" class="btn btn-light rounded-pill px-4 fw-medium">Batal</a>
                            <button type="submit" class="btn btn-warning text-dark rounded-pill px-5 fw-medium shadow-sm">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>