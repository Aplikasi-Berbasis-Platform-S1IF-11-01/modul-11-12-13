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
        <div class="card">
            <div class="card-body d-flex align-items-center gap-3 py-3">
                <div class="stat-icon" style="background:var(--cream-100);color:var(--cream-600);">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div>
                    <div style="font-size:1.5rem;font-weight:600;color:var(--brown-text);line-height:1.1;">{{ $total }}</div>
                    <div style="font-size:.73rem;color:var(--muted-text);">Total Produk</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card">
            <div class="card-body d-flex align-items-center gap-3 py-3">
                <div class="stat-icon" style="background:#eef7e8;color:#3a7d2a;">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div>
                    <div style="font-size:1.5rem;font-weight:600;color:var(--brown-text);line-height:1.1;">{{ $inStock }}</div>
                    <div style="font-size:.73rem;color:var(--muted-text);">Tersedia</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card">
            <div class="card-body d-flex align-items-center gap-3 py-3">
                <div class="stat-icon" style="background:#fdf6e3;color:#8a5a00;">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <div>
                    <div style="font-size:1.5rem;font-weight:600;color:var(--brown-text);line-height:1.1;">{{ $lowStock }}</div>
                    <div style="font-size:.73rem;color:var(--muted-text);">Stok Menipis</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card">
            <div class="card-body d-flex align-items-center gap-3 py-3">
                <div class="stat-icon" style="background:#fdf0f0;color:#b03030;">
                    <i class="bi bi-x-circle"></i>
                </div>
                <div>
                    <div style="font-size:1.5rem;font-weight:600;color:var(--brown-text);line-height:1.1;">{{ $outStock }}</div>
                    <div style="font-size:.73rem;color:var(--muted-text);">Habis</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Table Card --}}
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between py-3">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-table" style="color:var(--cream-500);"></i>
            <span>Daftar Produk</span>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm" style="border-radius:8px;">
            <i class="bi bi-plus-lg me-1"></i> Tambah
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="productsTable" class="table table-hover align-middle w-100">
                <thead>
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
                        <td style="color:var(--muted-text);font-size:.8rem;">{{ $loop->iteration }}</td>
                        <td>
                            <div style="font-weight:500;font-size:.88rem;">{{ $product->name }}</div>
                            @if($product->description)
                                <div style="color:var(--muted-text);font-size:.75rem;" class="text-truncate" style="max-width:180px;">{{ $product->description }}</div>
                            @endif
                        </td>
                        <td><code style="background:var(--cream-100);color:var(--cream-700);border-radius:4px;padding:2px 6px;font-size:.78rem;">{{ $product->sku }}</code></td>
                        <td>
                            <span class="badge rounded-pill" style="background:var(--cream-100);color:var(--cream-700);font-weight:500;font-size:.72rem;">
                                {{ $product->category }}
                            </span>
                        </td>
                        <td style="font-weight:500;font-size:.88rem;">{{ $product->formatted_price }}</td>
                        <td style="font-weight:500;font-size:.88rem;color:{{ $product->stock === 0 ? '#b03030' : ($product->stock <= 10 ? '#8a5a00' : '#3a7d2a') }};">
                            {{ number_format($product->stock) }}
                        </td>
                        <td>
                            @if($product->stock === 0)
                                <span class="badge badge-stock-out rounded-pill px-2"><i class="bi bi-x-circle me-1"></i>Habis</span>
                            @elseif($product->stock <= 10)
                                <span class="badge badge-stock-low rounded-pill px-2"><i class="bi bi-exclamation-triangle me-1"></i>Menipis</span>
                            @else
                                <span class="badge badge-stock-ok rounded-pill px-2"><i class="bi bi-check-circle me-1"></i>Tersedia</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="btn btn-sm btn-outline-primary" title="Edit" style="border-radius:7px;">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-sm" title="Hapus"
                                        style="border:1px solid #e8c0c0;color:#b03030;border-radius:7px;"
                                        onclick="confirmDelete({{ $product->id }}, '{{ addslashes($product->name) }}')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            <form id="delete-form-{{ $product->id }}"
                                  action="{{ route('admin.products.destroy', $product) }}"
                                  method="POST" class="d-none">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5" style="color:var(--muted-text);">
                            <i class="bi bi-inbox fs-1 d-block mb-2" style="opacity:.4;"></i>
                            Belum ada produk. <a href="{{ route('admin.products.create') }}" style="color:var(--cream-600);">Tambah sekarang!</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div style="font-size:.78rem;color:var(--muted-text);">
                Menampilkan {{ $products->firstItem() }}–{{ $products->lastItem() }} dari {{ $products->total() }} produk
            </div>
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius:14px;box-shadow:0 8px 40px rgba(61,44,20,.15);">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title" style="font-family:'Playfair Display',serif;font-size:1rem;">
                    <i class="bi bi-trash me-2" style="color:#b03030;"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div style="background:#fdf0f0;border:1px solid #f0c0c0;border-radius:9px;padding:.75rem 1rem;margin-bottom:.9rem;">
                    <p class="mb-0" style="color:#b03030;font-size:.82rem;"><i class="bi bi-exclamation-triangle-fill me-1"></i>Tindakan ini tidak dapat dibatalkan!</p>
                </div>
                <p style="font-size:.88rem;margin:0;">Yakin ingin menghapus produk <strong id="deleteProductName" style="color:#b03030;"></strong>?</p>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-sm" id="confirmDeleteBtn"
                        style="background:#b03030;border-color:#b03030;color:#fff;">Ya, Hapus</button>
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