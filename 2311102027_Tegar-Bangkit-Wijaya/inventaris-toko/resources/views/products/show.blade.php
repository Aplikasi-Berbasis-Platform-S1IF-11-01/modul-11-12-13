@extends('layouts.app')
@section('title', 'Detail Produk')
@section('page-title', 'Detail Produk')

@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h5 class="fw-bold mb-0">Detail Produk</h5>
        <p class="text-muted small mb-0">Informasi lengkap produk inventaris</p>
    </div>
    <div class="ms-auto d-flex gap-2">
        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">
            <i class="bi bi-pencil me-1"></i>Edit
        </a>
        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus">
            <i class="bi bi-trash me-1"></i>Hapus
        </button>
    </div>
</div>

<div class="row g-3">

    {{-- ── Info Utama ── --}}
    <div class="col-12 col-lg-8">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="mb-0 fw-semibold">
                    <i class="bi bi-box-seam me-2 text-primary"></i>Informasi Produk
                </h6>
                <span class="badge px-3 py-2 {{ $product->status === 'aktif' ? 'badge-aktif' : 'badge-nonaktif' }}">
                    {{ ucfirst($product->status) }}
                </span>
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr>
                            <td class="text-muted fw-medium" style="width:160px;">Kode Produk</td>
                            <td>: <code class="text-primary fs-6">{{ $product->kode_produk }}</code></td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-medium">Nama Produk</td>
                            <td>: <span class="fw-semibold">{{ $product->nama_produk }}</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-medium">Kategori</td>
                            <td>: <span class="badge bg-light text-dark border">{{ $product->kategori }}</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-medium">Satuan</td>
                            <td>: {{ $product->satuan }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-medium">Deskripsi</td>
                            <td>: {{ $product->deskripsi ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-medium">Ditambahkan</td>
                            <td>: {{ $product->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-medium">Diperbarui</td>
                            <td>: {{ $product->updated_at->format('d M Y, H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ── Stok & Harga ── --}}
    <div class="col-12 col-lg-4">
        <div class="card mb-3">
            <div class="card-header">
                <h6 class="mb-0 fw-semibold">
                    <i class="bi bi-boxes me-2 text-warning"></i>Stok
                </h6>
            </div>
            <div class="card-body text-center py-4">
                @if($product->stok == 0)
                    <div style="font-size:3rem; font-weight:800; color:#ef476f;">0</div>
                    <span class="badge" style="background:#fee2e2;color:#991b1b;">Stok Habis</span>
                @elseif($product->stok <= 10)
                    <div style="font-size:3rem; font-weight:800; color:#f59e0b;">{{ $product->stok }}</div>
                    <span class="badge" style="background:#fff3cd;color:#856404;">⚠️ Stok Hampir Habis</span>
                @else
                    <div style="font-size:3rem; font-weight:800; color:#059669;">{{ $product->stok }}</div>
                    <span class="badge" style="background:#d1fae5;color:#065f46;">Stok Tersedia</span>
                @endif
                <div class="text-muted small mt-1">{{ $product->satuan }}</div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h6 class="mb-0 fw-semibold">
                    <i class="bi bi-currency-dollar me-2 text-success"></i>Harga
                </h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                    <span class="text-muted small">Harga Beli</span>
                    <span class="fw-semibold">{{ $product->harga_beli_format }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                    <span class="text-muted small">Harga Jual</span>
                    <span class="fw-semibold text-success">{{ $product->harga_jual_format }}</span>
                </div>
                @php
                    $margin = $product->harga_beli > 0
                        ? (($product->harga_jual - $product->harga_beli) / $product->harga_beli * 100)
                        : 0;
                    $profit = $product->harga_jual - $product->harga_beli;
                @endphp
                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                    <span class="text-muted small">Margin</span>
                    <span class="fw-semibold {{ $margin >= 0 ? 'text-primary' : 'text-danger' }}">
                        {{ number_format($margin, 1) }}%
                    </span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                    <span class="text-muted small">Profit/Item</span>
                    <span class="fw-semibold {{ $profit >= 0 ? 'text-success' : 'text-danger' }}">
                        Rp {{ number_format($profit, 0, ',', '.') }}
                    </span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted small">Nilai Inventaris</span>
                    <span class="fw-bold text-dark">
                        Rp {{ number_format($product->harga_jual * $product->stok, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ── Modal Hapus ── --}}
<div class="modal fade" id="modalHapus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius:16px; overflow:hidden;">
            <div class="modal-header border-0 pb-0"
                 style="background:linear-gradient(135deg,#ef476f,#d62839); color:#fff;">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body pt-4 pb-2">
                <div class="text-center mb-3">
                    <div style="width:70px;height:70px;background:#fee2e2;border-radius:50%;
                                display:flex;align-items:center;justify-content:center;
                                margin:0 auto .75rem;font-size:2rem;color:#ef476f;">
                        <i class="bi bi-trash3-fill"></i>
                    </div>
                    <p class="mb-1">Anda yakin ingin menghapus produk:</p>
                    <p class="fw-bold fs-6 mb-0">{{ $product->nama_produk }}</p>
                    <code class="text-danger">{{ $product->kode_produk }}</code>
                </div>
                <div class="alert alert-warning d-flex gap-2 align-items-start py-2 small">
                    <i class="bi bi-info-circle-fill mt-1 flex-shrink-0"></i>
                    <div>Tindakan ini <strong>tidak dapat dibatalkan</strong>. Data produk akan terhapus secara permanen.</div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    <i class="bi bi-x me-1"></i>Batal
                </button>
                <form action="{{ route('products.destroy', $product) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>Ya, Hapus Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
