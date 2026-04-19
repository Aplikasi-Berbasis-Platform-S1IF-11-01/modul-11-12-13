@extends('layouts.app')

@section('title', 'Dashboard - Inventaris Toko')

@section('content')

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h4 class="page-title mb-1">📦 Kelola Produk</h4>
        <p class="page-subtitle mb-0">Inventaris Toko Mas Aimar — Semua produk tersedia di sini</p>
    </div>
    <a href="{{ route('products.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Produk
    </a>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #1e3a5f, #2d6a9f);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-number">{{ $totalProduk }}</div>
                    <div class="stat-label">Total Jenis Produk</div>
                </div>
                <div class="stat-icon"><i class="bi bi-box-seam"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #1a7a4a, #28a745);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-number">{{ number_format($totalStok) }}</div>
                    <div class="stat-label">Total Stok Keseluruhan</div>
                </div>
                <div class="stat-icon"><i class="bi bi-stack"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #7b2d00, #dc6b2f);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-number" style="font-size: 1.3rem;">Rp {{ number_format($totalNilai, 0, ',', '.') }}</div>
                    <div class="stat-label">Total Nilai Inventaris</div>
                </div>
                <div class="stat-icon"><i class="bi bi-cash-coin"></i></div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Produk -->
<div class="card">
    <div class="card-header py-3" style="background: linear-gradient(135deg, #1e3a5f, #2d6a9f);">
        <h6 class="mb-0 text-white fw-600">
            <i class="bi bi-table me-2"></i> Daftar Produk
        </h6>
    </div>
    <div class="card-body p-3">
        <table id="productTable" class="table table-hover table-bordered align-middle w-100">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Nama Produk</th>
                    <th style="width: 140px;">Kategori</th>
                    <th class="text-center" style="width: 80px;">Stok</th>
                    <th style="width: 140px;">Harga</th>
                    <th style="width: 160px;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $i => $product)
                <tr>
                    <td class="text-center text-muted">{{ $loop->iteration }}</td>
                    <td>
                        <div class="fw-500">{{ $product->nama_produk }}</div>
                        @if($product->deskripsi)
                            <small class="text-muted">{{ Str::limit($product->deskripsi, 60) }}</small>
                        @endif
                    </td>
                    <td>
                        @php
                            $colors = [
                                'Elektronik'      => 'primary',
                                'Pakaian'         => 'info',
                                'Makanan'         => 'success',
                                'Minuman'         => 'warning',
                                'Peralatan Rumah' => 'secondary',
                                'Alat Tulis'      => 'dark',
                                'Mainan'          => 'danger',
                                'Kosmetik'        => 'pink',
                            ];
                            $color = $colors[$product->kategori] ?? 'secondary';
                        @endphp
                        <span class="badge bg-{{ $color }} text-{{ $color === 'warning' ? 'dark' : 'white' }}">
                            {{ $product->kategori }}
                        </span>
                    </td>
                    <td class="text-center">
                        @if($product->stok <= 10)
                            <span class="badge bg-danger">{{ $product->stok }} ⚠️</span>
                        @elseif($product->stok <= 30)
                            <span class="badge bg-warning text-dark">{{ $product->stok }}</span>
                        @else
                            <span class="badge bg-success">{{ $product->stok }}</span>
                        @endif
                    </td>
                    <td>
                        <strong>Rp {{ number_format($product->harga, 0, ',', '.') }}</strong>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('products.show', $product) }}"
                           class="btn btn-info btn-sm text-white" title="Detail">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('products.edit', $product) }}"
                           class="btn btn-warning btn-sm" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button type="button"
                                class="btn btn-danger btn-sm"
                                title="Hapus"
                                onclick="confirmDelete({{ $product->id }}, '{{ addslashes($product->nama_produk) }}')">
                            <i class="bi bi-trash"></i>
                        </button>
                        <!-- Hidden form delete -->
                        <form id="delete-form-{{ $product->id }}"
                              action="{{ route('products.destroy', $product) }}"
                              method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Keterangan stok -->
<div class="mt-2 d-flex gap-3">
    <small><span class="badge bg-danger me-1">n</span> Stok kritis (≤10)</small>
    <small><span class="badge bg-warning text-dark me-1">n</span> Stok rendah (≤30)</small>
    <small><span class="badge bg-success me-1">n</span> Stok aman (>30)</small>
</div>

<!-- Modal Konfirmasi Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: none; overflow: hidden;">
            <div class="modal-header" style="background: linear-gradient(135deg, #dc3545, #c82333); border: none;">
                <h5 class="modal-title text-white" id="deleteModalLabel">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <div style="font-size: 4rem; margin-bottom: 1rem;">🗑️</div>
                <h5 class="fw-600 mb-2">Yakin mau hapus produk ini?</h5>
                <p class="text-muted mb-1">Produk: <strong id="deleteProductName" class="text-danger"></strong></p>
                <p class="text-muted" style="font-size: 0.875rem;">
                    Kalau dihapus, Mas Jakobi ga bisa belanja produk ini lagi di toko Mas Aimar 😅
                    <br>Data yang dihapus <strong>tidak bisa dikembalikan!</strong>
                </p>
            </div>
            <div class="modal-footer border-0 justify-content-center gap-2">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </button>
                <button type="button" class="btn btn-danger px-4" id="confirmDeleteBtn">
                    <i class="bi bi-trash me-1"></i> Ya, Hapus!
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Init DataTable
    $(document).ready(function () {
        $('#productTable').DataTable({
            language: {
                search: "🔍 Cari:",
                lengthMenu: "Tampilkan _MENU_ produk",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ produk",
                infoEmpty: "Tidak ada produk",
                infoFiltered: "(difilter dari _MAX_ total produk)",
                paginate: {
                    first: "«",
                    last: "»",
                    next: "›",
                    previous: "‹"
                },
                emptyTable: "Belum ada produk. Tambah produk dulu yuk!",
                zeroRecords: "Produk tidak ditemukan."
            },
            pageLength: 10,
            order: [[0, 'asc']],
            responsive: true,
            columnDefs: [
                { orderable: false, targets: [5] } // kolom Aksi tidak bisa di-sort
            ]
        });
    });

    // Konfirmasi hapus
    let currentDeleteId = null;

    function confirmDelete(id, nama) {
        currentDeleteId = id;
        document.getElementById('deleteProductName').textContent = nama;
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }

    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        if (currentDeleteId) {
            document.getElementById('delete-form-' + currentDeleteId).submit();
        }
    });
</script>
@endpush
