@extends('layouts.app')

@section('title', 'Manajemen Produk')
@section('page-title', 'Manajemen Produk')

@section('content')

{{-- STAT CARDS --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-4">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#eff6ff; color:#1d4ed8;"><i class="bi bi-box-seam"></i></div>
                <div>
                    <div class="stat-value">{{ $totalProducts }}</div>
                    <div class="stat-label">Total Produk</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#f0fdf4; color:#15803d;"><i class="bi bi-stack"></i></div>
                <div>
                    <div class="stat-value">{{ number_format($totalStock) }}</div>
                    <div class="stat-label">Total Stok</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#fff7ed; color:#c2410c;"><i class="bi bi-exclamation-triangle"></i></div>
                <div>
                    <div class="stat-value">{{ $lowStock }}</div>
                    <div class="stat-label">Stok Menipis / Habis</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- TABLE --}}
<div class="table-card">
    <div class="table-header">
        <div>
            <h6 class="mb-0" style="font-size:.95rem; font-weight:700; color:#0f172a;">Daftar Produk</h6>
            <small class="text-muted">Kelola semua produk toko</small>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-primary-custom">
            <i class="bi bi-plus-lg me-1"></i>Tambah Produk
        </a>
    </div>

    <div class="p-3">
        <div class="table-responsive">
            <table id="productsTable" class="table table-hover align-middle" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $index => $product)
                    <tr>
                        <td class="text-muted" style="font-size:.8rem;">{{ $index + 1 }}</td>
                        <td>
                            <span style="font-weight:600; color:#0f172a;">{{ $product->name }}</span>
                            @if($product->description)
                                <div class="text-muted" style="font-size:.75rem; max-width:200px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis;">
                                    {{ $product->description }}
                                </div>
                            @endif
                        </td>
                        <td><span class="badge-category">{{ $product->category }}</span></td>
                        <td style="font-weight:600;">{{ $product->formatted_price }}</td>
                        <td>{{ number_format($product->stock) }}</td>
                        <td class="text-muted">{{ $product->unit }}</td>
                        <td>
                            <span class="badge bg-{{ $product->stock_badge }}-subtle text-{{ $product->stock_badge }}"
                                style="border-radius:20px; padding:.3rem .7rem; font-size:.72rem; font-weight:600;">
                                {{ $product->stock_status }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="btn btn-sm"
                                    style="background:#f0f9ff; color:#0369a1; border-radius:7px; padding:.35rem .65rem;">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button type="button"
                                    class="btn btn-sm btn-delete"
                                    style="background:#fef2f2; color:#dc2626; border-radius:7px; padding:.35rem .65rem;"
                                    data-id="{{ $product->id }}"
                                    data-name="{{ $product->name }}">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox" style="font-size:2rem; display:block; margin-bottom:.5rem;"></i>
                            Belum ada produk. <a href="{{ route('products.create') }}">Tambah sekarang</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL DELETE --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:40px;height:40px;background:#fef2f2;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#dc2626;font-size:1.1rem;">
                        <i class="bi bi-trash3"></i>
                    </div>
                    <h5 class="modal-title fw-bold mb-0" style="color:#0f172a;">Konfirmasi Hapus</h5>
                </div>
            </div>
            <div class="modal-body pt-3">
                <p class="text-muted mb-1" style="font-size:.9rem;">Apakah kamu yakin ingin menghapus produk:</p>
                <p class="fw-bold mb-0" id="deleteProductName" style="color:#0f172a;"></p>
                <div class="mt-3 p-3" style="background:#fef2f2;border-radius:10px;font-size:.82rem;color:#b91c1c;">
                    <i class="bi bi-exclamation-circle me-1"></i>
                    Data yang dihapus <strong>tidak bisa dikembalikan</strong>.
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-sm px-4"
                    style="background:#f1f5f9;color:#475569;border-radius:8px;font-weight:600;"
                    data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger px-4" style="border-radius:8px;font-weight:600;">
                        <i class="bi bi-trash3 me-1"></i>Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#productsTable').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.8/i18n/id.json' },
            pageLength: 10,
            order: [[0, 'asc']],
            columnDefs: [{ orderable: false, targets: 7 }]
        });
    });

    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('deleteProductName').textContent = this.dataset.name;
            document.getElementById('deleteForm').action = `/products/${this.dataset.id}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        });
    });
</script>
@endpush