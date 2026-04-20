@extends('layouts.app')
@section('title', 'Toko Aimar — Belanja')
@section('page-title', '🛍️ Toko Aimar')

@section('content')

{{-- Welcome Banner --}}
<div class="card mb-4" style="background:linear-gradient(135deg,#2c6e49,#52b788);border:none;">
    <div class="card-body py-4 px-4 text-white">
        <div class="row align-items-center">
            <div class="col">
                <h4 class="fw-700 mb-1">Selamat datang, {{ auth()->user()->name }}! 👋</h4>
                <p class="mb-0 opacity-75">Temukan produk terbaik dari Toko Pak Cik & Mas Aimar</p>
            </div>
            <div class="col-auto d-none d-md-block">
                <i class="bi bi-shop-window" style="font-size:4rem;opacity:.2;"></i>
            </div>
        </div>
    </div>
</div>

{{-- Filter & Search --}}
<div class="card mb-4">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('shop.index') }}" class="row g-2 align-items-end">
            <div class="col-md-5">
                <label class="form-label small fw-600 mb-1">Cari Produk</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="form-control" placeholder="Nama produk...">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-600 mb-1">Kategori</label>
                <select name="category" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-600 mb-1">Urut</label>
                <select name="sort" class="form-select">
                    <option value="name"  {{ request('sort') === 'name'  ? 'selected' : '' }}>Nama A-Z</option>
                    <option value="price" {{ request('sort') === 'price' ? 'selected' : '' }}>Harga</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button class="btn btn-primary w-100"><i class="bi bi-filter"></i> Filter</button>
                <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary"><i class="bi bi-x"></i></a>
            </div>
        </form>
    </div>
</div>

{{-- Product Grid --}}
@if($products->count())
<div class="row g-3 mb-4">
    @foreach($products as $product)
    <div class="col-6 col-md-4 col-lg-3">
        <div class="card h-100" style="border-radius:12px;transition:transform .2s,box-shadow .2s;"
             onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 24px rgba(0,0,0,.12)'"
             onmouseout="this.style.transform='';this.style.boxShadow=''">
            {{-- Product Image Placeholder --}}
            <div class="text-center pt-3 pb-1">
                <div style="width:80px;height:80px;background:#f0fdf4;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;font-size:2rem;">
                    @php
                        $icons = ['Makanan & Minuman'=>'🍜','Elektronik'=>'📱','Pakaian'=>'👕','Alat Rumah Tangga'=>'🏠','Kesehatan & Kecantikan'=>'💊','Perlengkapan Bayi'=>'🍼','Olahraga'=>'⚽','Buku & Alat Tulis'=>'📚'];
                    @endphp
                    {{ $icons[$product->category] ?? '📦' }}
                </div>
            </div>
            <div class="card-body pt-2 pb-2 d-flex flex-column">
                <span class="badge rounded-pill mb-1" style="background:#e0f2fe;color:#0369a1;font-size:.65rem;width:fit-content;">{{ $product->category }}</span>
                <h6 class="fw-600 mb-1" style="font-size:.85rem;line-height:1.3;">{{ $product->name }}</h6>
                @if($product->description)
                    <p class="text-muted mb-2" style="font-size:.73rem;line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $product->description }}</p>
                @endif
                <div class="mt-auto">
                    <div class="fw-700 text-success mb-1">{{ $product->formatted_price }}</div>
                    <div class="text-muted" style="font-size:.72rem;">Stok: {{ $product->stock }} pcs</div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-3">
                <form method="POST" action="{{ route('shop.cart.add', $product) }}" class="d-flex gap-1">
                    @csrf
                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                           class="form-control form-control-sm" style="width:60px;">
                    <button type="submit" class="btn btn-primary btn-sm flex-fill">
                        <i class="bi bi-cart-plus"></i> Beli
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
{{ $products->links('pagination::bootstrap-5') }}
@else
<div class="card">
    <div class="card-body text-center py-5 text-muted">
        <i class="bi bi-search fs-1 d-block mb-3"></i>
        <h5>Produk tidak ditemukan</h5>
        <p class="mb-3">Coba ubah filter atau kata kunci pencarian.</p>
        <a href="{{ route('shop.index') }}" class="btn btn-primary">Lihat Semua Produk</a>
    </div>
</div>
@endif
@endsection
