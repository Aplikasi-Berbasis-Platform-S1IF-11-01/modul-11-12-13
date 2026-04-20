@extends('layouts.app')

@section('title', 'Manajemen Produk')
@section('page-title', 'Manajemen Produk')

@section('content')

    {{-- ── STAT CARDS ─────────────────────────── --}}
    <div class="row g-3 mb-4">
        @php
            $totalProduk = \App\Models\Product::count();
            $totalStok = \App\Models\Product::sum('stock');
            $stokMenipis = \App\Models\Product::whereColumn('stock', '<=', 'min_stock')->count();
            $nilaiInventar = \App\Models\Product::selectRaw('SUM(stock * buy_price) as total')->value('total');
        @endphp

        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon blue"><i class="bi bi-box-seam"></i></div>
                <div>
                    <div class="stat-val">{{ number_format($totalProduk) }}</div>
                    <div class="stat-label">Total Produk</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon green"><i class="bi bi-archive"></i></div>
                <div>
                    <div class="stat-val">{{ number_format($totalStok) }}</div>
                    <div class="stat-label">Total Item Stok</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon red"><i class="bi bi-exclamation-triangle"></i></div>
                <div>
                    <div class="stat-val {{ $stokMenipis > 0 ? 'text-danger' : '' }}">{{ $stokMenipis }}</div>
                    <div class="stat-label">Stok Menipis</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon yellow"><i class="bi bi-currency-dollar"></i></div>
                <div>
                    <div class="stat-val" style="font-size:16px;">Rp {{ number_format($nilaiInventar, 0, ',', '.') }}</div>
                    <div class="stat-label">Nilai Inventaris</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── PRODUCT TABLE CARD ─────────────────── --}}
    <div class="card">
        <div class="card-header d-flex flex-wrap align-items-center gap-3">
            <div>
                <h5 class="mb-0 fw-bold" style="font-size:16px;">Daftar Produk</h5>
                <small class="text-muted">{{ $products->total() }} produk ditemukan</small>
            </div>

            <div class="ms-auto d-flex gap-2 flex-wrap">
                {{-- Search --}}
                <form action="{{ route('products.index') }}" method="GET" class="d-flex gap-2">
                    @if($category)
                        <input type="hidden" name="category" value="{{ $category }}">
                    @endif
                    <input type="text" name="search" class="form-control" placeholder="Cari kode / nama / kategori..."
                        value="{{ $search }}" style="min-width:220px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i>
                    </button>
                    @if($search || $category)
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    @endif
                </form>

                {{-- Filter Kategori --}}
                <form action="{{ route('products.index') }}" method="GET">
                    @if($search)
                        <input type="hidden" name="search" value="{{ $search }}">
                    @endif
                    <select name="category" class="form-select" style="min-width:150px;" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ $category === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </form>

                {{-- Per Page --}}
                <form action="{{ route('products.index') }}" method="GET">
                    @if($search) <input type="hidden" name="search" value="{{ $search }}"> @endif
                    @if($category) <input type="hidden" name="category" value="{{ $category }}"> @endif
                    <select name="per_page" class="form-select" style="width:80px;" onchange="this.form.submit()">
                        @foreach([10, 25, 50] as $n)
                            <option value="{{ $n }}" {{ $perPage == $n ? 'selected' : '' }}>{{ $n }}</option>
                        @endforeach
                    </select>
                </form>

                {{-- Tambah Produk --}}
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Produk
                </a>
            </div>
        </div>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width:50px;">#</th>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th>Min. Stok</th>
                        <th>Margin</th>
                        <th style="width:130px; text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $index => $product)
                        <tr class="{{ $product->isLowStock() ? 'table-warning' : '' }}">
                            <td class="text-muted">{{ $products->firstItem() + $index }}</td>
                            <td>
                                <code style="font-size:12px; background:#f1f5f9; padding:2px 8px; border-radius:4px;">
                                        {{ $product->code }}
                                    </code>
                            </td>
                            <td>
                                <div class="fw-semibold" style="font-size:13.5px;">{{ $product->name }}</div>
                                @if($product->description)
                                    <div class="text-muted" style="font-size:12px;">
                                        {{ Str::limit($product->description, 50) }}
                                    </div>
                                @endif
                            </td>
                            <td><span class="badge-category">{{ $product->category }}</span></td>
                            <td class="text-muted">{{ $product->unit }}</td>
                            <td style="font-size:13px;">{{ $product->buy_price_formatted }}</td>
                            <td style="font-size:13px; font-weight:600; color:#059669;">{{ $product->sell_price_formatted }}
                            </td>
                            <td>
                                <span class="{{ $product->isLowStock() ? 'stock-low' : 'stock-ok' }}">
                                    {{ number_format($product->stock) }}
                                    @if($product->isLowStock())
                                        <i class="bi bi-exclamation-triangle-fill ms-1" title="Stok menipis!"></i>
                                    @endif
                                </span>
                            </td>
                            <td class="text-muted">{{ number_format($product->min_stock) }}</td>
                            <td>
                                <span
                                    class="badge {{ $product->margin >= 20 ? 'bg-success' : ($product->margin >= 10 ? 'bg-warning text-dark' : 'bg-secondary') }}"
                                    style="font-size:11px;">
                                    {{ $product->margin }}%
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex gap-1 justify-content-center">
                                    {{-- Edit --}}
                                    <a href="{{ route('products.edit', $product) }}"
                                        class="btn btn-sm btn-outline-primary btn-action" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    {{-- Delete --}}
                                    <button class="btn btn-sm btn-outline-danger btn-action" title="Hapus"
                                        onclick="confirmDelete({{ $product->id }}, '{{ addslashes($product->name) }}')">
                                        <i class="bi bi-trash3"></i>
                                    </button>

                                    {{-- Hidden delete form --}}
                                    <form id="deleteForm-{{ $product->id }}" action="{{ route('products.destroy', $product) }}"
                                        method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-inbox"
                                        style="font-size:40px; display:block; margin-bottom:12px; opacity:0.4;"></i>
                                    <div style="font-size:15px; font-weight:600;">Tidak ada produk ditemukan</div>
                                    <div style="font-size:13px; margin-top:6px;">
                                        @if($search || $category)
                                            Coba ubah kata kunci pencarian atau filter kategori.
                                        @else
                                            Belum ada produk. <a href="{{ route('products.create') }}">Tambah sekarang</a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
            <div
                class="card-footer bg-white border-top d-flex align-items-center justify-content-between flex-wrap gap-2 py-3 px-4">
                <div class="text-muted" style="font-size:13px;">
                    Menampilkan {{ $products->firstItem() }}–{{ $products->lastItem() }} dari {{ $products->total() }} produk
                </div>
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

    {{-- ══ DELETE CONFIRMATION MODAL ══ --}}
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:14px; border:none; overflow:hidden;">
                <div class="modal-header border-0 pb-0 pt-4 px-4">
                    <div class="text-center w-100">
                        <div
                            style="width:60px; height:60px; background:#fee2e2; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px; font-size:26px;">
                            🗑️
                        </div>
                        <h5 class="modal-title fw-bold" style="font-size:18px;">Hapus Produk?</h5>
                    </div>
                </div>
                <div class="modal-body text-center px-4 pb-0">
                    <p class="text-muted" style="font-size:14px;">
                        Anda akan menghapus produk:<br>
                        <strong id="deleteProductName" class="text-dark"></strong>
                    </p>
                    <div class="alert alert-danger py-2 px-3 mt-2 d-flex align-items-center gap-2" style="font-size:13px;">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        Tindakan ini tidak dapat dibatalkan!
                    </div>
                </div>
                <div class="modal-footer border-0 pt-2 pb-4 px-4 justify-content-center gap-2">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> Batal
                    </button>
                    <button type="button" class="btn btn-danger px-4" id="confirmDeleteBtn">
                        <i class="bi bi-trash3 me-1"></i> Ya, Hapus!
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        let deleteFormId = null;
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));

        function confirmDelete(productId, productName) {
            deleteFormId = productId;
            document.getElementById('deleteProductName').textContent = productName;
            deleteModal.show();
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (deleteFormId) {
                document.getElementById('deleteForm-' + deleteFormId).submit();
            }
        });
    </script>
@endpush