@extends('layouts.app')

@section('title', 'Daftar Produk')
@section('page-title', 'Manajemen Produk')
@section('page-subtitle', 'Kelola semua produk inventaris toko')

@section('content')

    {{-- ═══════════════════════════════════════════════
         STAT CARDS - Ringkasan Statistik Inventaris
    ═══════════════════════════════════════════════ --}}
    <div class="row g-3 mb-4">

        <!-- Total Produk -->
        <div class="col-6 col-md-3">
            <div class="stat-card" style="background: linear-gradient(135deg, #1a1a2e, #16213e);">
                <span class="stat-icon">📦</span>
                <div class="stat-value">{{ $stats['total_products'] }}</div>
                <div class="stat-label">Total Produk</div>
            </div>
        </div>

        <!-- Total Stok -->
        <div class="col-6 col-md-3">
            <div class="stat-card" style="background: linear-gradient(135deg, #0f3460, #1a6eb5);">
                <span class="stat-icon">🗃️</span>
                <div class="stat-value">{{ number_format($stats['total_stock']) }}</div>
                <div class="stat-label">Total Stok</div>
            </div>
        </div>

        <!-- Stok Menipis -->
        <div class="col-6 col-md-3">
            <div class="stat-card" style="background: linear-gradient(135deg, #c73652, #e94560);">
                <span class="stat-icon">⚠️</span>
                <div class="stat-value">{{ $stats['low_stock'] }}</div>
                <div class="stat-label">Stok Menipis</div>
            </div>
        </div>

        <!-- Jumlah Kategori -->
        <div class="col-6 col-md-3">
            <div class="stat-card" style="background: linear-gradient(135deg, #1d6f42, #27ae60);">
                <span class="stat-icon">🏷️</span>
                <div class="stat-value">{{ $stats['categories'] }}</div>
                <div class="stat-label">Kategori</div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════
         TABEL PRODUK (DataTable)
    ═══════════════════════════════════════════════ --}}
    <div class="card">
        <div class="card-header bg-white d-flex align-items-center justify-content-between py-3 px-4"
             style="border-bottom: 1px solid #e8eaed; border-radius: 16px 16px 0 0;">
            <div>
                <h5 class="mb-0 fw-bold" style="font-family: 'Syne', sans-serif; color: #1a1a2e;">
                    Daftar Produk
                </h5>
                <p class="text-muted mb-0" style="font-size: .8rem;">
                    Klik header kolom untuk mengurutkan data
                </p>
            </div>
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i>
                Tambah Produk
            </a>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="productsTable" class="table table-hover align-middle" style="width: 100%">
                    <thead>
                        <tr>
                            <th style="width: 50px">#</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th style="width: 130px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $index => $product)
                            <tr>
                                <td class="text-muted" style="font-size: .85rem;">
                                    {{ $index + 1 }}
                                </td>
                                <td>
                                    <div style="font-weight: 600; color: #1a1a2e;">
                                        {{ $product->name }}
                                    </div>
                                    @if($product->description)
                                        <div class="text-muted" style="font-size: .78rem;">
                                            {{ Str::limit($product->description, 50) }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border" style="font-size: .78rem;">
                                        {{ $product->category }}
                                    </span>
                                </td>
                                <td style="font-weight: 600; color: #1a1a2e;">
                                    {{ $product->formatted_price }}
                                </td>
                                <td>
                                    <span style="font-weight: 600;">{{ number_format($product->stock) }}</span>
                                    <span class="text-muted" style="font-size: .8rem;">unit</span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $product->stock_badge_class }}-subtle text-{{ $product->stock_badge_class }} border border-{{ $product->stock_badge_class }}-subtle">
                                        {{ $product->stock_status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('products.edit', $product->id) }}"
                                           class="btn btn-sm btn-outline-primary"
                                           title="Edit produk">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                        <!-- Tombol Delete (trigger modal) -->
                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Hapus produk"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"
                                                data-product-id="{{ $product->id }}"
                                                data-product-name="{{ $product->name }}">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div style="color: #888;">
                                        <i class="bi bi-inbox" style="font-size: 2.5rem; display: block; margin-bottom: 12px;"></i>
                                        <p class="mb-1 fw-600">Belum ada produk</p>
                                        <p style="font-size: .85rem;">
                                            <a href="{{ route('products.create') }}">Tambah produk pertama</a>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <!-- Custom Pagination Bar -->
                <div class="d-flex align-items-center justify-content-between mt-3 pt-3"
                    style="border-top: 1px solid #e8eaed;">
                    <span id="dt-info" class="dt-info"></span>
                    <div id="dt-pagination" class="dt-pagination"></div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════
         MODAL KONFIRMASI DELETE
         Muncul ketika tombol hapus diklik.
         Form submit menggunakan method spoofing (DELETE).
    ═══════════════════════════════════════════════ --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: none; border-radius: 16px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="deleteModalLabel" style="font-family: 'Syne', sans-serif; color: #1a1a2e;">
                        Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body py-4">
                    <!-- Icon peringatan -->
                    <div class="text-center mb-3">
                        <div style="
                            width: 64px; height: 64px;
                            background: #fef2f2;
                            border-radius: 50%;
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 1.8rem;
                        ">🗑️</div>
                    </div>

                    <p class="text-center mb-1" style="font-size: .95rem;">
                        Yakin ingin menghapus produk
                    </p>
                    <p class="text-center fw-bold mb-3" id="deleteProductName" style="color: #e94560; font-size: 1rem;">
                        —
                    </p>
                    <p class="text-center text-muted mb-0" style="font-size: .85rem;">
                        Tindakan ini tidak bisa dibatalkan dan data akan hilang permanen.
                    </p>
                </div>

                <div class="modal-footer border-0 pt-0 justify-content-center gap-2">
                    <!-- Tombol Batal -->
                    <button type="button"
                            class="btn btn-outline-secondary px-4"
                            style="border-radius: 10px;"
                            data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i>
                        Batal
                    </button>

                    <!-- Form Delete (method spoofing) -->
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-danger px-4"
                                style="border-radius: 10px; background: #e94560; border: none;">
                            <i class="bi bi-trash3 me-1"></i>
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    /* Custom Pagination */
    .dt-pagination {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .dt-page-btn {
        min-width: 36px;
        height: 36px;
        padding: 0 10px;
        border-radius: 8px;
        border: 1.5px solid #e8eaed;
        background: #fff;
        color: #1a1a2e;
        font-size: .85rem;
        font-weight: 500;
        cursor: pointer;
        transition: all .2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-family: 'DM Sans', sans-serif;
    }

    .dt-page-btn:hover {
        border-color: #e94560;
        color: #e94560;
        background: #fff5f7;
    }

    .dt-page-btn.active {
        background: #e94560;
        border-color: #e94560;
        color: #fff;
    }

    .dt-page-btn.disabled {
        opacity: .4;
        cursor: not-allowed;
        pointer-events: none;
    }

    .dt-page-btn.dots {
        border: none;
        background: none;
        cursor: default;
        color: #aaa;
    }

    .dt-info {
        font-size: .82rem;
        color: #888;
    }

    /* Override bawaan DataTables */
    .dataTables_paginate,
    .dataTables_info { display: none !important; }

    .dataTables_wrapper .dataTables_filter input {
        border-radius: 8px;
        border: 1.5px solid #e8eaed;
        padding: 6px 12px;
        font-family: 'DM Sans', sans-serif;
        outline: none;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #e94560;
        box-shadow: 0 0 0 3px rgba(233,69,96,.1);
    }

    .dataTables_wrapper .dataTables_length select {
        border-radius: 8px;
        border: 1.5px solid #e8eaed;
        padding: 4px 8px;
        font-family: 'DM Sans', sans-serif;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    const table = $('#productsTable').DataTable({
        language: {
            search:       'Cari:',
            lengthMenu:   'Tampilkan _MENU_ data',
            zeroRecords:  'Produk tidak ditemukan',
            emptyTable:   'Tidak ada data produk',
        },
        pageLength: 10,
        order: [[0, 'asc']],
        columnDefs: [
            { orderable: false, targets: 6 },
        ],
    });

    // ── Render Pagination Custom ──
    function renderPagination() {
        const info      = table.page.info();
        const current   = info.page;       // 0-based
        const total     = info.pages;
        const start     = info.start + 1;
        const end       = info.end;
        const allRows   = info.recordsDisplay;

        // Update info text
        $('#dt-info').html(
            `Menampilkan <strong>${start}–${end}</strong> dari <strong>${allRows}</strong> produk`
        );

        const $pag = $('#dt-pagination').empty();

        // Tombol Prev
        const $prev = $(`<button class="dt-page-btn ${current === 0 ? 'disabled' : ''}">
            <i class="bi bi-chevron-left"></i>
        </button>`).on('click', function() {
            if (current > 0) { table.page('previous').draw('page'); }
        });
        $pag.append($prev);

        // Tombol nomor halaman dengan ellipsis
        function addBtn(i) {
            const $btn = $(`<button class="dt-page-btn ${i === current ? 'active' : ''}">${i + 1}</button>`)
                .on('click', function() { table.page(i).draw('page'); });
            $pag.append($btn);
        }

        function addDots() {
            $pag.append(`<button class="dt-page-btn dots">…</button>`);
        }

        if (total <= 7) {
            for (let i = 0; i < total; i++) addBtn(i);
        } else {
            addBtn(0);
            if (current > 3) addDots();
            const from = Math.max(1, current - 1);
            const to   = Math.min(total - 2, current + 1);
            for (let i = from; i <= to; i++) addBtn(i);
            if (current < total - 4) addDots();
            addBtn(total - 1);
        }

        // Tombol Next
        const $next = $(`<button class="dt-page-btn ${current >= total - 1 ? 'disabled' : ''}">
            <i class="bi bi-chevron-right"></i>
        </button>`).on('click', function() {
            if (current < total - 1) { table.page('next').draw('page'); }
        });
        $pag.append($next);
    }

    // Re-render setiap kali tabel berubah (search, sort, page)
    table.on('draw', renderPagination);
    renderPagination();

    // ── Modal Delete ──
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function(event) {
        const button    = event.relatedTarget;
        const productId = button.getAttribute('data-product-id');
        const productName = button.getAttribute('data-product-name');
        document.getElementById('deleteProductName').textContent = '"' + productName + '"';
        document.getElementById('deleteForm').action = '/products/' + productId;
    });
});
</script>
@endpush