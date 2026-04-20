@extends('layouts.app')

@section('title', 'Daftar Produk')
@section('page-title', 'Manajemen Produk')

@section('content')

<!-- Watermark: 2311102001-NofitaFitriyani -->

{{-- MAIN TABLE CARD --}}
<div class="card">
    <div class="card-header">
        <div class="card-title"><i class="fas fa-list" style="color:#0047ba;margin-right:8px;"></i>Daftar Produk</div>
        <a href="{{ route('products.create') }}" class="btn btn-red">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>
    </div>
    <div class="card-body" style="padding-bottom: 8px;">

        {{-- SEARCH & FILTER --}}
        <form method="GET" action="{{ route('products.index') }}" id="filter-form">
            <div class="search-bar" style="margin-bottom: 20px;">
                <div class="search-input-wrap">
                    <i class="fas fa-search"></i>
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari nama produk..."
                        value="{{ request('search') }}"
                        id="search-input"
                    >
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Cari
                </button>
                @if(request()->has('search'))
                    <a href="{{ route('products.index') }}" class="btn btn-outline">
                        <i class="fas fa-times"></i> Reset
                    </a>
                @endif
                {{-- preserve sort --}}
                @if(request('sort'))<input type="hidden" name="sort" value="{{ request('sort') }}">@endif
                @if(request('dir'))<input type="hidden" name="dir" value="{{ request('dir') }}">@endif
            </div>
        </form>

        {{-- TABLE --}}
        <div class="table-wrapper">
            <table>
                <thead>
                <tr>
                    <th style="width:40px;">#</th>
                    <th>
                        <a href="{{ route('products.index', array_merge(request()->query(), ['sort'=>'name','dir'=>(request('sort')=='name'&&request('dir')=='asc')?'desc':'asc'])) }}">
                            Produk
                            @if(request('sort')=='name') <i class="fas fa-sort-{{ request('dir')=='asc'?'up':'down' }}"></i> @else <i class="fas fa-sort" style="opacity:.3;"></i> @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('products.index', array_merge(request()->query(), ['sort'=>'price','dir'=>(request('sort')=='price'&&request('dir')=='asc')?'desc':'asc'])) }}">
                            Harga Jual
                            @if(request('sort')=='price') <i class="fas fa-sort-{{ request('dir')=='asc'?'up':'down' }}"></i> @else <i class="fas fa-sort" style="opacity:.3;"></i> @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('products.index', array_merge(request()->query(), ['sort'=>'stock','dir'=>(request('sort')=='stock'&&request('dir')=='asc')?'desc':'asc'])) }}">
                            Stok
                            @if(request('sort')=='stock') <i class="fas fa-sort-{{ request('dir')=='asc'?'up':'down' }}"></i> @else <i class="fas fa-sort" style="opacity:.3;"></i> @endif
                        </a>
                    </th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($products as $i => $product)
                <tr>
                    <td class="text-muted" style="font-size:12px;">{{ $products->firstItem() + $i }}</td>
                    <td>
                        <div class="product-info">
                            @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="product-thumb">
                            @else
                                <div class="product-thumb-placeholder">
                                    <i class="fas fa-box"></i>
                                </div>
                            @endif
                            <div>
                                <div class="product-name">{{ $product->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="price-text">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge badge-gray">
                            {{ $product->stock }} {{ $product->unit }}
                        </span>
                    </td>
                    <td>
                        <div class="action-group" style="justify-content:center;">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm" style="{{ $product->stock <= 10 ? 'background:#f59e0b;color:white;border:none;' : 'background:#0047ba;color:white;border:none;' }}" title="Edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button
                                class="btn btn-red btn-sm"
                                title="Hapus"
                                onclick="confirmDelete({{ $product->id }}, '{{ addslashes($product->name) }}')"
                            >
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <i class="fas fa-box-open"></i>
                            <p style="font-size:16px;font-weight:600;color:#334155;margin-bottom:4px;">Tidak ada produk ditemukan</p>
                            <p>Coba ubah filter atau <a href="{{ route('products.create') }}" style="color:#0047ba;font-weight:600;">tambah produk baru</a></p>
                        </div>
                    </td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($products->hasPages())
        <div class="pag-wrap">
            <div class="pag-info">
                Menampilkan {{ $products->firstItem() }}–{{ $products->lastItem() }} dari {{ $products->total() }} produk
            </div>
            <div class="pag-links">
                {{-- Prev --}}
                @if($products->onFirstPage())
                    <span class="disabled"><i class="fas fa-chevron-left"></i></span>
                @else
                    <a href="{{ $products->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                @endif

                {{-- Page Numbers --}}
                @foreach($products->getUrlRange(max(1,$products->currentPage()-2), min($products->lastPage(),$products->currentPage()+2)) as $page => $url)
                    @if($page == $products->currentPage())
                        <span class="active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next --}}
                @if($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                @else
                    <span class="disabled"><i class="fas fa-chevron-right"></i></span>
                @endif
            </div>
        </div>
        @endif

    </div>
</div>

{{-- DELETE MODAL --}}
<div class="modal-overlay" id="delete-modal">
    <div class="modal-box">
        <div class="modal-icon"><i class="fas fa-trash-alt"></i></div>
        <div class="modal-title">Hapus Produk?</div>
        <div class="modal-desc">
            Apakah Anda yakin ingin menghapus produk<br>
            <span class="modal-product-name" id="modal-product-name">"..."</span>?
            <br><br style="margin:0;">
            <span style="color:#ef4444;font-size:12px;"><i class="fas fa-exclamation-triangle"></i> Tindakan ini tidak dapat dibatalkan.</span>
        </div>
        <div class="modal-actions">
            <button class="btn btn-outline" onclick="closeModal()">
                <i class="fas fa-times"></i> Batal
            </button>
            <form id="delete-form" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-red">
                    <i class="fas fa-trash"></i> Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function confirmDelete(id, name) {
    document.getElementById('modal-product-name').textContent = '"' + name + '"';
    document.getElementById('delete-form').action = '/products/' + id;
    document.getElementById('delete-modal').classList.add('open');
}

function closeModal() {
    document.getElementById('delete-modal').classList.remove('open');
}

// Close on overlay click
document.getElementById('delete-modal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

// Close on Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeModal();
});

// Live search debounce
let searchTimer;
document.getElementById('search-input').addEventListener('input', function() {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(() => {
        document.getElementById('filter-form').submit();
    }, 600);
});
</script>
@endsection
