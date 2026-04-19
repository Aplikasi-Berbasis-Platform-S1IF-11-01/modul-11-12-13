@extends('layouts.app')
@section('title', 'Manajemen Produk')
@section('page-title', 'Manajemen Produk')

@section('content')

{{-- Stats Row --}}
<div class="row g-3 mb-4">
    @php
        $total    = \App\Models\Product::count();
        $inStock  = \App\Models\Product::inStock()->count();
        $lowStock = \App\Models\Product::where('stock', '>', 0)->where('stock', '<=', 10)->count();
        $outStock = \App\Models\Product::where('stock', 0)->count();
    @endphp
    <div class="col-6 col-md-3">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#dbeafe;color:#1d4ed8;"><i class="bi bi-box-seam"></i></div>
                <div><div class="fw-700 fs-4">{{ $total }}</div><div class="text-muted small">Total Produk</div></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#d1fae5;color:#065f46;"><i class="bi bi-check-circle"></i></div>
                <div><div class="fw-700 fs-4">{{ $inStock }}</div><div class="text-muted small">Tersedia</div></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#fef3c7;color:#92400e;"><i class="bi bi-exclamation-triangle"></i></div>
                <div><div class="fw-700 fs-4">{{ $lowStock }}</div><div class="text-muted small">Stok Menipis</div></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#fee2e2;color:#991b1b;"><i class="bi bi-x-circle"></i></div>
                <div><div class="fw-700 fs-4">{{ $outStock }}</div><div class="text-muted small">Habis</div></div>
            </div>
        </div>
    </div>
</div>

{{-- Table Card --}}
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between py-3">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-table text-primary"></i>
            <span>Daftar Produk</span>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Produk
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="productsTable" class="table table-hover align-middle w-100">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>SKU</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td class="text-muted small">{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-600">{{ $product->name }}</div>
                            @if($product->description)
                                <div class="text-muted small text-truncate" style="max-width:180px;">{{ $product->description }}</div>
                            @endif
                        </td>
                        <td><code class="small">{{ $product->sku }}</code></td>
                        <td>
                            <span class="badge rounded-pill" style="background:#e0f2fe;color:#0369a1;">
                                {{ $product->category }}
                            </span>
                        </td>
                        <td class="fw-600">{{ $product->formatted_price }}</td>
                        <td>
                            <span class="fw-600 {{ $product->stock === 0 ? 'text-danger' : ($product->stock <= 10 ? 'text-warning' : 'text-success') }}">
                                {{ number_format($product->stock) }}
                            </span>
                        </td>
                        <td>
                            @if($product->stock === 0)
                                <span class="badge badge-stock-out rounded-pill px-2 py-1"><i class="bi bi-x-circle me-1"></i>Habis</span>
                            @elseif($product->stock <= 10)
                                <span class="badge badge-stock-low rounded-pill px-2 py-1"><i class="bi bi-exclamation-triangle me-1"></i>Menipis</span>
                            @else
                                <span class="badge badge-stock-ok rounded-pill px-2 py-1"><i class="bi bi-check-circle me-1"></i>Tersedia</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger"
                                        title="Hapus"
                                        onclick="confirmDelete({{ $product->id }}, '{{ addslashes($product->name) }}')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            {{-- Hidden delete form --}}
                            <form id="delete-form-{{ $product->id }}"
                                  action="{{ route('admin.products.destroy', $product) }}"
                                  method="POST" class="d-none">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            Belum ada produk. <a href="{{ route('admin.products.create') }}">Tambah sekarang!</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted small">
                Menampilkan {{ $products->firstItem() }}–{{ $products->lastItem() }} dari {{ $products->total() }} produk
            </div>
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-700">
                    <i class="bi bi-trash text-danger me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body pt-2">
                <div class="bg-danger bg-opacity-10 rounded-3 p-3 mb-3">
                    <p class="mb-0 text-danger small">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        Tindakan ini tidak dapat dibatalkan!
                    </p>
                </div>
                <p class="mb-0">Apakah Anda yakin ingin menghapus produk <strong id="deleteProductName" class="text-danger"></strong>?</p>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg me-1"></i>Batal
                </button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                    <i class="bi bi-trash me-1"></i>Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    $('#productsTable').DataTable({
        pageLength: 10,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.8/i18n/id.json',
            emptyTable: "Tidak ada data produk",
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: { previous: "‹", next: "›" }
        },
        columnDefs: [{ orderable: false, targets: [7] }],
        order: [[0, 'asc']],
        dom: '<"row mb-3"<"col-sm-6"l><"col-sm-6"f>>t<"row mt-3"<"col-sm-6"i><"col-sm-6"p>>',
    });
});

let deleteId = null;
function confirmDelete(id, name) {
    deleteId = id;
    document.getElementById('deleteProductName').textContent = name;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
    if (deleteId) document.getElementById('delete-form-' + deleteId).submit();
});
</script>
@endsection
