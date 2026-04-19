<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventori Toko Suki - Pak Cik & Aimar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #0f172a; color: #f8fafc; font-family: 'Inter', sans-serif; }
        .card-custom { background: #1e293b; border: 1px solid #334155; border-radius: 16px; overflow: hidden; }
        .table { color: #cbd5e1; vertical-align: middle; margin-bottom: 0; background: transparent; }
        .table thead { background: #111827; color: #94a3b8; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.05em; }
        .table thead th { border: none; padding: 15px 20px; }
        .table tbody tr { border-bottom: 1px solid #334155; transition: 0.3s; }
        .table tbody td { background: #0f172a; color: #cbd5e1; }
        .table tbody tr:hover td { background: rgba(51, 65, 85, 0.4); }
        .table tbody td .text-white { color: #ffffff !important; }
        .table tbody td small { color: #94a3b8; }
        .price-text { color: #38bdf8; font-weight: 700; }
        .stock-badge { background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid #10b981; padding: 4px 12px; border-radius: 8px; font-size: 0.75rem; font-weight: 600; }
        .stat-card { background: #1e293b; border-radius: 16px; padding: 24px; border: 1px solid #334155; position: relative; }
        .btn-add { background: #38bdf8; color: #0f172a; font-weight: 700; border: none; border-radius: 10px; padding: 10px 20px; transition: 0.3s; }
        .btn-add:hover { background: #7dd3fc; transform: translateY(-2px); }
        .modal-content { background: #1e293b; color: white; border: 1px solid #334155; border-radius: 16px; }
        .form-control { background: #0f172a; border: 1px solid #334155; color: white; }
        .form-control:focus { background: #0f172a; color: white; border-color: #38bdf8; box-shadow: none; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold mb-1">Inventori Toko Suki</h2>
            <p class="text-secondary mb-0">Halo Pak Cik & Mas Aimar, selamat mengelola stok!</p>
        </div>
        <div class="d-flex gap-3 align-items-center">
            <form class="d-flex" id="searchForm" action="{{ route('products.index') }}" method="GET">
                <input type="text" class="form-control" name="search" id="searchInput" placeholder="Cari produk..." value="{{ request('search') }}" style="width: 250px; background: #1e293b; border-color: #334155;">
                <button type="submit" class="btn btn-outline-secondary border-0 ms-2" style="color: #38bdf8;"><i class="fas fa-search"></i></button>
            </form>
            <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#modalCreate">+ Tambah Produk</button>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger border-0 px-3" style="font-size: 0.9rem;">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="stat-card shadow-sm">
                <span class="text-secondary d-block mb-1 small uppercase">Rata-rata Harga</span>
                <h3 class="price-text mb-0">Rp {{ number_format($avgPrice, 0, ',', '.') }}</h3>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="stat-card shadow-sm">
                <span class="text-secondary d-block mb-1 small uppercase">Total Seluruh Stok</span>
                <h3 class="text-success mb-0">{{ $totalStock }} <small class="text-secondary" style="font-size: 0.9rem">Items</small></h3>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success bg-success text-white border-0 mb-4" style="border-radius: 12px;">
        {{ session('success') }}
    </div>
    @endif

    <div class="card card-custom shadow-lg">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="ps-4">Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga Satuan</th>
                        <th>Status Stok</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $p)
                    <tr>
                        <td class="ps-4 py-4">
                            <span class="fw-bold d-block text-white">{{ $p->name }}</span>
                            <small class="text-secondary">#SKU-0{{ $p->id }}</small>
                        </td>
                        <td class="text-secondary">{{ $p->category ?? 'Tidak ada' }}</td>
                        <td class="price-text">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                        <td><span class="stock-badge">{{ $p->stock }} Tersedia</span></td>
                        <td class="text-end pe-4">
                            <button class="btn btn-sm border-0 p-0" style="color: #06b6d4;" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $p->id }}" title="Lihat Detail"><i class="fas fa-info-circle"></i></button>
                            <button class="btn btn-sm border-0 p-0 ms-3" style="color: #fbbf24;" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $p->id }}" title="Edit"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm border-0 p-0 ms-3" style="color: #ef4444;" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $p->id }}" title="Hapus"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalDetail{{ $p->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content p-3">
                                <div class="modal-header border-0"><h5>Detail Produk</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="small text-secondary">Nama Produk</label>
                                        <div class="fw-bold text-white">{{ $p->name }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="small text-secondary">Kategori</label>
                                        <div class="text-secondary">{{ $p->category ?? 'Tidak ada' }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="small text-secondary">Harga</label>
                                            <div class="price-text">Rp {{ number_format($p->price, 0, ',', '.') }}</div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="small text-secondary">Stok</label>
                                            <div class="text-success">{{ $p->stock }} unit</div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="small text-secondary">Deskripsi</label>
                                        <div class="text-secondary">{{ $p->description ?? 'Tidak ada' }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="small text-secondary">SKU</label>
                                        <div class="text-muted">#SKU-0{{ $p->id }}</div>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-secondary border-0" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalEdit{{ $p->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form action="{{ route('products.update', $p->id) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="modal-content p-3">
                                    <div class="modal-header border-0"><h5>Update Produk</h5></div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="small text-secondary">Nama Produk</label>
                                            <input type="text" name="name" class="form-control" value="{{ $p->name }}" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="small text-secondary">Harga</label>
                                                <input type="number" name="price" class="form-control" value="{{ $p->price }}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="small text-secondary">Stok</label>
                                                <input type="number" name="stock" class="form-control" value="{{ $p->stock }}" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="small text-secondary">Kategori</label>
                                            <input type="text" name="category" class="form-control" value="{{ $p->category }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="small text-secondary">Deskripsi</label>
                                            <textarea name="description" class="form-control" rows="3">{{ $p->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-secondary border-0" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-add">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade" id="modalDelete{{ $p->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <form action="{{ route('products.destroy', $p->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <div class="modal-content p-3 text-center">
                                    <div class="modal-body">
                                        <h4 class="mb-3 text-danger">⚠️ Hapus Barang?</h4>
                                        <p>Yakin mau hapus <b>{{ $p->name }}</b>? Nanti Mas Jakobi gak bisa beli barang ini lho.</p>
                                    </div>
                                    <div class="d-flex justify-content-center gap-2 pb-3">
                                        <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger px-4">Ya, Hapus Saja</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="modal-content p-3">
                <div class="modal-header border-0"><h5>Produk Baru Mas Aimar</h5></div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="small text-secondary">Nama Produk</label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: Suki Seafood" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="small text-secondary">Harga</label>
                            <input type="number" name="price" class="form-control" placeholder="15000" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="small text-secondary">Stok Awal</label>
                            <input type="number" name="stock" class="form-control" placeholder="50" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="small text-secondary">Kategori</label>
                        <input type="text" name="category" class="form-control" placeholder="Contoh: Makanan">
                    </div>
                    <div class="mb-3">
                        <label class="small text-secondary">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi produk..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary border-0" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-add">Tambah Sekarang</button>
                </div>
            </div>
        </form>
    </div>
</div>

<footer class="text-center py-4 mt-5 border-top border-secondary">
    <p class="text-secondary mb-0">© 2026 Inventori Toko Suki | by <span class="text-white fw-bold">Nisrina Amalia</span></p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Auto-submit search form on input change
    document.getElementById('searchInput').addEventListener('keyup', function() {
        document.getElementById('searchForm').submit();
    });
</script>
</body>
</html>