<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Toko Aimar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f3f4f6; 
            color: #1f2937;
        }
        
        /* Navbar Modern */
        .navbar-custom {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
        }
        .navbar-brand-text {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }

        /* Widget Cards */
        .stat-card {
            border: none;
            border-radius: 1rem;
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }

        /* Table Card */
        .main-card {
            border: none;
            border-radius: 1.2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }
        .card-header-custom {
            background-color: #ffffff;
            border-bottom: 1px solid #f3f4f6;
            border-radius: 1.2rem 1.2rem 0 0 !important;
            padding: 1.5rem;
        }

        /* Table Styling */
        .table > :not(caption) > * > * {
            padding: 1rem 1.5rem;
            border-bottom-color: #f3f4f6;
        }
        .table > thead {
            background-color: #f9fafb;
        }
        .table > thead th {
            color: #6b7280;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: none;
        }

        /* Soft Action Buttons */
        .btn-action {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            border: none;
            transition: all 0.2s;
        }
        .btn-edit { background-color: #fef3c7; color: #d97706; }
        .btn-edit:hover { background-color: #fde68a; color: #b45309; }
        .btn-delete { background-color: #fee2e2; color: #dc2626; }
        .btn-delete:hover { background-color: #fecaca; color: #b91c1c; }

        /* Custom DataTables Elements */
        div.dataTables_wrapper div.dataTables_filter input {
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        div.dataTables_wrapper div.dataTables_filter input:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        .page-item.active .page-link {
            background-color: #3b82f6;
            border-color: #3b82f6;
            border-radius: 0.25rem;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-custom py-3 mb-4 sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <div class="bg-primary text-white rounded p-2 me-2 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                    <i class="bi bi-box-seam-fill"></i>
                </div>
                <span class="navbar-brand-text fs-4">Toko Aimar</span>
            </a>
            
            <div class="d-flex align-items-center gap-3">
                <div class="d-none d-md-flex align-items-center gap-2">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=eff6ff&color=1d4ed8" class="rounded-circle" width="35" alt="Avatar">
                    <div>
                        <div class="fw-semibold lh-1" style="font-size: 0.9rem;">{{ auth()->user()->name ?? 'Administrator' }}</div>
                        <div class="text-muted" style="font-size: 0.75rem;">Staff Gudang</div>
                    </div>
                </div>
                <div class="vr mx-2 d-none d-md-block"></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-light border-0 text-danger rounded-pill px-3 fw-medium hover-shadow">
                        <i class="bi bi-box-arrow-right me-1"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    @php
        $totalProduk = $products->count();
        $stokMenipis = $products->where('stok', '<', 10)->count();
        $totalNilaiAset = $products->sum(function($item) { return $item->harga * $item->stok; });
    @endphp

    <div class="container mb-5">
        
        <div class="mb-4">
            <h3 class="fw-bold mb-1">Dashboard Toko Mas Aimar</h3>
            <p class="text-muted">Kelola inventaris dan pantau ketersediaan barang toko dengan mudah.</p>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card stat-card shadow-sm h-100 bg-white">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3">
                            <i class="bi bi-box2-fill fs-3"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0 fw-medium" style="font-size: 0.85rem;">Total Jenis Produk</p>
                            <h3 class="fw-bold mb-0">{{ $totalProduk }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card shadow-sm h-100 bg-white">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-danger bg-opacity-10 text-danger rounded-circle p-3 me-3">
                            <i class="bi bi-exclamation-triangle-fill fs-3"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0 fw-medium" style="font-size: 0.85rem;">Stok Menipis (< 10)</p>
                            <h3 class="fw-bold mb-0">{{ $stokMenipis }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card shadow-sm h-100 bg-white">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 text-success rounded-circle p-3 me-3">
                            <i class="bi bi-cash-stack fs-3"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0 fw-medium" style="font-size: 0.85rem;">Estimasi Nilai Aset</p>
                            <h4 class="fw-bold mb-0">Rp {{ number_format($totalNilaiAset, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success bg-white border-success border-start border-0 border-4 shadow-sm py-3 d-flex align-items-center rounded-3 mb-4" role="alert">
                <i class="bi bi-check-circle-fill text-success fs-4 me-3"></i>
                <div>
                    <strong>Berhasil!</strong><br>
                    <span class="text-muted">{{ session('success') }}</span>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card main-card bg-white">
            <div class="card-header-custom d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h5 class="fw-bold mb-0">Daftar Produk</h5>
                    <small class="text-muted">Data stok otomatis diupdate secara real-time</small>
                </div>
                <a href="{{ route('products.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm fw-medium">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Produk
                </a>
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive p-4">
                    <table id="tabelProduk" class="table table-hover align-middle w-100">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th>Informasi Produk</th>
                                <th>Harga Satuan</th>
                                <th class="text-center">Ketersediaan</th>
                                <th width="12%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $item)
                            <tr>
                                <td class="text-center fw-medium text-muted">{{ $index + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $item->nama_produk }}</div>
                                    <div class="text-muted" style="font-size: 0.8rem;">ID: PRD-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</div>
                                </td>
                                <td class="fw-medium text-secondary">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    @if($item->stok < 10)
                                        <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2 border border-danger border-opacity-25">
                                            <i class="bi bi-arrow-down-circle me-1"></i> {{ $item->stok }} tersisa
                                        </span>
                                    @else
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 border border-success border-opacity-25">
                                            <i class="bi bi-check-circle me-1"></i> {{ $item->stok }} unit
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('products.edit', $item->id) }}" class="btn-action btn-edit" title="Edit Data">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button type="button" class="btn-action btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}" title="Hapus Data">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4 border-0 shadow-lg">
                                        <div class="modal-body text-center p-5">
                                            <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-inline-flex p-4 mb-4">
                                                <i class="bi bi-trash3 fs-1"></i>
                                            </div>
                                            <h4 class="fw-bold mb-3">Hapus Produk?</h4>
                                            <p class="text-muted mb-4">Data <strong>{{ $item->nama_produk }}</strong> akan dihapus permanen. Aksi ini tidak dapat dibatalkan.</p>
                                            <div class="d-flex gap-3 justify-content-center">
                                                <button type="button" class="btn btn-light rounded-pill px-4 py-2 fw-medium" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('products.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger rounded-pill px-4 py-2 fw-medium shadow-sm">Ya, Hapus Data</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#tabelProduk').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
                    search: "_INPUT_",
                    searchPlaceholder: "Cari produk..."
                },
                columnDefs: [
                    { orderable: false, targets: 4 }
                ],
                dom: "<'row mb-3'<'col-md-6'l><'col-md-6 d-flex justify-content-end'f>>" +
                     "<'row'<'col-sm-12'tr>>" +
                     "<'row mt-3'<'col-md-5'i><'col-md-7'p>>",
            });
        });
    </script>
</body>
</html>