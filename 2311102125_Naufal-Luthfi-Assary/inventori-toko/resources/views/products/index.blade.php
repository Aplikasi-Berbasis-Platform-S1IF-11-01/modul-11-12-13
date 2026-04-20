@extends('layouts.app')

@section('content')
<div class="card hero-card mb-4">
    <div class="card-body p-4 p-md-5">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="badge-soft mb-3 d-inline-block">Dashboard Inventori</span>
                <h1 class="display-6 fw-bold mb-3">Kelola stok Toko</h1>
                <p class="mb-4 text-white-50">Pantau produk, kategori, dan stok barang.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('products.create') }}" class="btn btn-light btn-modern px-4 py-3 fw-semibold">
                        <i class="bi bi-plus-lg me-2"></i>Tambah Produk
                    </a>
                    <span class="soft-panel px-3 py-2 d-inline-flex align-items-center">
                        <span class="floating-dot"></span>
                        <span class="mini-label">Sistem aktif dan siap digunakan</span>
                    </span>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="soft-panel p-4">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-white bg-opacity-10">
                                <div class="mini-label mb-1">Total Produk</div>
                                <h3 class="fw-bold mb-0">{{ $products->count() }}</h3>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-white bg-opacity-10">
                                <div class="mini-label mb-1">Total Stok</div>
                                <h3 class="fw-bold mb-0">{{ $products->sum('stok') }}</h3>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-3 rounded-4 bg-white bg-opacity-10 d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="mini-label mb-1">Kategori</div>
                                    <h4 class="fw-bold mb-0">{{ $products->pluck('kategori')->unique()->count() }}</h4>
                                </div>
                                <i class="bi bi-box-seam fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card stat-card h-100 glass-card">
            <div class="card-body d-flex align-items-center justify-content-between p-4">
                <div>
                    <p class="text-secondary mb-1">Total Produk</p>
                    <h3 class="fw-bold mb-0">{{ $products->count() }}</h3>
                </div>
                <div class="stat-icon" style="background:#e0e7ff; color:#4338ca;">
                    <i class="bi bi-box-seam"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stat-card h-100 glass-card">
            <div class="card-body d-flex align-items-center justify-content-between p-4">
                <div>
                    <p class="text-secondary mb-1">Total Stok</p>
                    <h3 class="fw-bold mb-0">{{ $products->sum('stok') }}</h3>
                </div>
                <div class="stat-icon" style="background:#dcfce7; color:#15803d;">
                    <i class="bi bi-cart-check"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stat-card h-100 glass-card">
            <div class="card-body d-flex align-items-center justify-content-between p-4">
                <div>
                    <p class="text-secondary mb-1">Kategori</p>
                    <h3 class="fw-bold mb-0">{{ $products->pluck('kategori')->unique()->count() }}</h3>
                </div>
                <div class="stat-icon" style="background:#cffafe; color:#0f766e;">
                    <i class="bi bi-tags"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card glass-card border-0">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
            <div>
                <h4 class="section-title mb-1">Data Produk</h4>
                <p class="section-subtle mb-0">Tabel interaktif untuk mempermudah pencarian dan pengelolaan produk.</p>
            </div>
            <div>
                <a href="{{ route('products.create') }}" class="btn btn-gradient btn-modern">
                    <i class="bi bi-plus-lg me-2"></i>Tambah
                </a>
            </div>
        </div>

        @if($products->count() > 0)
            <div class="table-responsive datatable-wrap">
                <table class="table table-modern align-middle" id="productsTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Deskripsi</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="product-name">
                                        <div class="product-avatar">{{ strtoupper(substr($product->nama_produk, 0, 1)) }}</div>
                                        <div>
                                            <div class="fw-semibold">{{ $product->nama_produk }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-category">{{ $product->kategori }}</span>
                                </td>
                                <td class="fw-semibold">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                <td>{{ $product->stok }}</td>
                                <td>
                                    <div class="text-secondary text-truncate-2" style="max-width: 260px;">
                                        {{ $product->deskripsi }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm btn-modern">
                                            <i class="bi bi-pencil-square me-1"></i>Edit
                                        </a>

                                        <button 
                                            type="button"
                                            class="btn btn-danger btn-sm btn-modern btn-delete"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            data-id="{{ $product->id }}"
                                            data-name="{{ $product->nama_produk }}">
                                            <i class="bi bi-trash me-1"></i>Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-box">
                <div class="mb-3" style="font-size:42px;">📦</div>
                <h5 class="fw-bold">Belum ada data produk</h5>
                <p class="text-secondary mb-3">Tambahkan produk pertama agar inventori toko mulai terisi.</p>
                <a href="{{ route('products.create') }}" class="btn btn-gradient btn-modern">Tambah Produk</a>
            </div>
        @endif
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius:20px; overflow:hidden;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body pt-2">
                Apakah kamu yakin ingin menghapus produk <strong id="deleteProductName"></strong>?
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light btn-modern" data-bs-dismiss="modal">Batal</button>

                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-modern">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@if($products->count() > 0)
    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#productsTable').DataTable({
                pageLength: 5,
                language: {
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                    paginate: {
                        previous: '<',
                        next: '>'
                    }
                }
            });

            $('.btn-delete').on('click', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');

                $('#deleteProductName').text(name);
                $('#deleteForm').attr('action', '/products/' + id);
            });
        });
    </script>
    @endpush
@endif