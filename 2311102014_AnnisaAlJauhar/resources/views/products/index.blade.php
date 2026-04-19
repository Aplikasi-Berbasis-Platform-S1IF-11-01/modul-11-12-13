@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-4">
        <div class="stat-card pink">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size:0.85rem; opacity:0.9;">Total Produk</div>
                    <div style="font-size:2rem; font-weight:700;">{{ \App\Models\Product::count() }}</div>
                </div>
                <i class="fas fa-boxes" style="font-size:2.5rem; opacity:0.5;"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card rose">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size:0.85rem; opacity:0.9;">Total Stok</div>
                    <div style="font-size:2rem; font-weight:700;">{{ \App\Models\Product::sum('stock') }}</div>
                </div>
                <i class="fas fa-warehouse" style="font-size:2.5rem; opacity:0.5;"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card light">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size:0.85rem; opacity:0.9;">Total Nilai Stok</div>
                    <div style="font-size:1.5rem; font-weight:700;">
                        Rp {{ number_format(\App\Models\Product::selectRaw('SUM(stock * price) as total')->value('total'), 0, ',', '.') }}
                    </div>
                </div>
                <i class="fas fa-money-bill-wave" style="font-size:2.5rem; opacity:0.5;"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Produk</h5>
        <a href="{{ route('products.create') }}" class="btn btn-light btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah Produk
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="mb-3 d-flex justify-content-between align-items-center">
            <form action="{{ route('products.index') }}" method="GET" class="d-flex gap-2">
                <input type="text" name="search" class="form-control form-control-sm"
                    placeholder="Cari produk atau kategori..." value="{{ $search }}" style="width:250px;">
                <button class="btn btn-sm btn-primary">
                    <i class="fas fa-search me-1"></i>Cari
                </button>
                @if($search)
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                @endif
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle" id="productTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $index => $product)
                    <tr>
                        <td>{{ $products->firstItem() + $index }}</td>
                        <td>
                            <div class="fw-semibold">{{ $product->name }}</div>
                            <small class="text-muted">{{ Str::limit($product->description, 40) }}</small>
                        </td>
                        <td><span class="badge-category">{{ $product->category }}</span></td>
                        <td>
                            <span class="fw-bold {{ $product->stock < 10 ? 'text-danger' : 'text-success' }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td>{{ $product->unit }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $product->id }}, '{{ $product->name }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fas fa-box-open fa-2x mb-2 d-block"></i>
                            Tidak ada produk ditemukan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">
                Menampilkan {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }}
                dari {{ $products->total() }} produk
            </small>
            {{ $products->appends(['search' => $search])->links() }}
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px; border:none;">
            <div class="modal-header" style="background: linear-gradient(90deg, #c2185b, #e91e8c); border-radius:16px 16px 0 0;">
                <h5 class="modal-title text-white"><i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                <p class="mb-1">Apakah kamu yakin ingin menghapus produk:</p>
                <p class="fw-bold fs-5" id="deleteProductName" style="color:#c2185b;"></p>
                <small class="text-muted">Data yang dihapus tidak bisa dikembalikan!</small>
            </div>
            <div class="modal-footer justify-content-center border-0 pb-4">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Batal
                </button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                    <i class="fas fa-trash me-1"></i> Ya, Hapus!
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let deleteId = null;

    function confirmDelete(id, name) {
        deleteId = id;
        document.getElementById('deleteProductName').textContent = name;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }

    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        if (deleteId) {
            document.getElementById('delete-form-' + deleteId).submit();
        }
    });
</script>
@endpush