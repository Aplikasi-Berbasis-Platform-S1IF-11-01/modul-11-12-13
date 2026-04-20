@extends('layouts.app')

@section('title', 'Inventaris Produk')
@section('page-title', 'Inventaris Produk')

@section('content')

{{-- Stats Row --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#eff6ff;color:#2563eb"><i class="bi bi-box-seam-fill"></i></div>
                <div>
                    <div style="font-size:22px;font-weight:800;color:#0f172a">{{ $products->total() }}</div>
                    <div style="font-size:12px;color:#94a3b8">Total Produk</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#f0fdf4;color:#16a34a"><i class="bi bi-check-circle-fill"></i></div>
                <div>
                    <div style="font-size:22px;font-weight:800;color:#0f172a">{{ $products->getCollection()->where('stock', '>', 10)->count() }}</div>
                    <div style="font-size:12px;color:#94a3b8">Stok Aman</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#fffbeb;color:#d97706"><i class="bi bi-exclamation-triangle-fill"></i></div>
                <div>
                    <div style="font-size:22px;font-weight:800;color:#0f172a">{{ $products->getCollection()->where('stock', '>', 0)->where('stock', '<=', 10)->count() }}</div>
                    <div style="font-size:12px;color:#94a3b8">Stok Menipis</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#fef2f2;color:#dc2626"><i class="bi bi-x-circle-fill"></i></div>
                <div>
                    <div style="font-size:22px;font-weight:800;color:#0f172a">{{ $products->getCollection()->where('stock', 0)->count() }}</div>
                    <div style="font-size:12px;color:#94a3b8">Stok Habis</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Main Table Card --}}
<div class="card">
    <div class="card-header d-flex flex-column flex-md-row align-items-start align-items-md-center gap-3">
        <div class="fw-700" style="font-size:15px;font-weight:700;color:#0f172a">
            <i class="bi bi-table me-2 text-primary"></i>Daftar Produk
        </div>

        <div class="ms-auto d-flex flex-wrap gap-2">
            {{-- Search --}}
            <form method="GET" action="{{ route('products.index') }}" class="d-flex gap-2 flex-wrap">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <div class="input-group" style="width:220px">
                    <span class="input-group-text bg-white border-end-0" style="border-radius:8px 0 0 8px;border-color:#e2e8f0">
                        <i class="bi bi-search text-muted" style="font-size:13px"></i>
                    </span>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari produk..."
                        class="form-control border-start-0"
                        style="border-radius:0 8px 8px 0"
                    >
                </div>

                {{-- Filter Kategori --}}
                <select name="category" class="form-select" style="width:150px" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-outline-primary">
                    <i class="bi bi-funnel"></i>
                </button>

                @if(request('search') || request('category'))
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x"></i> Reset
                    </a>
                @endif
            </form>

            {{-- Tambah Produk --}}
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Tambah Produk
            </a>
        </div>
    </div>

    <div class="table-responsive">
        @if($products->isEmpty())
            <div class="empty-state">
                <i class="bi bi-box-seam"></i>
                <h5 style="color:#64748b">Produk tidak ditemukan</h5>
                <p style="font-size:14px">
                    @if(request('search') || request('category'))
                        Coba ubah kata kunci pencarian atau reset filter.
                    @else
                        Belum ada produk. Yuk tambahkan produk pertama!
                    @endif
                </p>
                @if(!request('search') && !request('category'))
                    <a href="{{ route('products.create') }}" class="btn btn-primary mt-2">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Produk
                    </a>
                @endif
            </div>
        @else
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'direction' => request('sort') === 'name' && request('direction') === 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none text-secondary">
                                Nama Produk
                                @if(request('sort') === 'name')
                                    <i class="bi bi-arrow-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </a>
                        </th>
                        <th>Kategori</th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'price', 'direction' => request('sort') === 'price' && request('direction') === 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none text-secondary">
                                Harga
                                @if(request('sort') === 'price')
                                    <i class="bi bi-arrow-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'stock', 'direction' => request('sort') === 'stock' && request('direction') === 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none text-secondary">
                                Stok
                                @if(request('sort') === 'stock')
                                    <i class="bi bi-arrow-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </a>
                        </th>
                        <th>Satuan</th>
                        <th width="130">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $i => $product)
                        <tr>
                            <td style="color:#94a3b8;font-size:13px">
                                {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                            </td>
                            <td>
                                <div style="font-weight:600;color:#0f172a">{{ $product->name }}</div>
                                @if($product->description)
                                    <div style="font-size:12px;color:#94a3b8" class="text-truncate" style="max-width:200px">
                                        {{ Str::limit($product->description, 50) }}
                                    </div>
                                @endif
                            </td>
                            <td><span class="badge-category">{{ $product->category }}</span></td>
                            <td style="font-weight:600">{{ $product->formatted_price }}</td>
                            <td>
                                @if($product->isOutOfStock())
                                    <span class="stock-empty"><i class="bi bi-x-circle me-1"></i>Habis</span>
                                @elseif($product->isLowStock())
                                    <span class="stock-low"><i class="bi bi-exclamation-triangle me-1"></i>{{ $product->stock }}</span>
                                @else
                                    <span class="stock-ok"><i class="bi bi-check-circle me-1"></i>{{ $product->stock }}</span>
                                @endif
                            </td>
                            <td style="color:#64748b;font-size:13px">{{ $product->unit }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('products.edit', $product) }}"
                                       class="btn btn-sm btn-outline-primary"
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-danger"
                                        title="Hapus"
                                        onclick="confirmDelete({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                    >
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    {{-- Pagination --}}
    @if($products->hasPages())
        <div class="card-footer bg-white border-top d-flex align-items-center justify-content-between flex-wrap gap-2" style="border-radius:0 0 14px 14px">
            <div style="font-size:13px;color:#64748b">
                Menampilkan {{ $products->firstItem() }}–{{ $products->lastItem() }} dari {{ $products->total() }} produk
            </div>
            {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;border:none">
            <div class="modal-body text-center p-4">
                <div style="width:64px;height:64px;background:#fef2f2;border-radius:50%;display:grid;place-items:center;margin:0 auto 16px;font-size:28px;color:#dc2626">
                    <i class="bi bi-trash3"></i>
                </div>
                <h5 style="font-weight:700;color:#0f172a;margin-bottom:8px">Hapus Produk?</h5>
                <p style="color:#64748b;font-size:14px;margin-bottom:0">
                    Yakin ingin menghapus produk <strong id="deleteProductName"></strong>?
                    <br>Data yang dihapus tidak bisa dikembalikan.
                </p>
            </div>
            <div class="modal-footer border-0 justify-content-center gap-2 pb-4">
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                    Batal
                </button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">
                        <i class="bi bi-trash me-1"></i> Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function confirmDelete(id, name) {
    document.getElementById('deleteProductName').textContent = name;
    document.getElementById('deleteForm').action = '/products/' + id;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endpush
