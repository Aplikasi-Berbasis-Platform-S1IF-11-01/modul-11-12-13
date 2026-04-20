<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | StockSense</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f7f6;
            color: #444;
        }
        .main-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .card-header-custom {
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            color: white;
            padding: 2rem;
            border: none;
        }
        .table { margin-bottom: 0; }
        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #eee;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
            padding: 1.5rem;
        }
        .table tbody td {
            padding: 1.5rem;
            vertical-align: middle;
            border-bottom: 1px solid #eee;
        }
        .badge-kategori {
            background: rgba(255, 75, 43, 0.1);
            color: #ff4b2b;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.75rem;
        }
        .price-tag { font-weight: 600; color: #2d3436; }
        .stock-indicator {
            width: 8px; height: 8px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }
        /* Style Profil Dropdown */
        .profile-btn {
            background: white;
            border: none;
            padding: 5px 15px 5px 5px;
            border-radius: 50px;
            transition: 0.3s;
        }
        .profile-btn:hover {
            background: #fdfdfd;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .modal-content { border-radius: 20px; border: none; }
        .modal-header { border-bottom: none; padding-top: 2rem; }
        .modal-footer { border-top: none; padding-bottom: 2rem; }
    </style>
</head>
<body>

<div class="container py-5">
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-pill px-4 mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row mb-4 align-items-center">
        <div class="col">
            <h1 class="fw-bold mb-0">
                <i class="fas fa-boxes-stacked me-2"></i> Inventori <span style="color: #ff4b2b;">StockSense</span>
            </h1>
            <p class="text-muted mb-0">Kelola stok makanan dan minuman kamu dengan lebih mudah.</p>
        </div>

        <div class="col-auto d-flex align-items-center">
            <div class="dropdown me-3">
                <button class="profile-btn shadow-sm d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name=Agnes+Refilina&background=ff4b2b&color=fff&bold=true" 
                         class="rounded-circle me-2" width="38" alt="User Avatar">
                    <div class="text-start d-none d-md-block">
                        <small class="text-muted d-block" style="font-size: 0.65rem; line-height: 1;">Administrator</small>
                        <span class="fw-bold small">Agnes Refilina</span>
                    </div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-2" style="border-radius: 15px;">
                    <li class="px-3 py-2">
                        <h6 class="mb-0 fw-bold small">Agnes Refilina Fiska</h6>
                        <small class="text-muted">Informatika - Telkom Univ</small>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item rounded-3 fw-bold small" href="/profile">
                            <i class="fas fa-user-circle me-2 text-primary"></i> Lihat Profil Saya
                        </a>
                    </li>
                    <li>
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item rounded-3 fw-bold small text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

            <a href="/inventori/create" class="btn btn-primary rounded-pill px-4 shadow py-2">
                <i class="fas fa-plus me-2"></i> Tambah Produk
            </a>
        </div>
    </div>

    <div class="card main-card">
        <div class="card-header-custom d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-list me-2"></i> Daftar Produk Aktif</h5>
            <span class="badge bg-white text-danger rounded-pill">{{ count($products) }} Total Item</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><i class="fas fa-tag me-2"></i> Nama Produk</th>
                        <th><i class="fas fa-layer-group me-2"></i> Kategori</th>
                        <th><i class="fas fa-money-bill-wave me-2"></i> Harga Satuan</th>
                        <th><i class="fas fa-cubes me-2"></i> Stok</th>
                        <th class="text-center"><i class="fas fa-cog"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $p)
                    <tr>
                        <td class="fw-bold">{{ $p->nama_produk }}</td>
                        <td><span class="badge-kategori">{{ $p->kategori }}</span></td>
                        <td><span class="price-tag">Rp {{ number_format($p->harga, 0, ',', '.') }}</span></td>
                        <td>
                            <span class="stock-indicator {{ $p->stok > 10 ? 'bg-success' : 'bg-warning' }}"></span>
                            {{ $p->stok }} <small class="text-muted">pcs</small>
                        </td>
                        <td class="text-center">
                            <a href="/inventori/{{ $p->id }}/edit" class="btn btn-light btn-sm rounded-circle shadow-sm me-1">
                                <i class="fas fa-edit text-primary"></i>
                            </a>

                            <button type="button" class="btn btn-light btn-sm rounded-circle shadow-sm" onclick="confirmDelete({{ $p->id }}, '{{ $p->nama_produk }}')">
                                <i class="fas fa-trash text-danger"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <p class="text-center mt-4 text-muted small">© 2026 StockSense Portfolio - Agnes Refilina Fiska</p>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header justify-content-center">
                <div class="text-center">
                    <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                    <h5 class="modal-title fw-bold" id="exampleModalLabel">Hapus Produk?</h5>
                </div>
            </div>
            <div class="modal-body text-center">
                Apakah kamu yakin ingin menghapus produk <span id="productName" class="fw-bold"></span> secara permanen?
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-4 shadow">Ya, Hapus!</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function confirmDelete(id, name) {
        document.getElementById('productName').innerText = name;
        document.getElementById('deleteForm').action = '/inventori/' + id;
        var myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        myModal.show();
    }
</script>

</body>
</html>