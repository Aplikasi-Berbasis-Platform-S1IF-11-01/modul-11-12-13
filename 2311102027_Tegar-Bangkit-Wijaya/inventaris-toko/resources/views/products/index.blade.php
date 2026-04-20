@extends('layouts.app')
@section('title', 'Kelola Produk')
@section('page-title', 'Kelola Produk')

@section('content')

{{-- Header --}}
<div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
    <div>
        <h5 class="fw-bold mb-0">Daftar Produk</h5>
        <p class="text-muted small mb-0">Kelola semua produk inventaris toko</p>
    </div>
    <a href="{{ route('products.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Produk
    </a>
</div>

{{-- Filter Card --}}
<div class="card mb-3">
    <div class="card-body py-3">
        <form action="{{ route('products.index') }}" method="GET" class="row g-2 align-items-end">
            <div class="col-12 col-md-4">
                <label class="form-label mb-1">Cari Produk</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control"
                           placeholder="Nama, kode, kategori..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-6 col-md-3">
                <label class="form-label mb-1">Kategori</label>
                <select name="kategori" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kat)
                    <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
                        {{ $kat }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-2">
                <label class="form-label mb-1">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua</option>
                    <option value="aktif"    {{ request('status') == 'aktif'    ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
            <div class="col-12 col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill">
                    <i class="bi bi-funnel me-1"></i>Filter
                </button>
                @if(request()->hasAny(['search','kategori','status']))
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-lg"></i>
                </a>
                @endif
            </div>
        </form>
    </div>
</div>

{{-- Table Card --}}
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h6 class="mb-0 fw-semibold">
            <i class="bi bi-table me-2 text-primary"></i>
            Tabel Produk
        </h6>
        <span class="badge bg-primary">{{ $products->total() }} Produk</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" id="productTable">
            <thead class="table-light">
                <tr>
                    <th class="text-center" width="45">#</th>
                    <th>Kode</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th class="text-center">Stok</th>
                    <th>Satuan</th>
                    <th class="text-end">Harga Beli</th>
                    <th class="text-end">Harga Jual</th>
                    <th class="text-center">Status</th>
                    <th class="text-center" width="130">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $i => $product)
                <tr>
                    <td class="text-center text-muted small">
                        {{ $products->firstItem() + $i }}
                    </td>
                    <td><code class="text-primary">{{ $product->kode_produk }}</code></td>
                    <td class="fw-medium" style="max-width:200px;">
                        {{ $product->nama_produk }}
                        @if(!empty($product->deskripsi))
                        <small class="d-block text-muted text-truncate" style="max-width:180px;">
                            {{ $product->deskripsi }}
                        </small>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-light text-dark border">{{ $product->kategori }}</span>
                    </td>
                    <td class="text-center">
                        @if($product->stok == 0)
                            <span class="badge" style="background:#fee2e2;color:#991b1b;">Habis</span>
                        @elseif($product->stok <= 10)
                            <span class="badge" style="background:#fff3cd;color:#856404;">
                                {{ $product->stok }} ⚠️
                            </span>
                        @else
                            <span class="badge" style="background:#d1fae5;color:#065f46;">
                                {{ $product->stok }}
                            </span>
                        @endif
                    </td>
                    <td class="text-muted small">{{ $product->satuan }}</td>
                    <td class="text-end small">{{ $product->harga_beli_format }}</td>
                    <td class="text-end small fw-semibold">{{ $product->harga_jual_format }}</td>
                    <td class="text-center">
                        <span class="badge px-2 py-1 {{ $product->status === 'aktif' ? 'badge-aktif' : 'badge-nonaktif' }}">
                            {{ ucfirst($product->status) }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="d-flex gap-1 justify-content-center">
                            {{-- Detail --}}
                            <a href="{{ route('products.show', $product) }}"
                               class="btn btn-sm btn-outline-info" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            {{-- Edit --}}
                            <a href="{{ route('products.edit', $product) }}"
                               class="btn btn-sm btn-outline-warning" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            {{-- Hapus --}}
                            <button type="button"
                                class="btn btn-sm btn-outline-danger btn-hapus"
                                title="Hapus"
                                data-id="{{ $product->id }}"
                                data-nama="{{ $product->nama_produk }}"
                                data-kode="{{ $product->kode_produk }}"
                                data-bs-toggle="modal"
                                data-bs-target="#modalHapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center py-5">
                        <div class="text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            Tidak ada produk ditemukan.
                            <br>
                            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm mt-2">
                                <i class="bi bi-plus me-1"></i>Tambah Produk
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($products->hasPages())
    <div class="card-footer d-flex align-items-center justify-content-between flex-wrap gap-2">
        <small class="text-muted">
            Menampilkan {{ $products->firstItem() }}–{{ $products->lastItem() }}
            dari {{ $products->total() }} produk
        </small>
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

{{-- ── Modal Konfirmasi Hapus ───────────────────────────────────────── --}}
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
                    <p class="fw-bold fs-6 mb-0" id="modalNamaProduk">—</p>
                    <code id="modalKodeProduk" class="text-danger">—</code>
                </div>
                <div class="alert alert-warning d-flex gap-2 align-items-start py-2 small">
                    <i class="bi bi-info-circle-fill mt-1 flex-shrink-0"></i>
                    <div>Tindakan ini <strong>tidak dapat dibatalkan</strong>. Data produk akan terhapus secara permanen dari sistem.</div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    <i class="bi bi-x me-1"></i>Batal
                </button>
                <form id="formHapus" method="POST" style="display:inline;">
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

@push('scripts')
<script>
    // DataTable init (untuk sorting, built-in search ditambahkan)
    // Kita pakai server-side pagination dari Laravel, jadi DataTable hanya untuk sorting
    $('#productTable').DataTable({
        paging:   false,      // matikan paging DT (pakai paging Laravel)
        info:     false,
        searching: false,     // pakai filter form sendiri
        ordering: true,
        language: {
            emptyTable: 'Tidak ada data produk.',
        }
    });

    // Modal hapus: isi data dinamis
    document.querySelectorAll('.btn-hapus').forEach(btn => {
        btn.addEventListener('click', function () {
            const id   = this.dataset.id;
            const nama = this.dataset.nama;
            const kode = this.dataset.kode;

            document.getElementById('modalNamaProduk').textContent = nama;
            document.getElementById('modalKodeProduk').textContent  = kode;
            document.getElementById('formHapus').action =
                '{{ route("products.destroy", ":id") }}'.replace(':id', id);
        });
    });
</script>
@endpush
