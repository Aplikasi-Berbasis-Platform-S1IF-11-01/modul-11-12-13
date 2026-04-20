@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')

{{-- Page Header --}}
<div class="d-flex align-items-start justify-content-between mb-4">
    <div>
        <h1 class="page-title">Inventori Produk</h1>
        <p class="page-subtitle">Toko Pak Cik & Mas Aimar</p>
    </div>
    <a href="{{ route('products.create') }}" class="btn-pink btn d-flex align-items-center gap-2">
        <i class="bi bi-plus-lg"></i> Tambah Produk
    </a>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon pink"><i class="bi bi-box-seam"></i></div>
            <div>
                <div class="stat-value">{{ $products->total() }}</div>
                <div class="stat-label">Total Produk</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon navy"><i class="bi bi-tags"></i></div>
            <div>
                <div class="stat-value">{{ $kategoris->count() }}</div>
                <div class="stat-label">Kategori</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon green"><i class="bi bi-bag-check"></i></div>
            <div>
                <div class="stat-value">{{ $products->where('stok', '>', 0)->count() }}</div>
                <div class="stat-label">Produk Tersedia</div>
            </div>
        </div>
    </div>
</div>

{{-- Table Card --}}
<div class="card">
    <div class="card-header-custom">
        <h5>
            <span class="icon-box"><i class="bi bi-table"></i></span>
            Daftar Produk
        </h5>

        {{-- Search & Filter --}}
        <form method="GET" action="{{ route('products.index') }}" class="d-flex gap-2 flex-wrap">
            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text" name="search" class="form-control" style="width:200px;"
                       placeholder="Cari produk..." value="{{ $search }}">
            </div>

            <select name="kategori" class="form-select" style="width:160px; font-size:0.875rem; border-radius:10px; border:1.5px solid #e2e8f0;">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $kat)
                    <option value="{{ $kat }}" {{ $kategori === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                @endforeach
            </select>

            <button type="submit" class="btn-navy btn">
                <i class="bi bi-funnel"></i> Filter
            </button>

            @if($search || $kategori)
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary" style="border-radius:10px; font-size:0.875rem;">
                    <i class="bi bi-x"></i> Reset
                </a>
            @endif
        </form>
    </div>

    <div class="table-custom table-responsive">
        <table class="table mb-0">
            <thead class="table-custom">
                <tr>
                    <th style="width:50px">#</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th style="width:130px; text-align:center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $index => $product)
                    <tr>
                        <td class="text-muted" style="font-size:0.8rem;">
                            {{ ($products->currentPage() - 1) * $products->perPage() + $index + 1 }}
                        </td>
                        <td>
                            <div class="fw-semibold" style="font-size:0.88rem;">{{ $product->nama_produk }}</div>
                        </td>
                        <td>
                            <span class="badge-kategori">{{ $product->kategori }}</span>
                        </td>
                        <td>
                            @if($product->stok == 0)
                                <span class="badge-stok empty">Habis</span>
                            @elseif($product->stok <= 10)
                                <span class="badge-stok low">{{ $product->stok }} (Low)</span>
                            @else
                                <span class="badge-stok ok">{{ $product->stok }}</span>
                            @endif
                        </td>
                        <td style="font-weight:600; color:#0f1f45;">
                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                        </td>
                        <td>
                            <span style="color:#6c757d; font-size:0.82rem;">
                                {{ $product->deskripsi ? \Illuminate\Support\Str::limit($product->deskripsi, 40) : '-' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="{{ route('products.edit', $product) }}"
                                   class="btn btn-outline-pink btn-sm" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button type="button"
                                        class="btn btn-outline-danger-soft btn-sm"
                                        title="Hapus"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        data-id="{{ $product->id }}"
                                        data-nama="{{ $product->nama_produk }}">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="bi bi-inbox" style="font-size:2.5rem; color:#ccc; display:block; margin-bottom:0.5rem;"></i>
                            <span style="color:#aaa; font-size:0.875rem;">
                                {{ $search || $kategori ? 'Produk tidak ditemukan. Coba ubah filter.' : 'Belum ada produk. Tambahkan sekarang!' }}
                            </span>
                            @if(!$search && !$kategori)
                                <br>
                                <a href="{{ route('products.create') }}" class="btn-pink btn mt-3 btn-sm">
                                    <i class="bi bi-plus-lg"></i> Tambah Produk
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($products->hasPages())
        <div class="d-flex align-items-center justify-content-between px-4 py-3"
             style="border-top:1px solid #e9ecef; background:white; border-radius: 0 0 16px 16px;">
            <small style="color:#6c757d; font-size:0.8rem;">
                Menampilkan {{ $products->firstItem() }}–{{ $products->lastItem() }} dari {{ $products->total() }} produk
            </small>
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

{{-- DELETE MODAL --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-3">
                    <div style="width:64px;height:64px;background:#fff1f2;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;margin-bottom:1rem;">
                        <i class="bi bi-trash3" style="font-size:1.8rem;color:#dc3545;"></i>
                    </div>
                    <h6 style="font-family:'Plus Jakarta Sans',sans-serif; font-weight:700; color:#0f1f45; margin-bottom:0.5rem;">
                        Yakin hapus produk ini?
                    </h6>
                    <p style="font-size:0.875rem; color:#6c757d; margin-bottom:0;">
                        Produk <strong id="deleteNama" style="color:#f72585;"></strong> akan dihapus permanen.<br>
                        Aksi ini tidak bisa dibatalkan.
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius:8px; font-size:0.875rem;">
                    Batal
                </button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="border-radius:8px; font-size:0.875rem; font-weight:600;">
                        <i class="bi bi-trash3 me-1"></i> Ya, Hapus!
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Set data modal delete
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const btn = event.relatedTarget;
        const id = btn.getAttribute('data-id');
        const nama = btn.getAttribute('data-nama');

        document.getElementById('deleteNama').textContent = nama;
        document.getElementById('deleteForm').action = '/products/' + id;
    });
</script>
@endsection
