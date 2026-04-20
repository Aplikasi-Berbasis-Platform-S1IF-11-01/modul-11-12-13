@extends('layouts.app')
@section('title', 'Toko Inventory Aimar — Belanja')
@section('page-title', 'Toko Inventory Aimar')

@section('content')

{{-- Welcome Banner --}}
<div class="card mb-4" style="background:var(--cream-800);border:none !important;">
    <div class="card-body py-4 px-4">
        <div class="row align-items-center">
            <div class="col">
                <h4 style="font-family:'Playfair Display',serif;color:var(--cream-100);font-weight:700;margin-bottom:.3rem;">
                    Selamat datang, {{ auth()->user()->name }}!
                </h4>
                <p style="color:var(--cream-400);margin:0;font-size:.85rem;">Temukan produk terbaik dari Toko Pak Cik &amp; Mas Aimar</p>
            </div>
            <div class="col-auto d-none d-md-block">
                <i class="bi bi-shop-window" style="font-size:3.5rem;color:var(--cream-600);"></i>
            </div>
        </div>
    </div>
</div>

{{-- Filter & Search --}}
<div class="card mb-4">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('shop.index') }}" class="row g-2 align-items-end">
            <div class="col-md-5">
                <label class="form-label">Cari Produk</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="form-control" placeholder="Nama produk...">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Kategori</label>
                <select name="category" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Urut</label>
                <select name="sort" class="form-select">
                    <option value="name"  {{ request('sort') === 'name'  ? 'selected' : '' }}>Nama A-Z</option>
                    <option value="price" {{ request('sort') === 'price' ? 'selected' : '' }}>Harga</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button class="btn btn-primary w-100"><i class="bi bi-filter"></i> Filter</button>
                <a href="{{ route('shop.index') }}" class="btn btn-secondary"><i class="bi bi-x"></i></a>
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
             onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 24px rgba(61,44,20,.12)'"
             onmouseout="this.style.transform='';this.style.boxShadow=''">
            <div class="text-center pt-3 pb-1">
                <div style="width:72px;height:72px;background:var(--cream-100);border-radius:50%;display:inline-flex;align-items:center;justify-content:center;font-size:1.8rem;border:1px solid var(--cream-200);">
                    @php
                        $icons = ['Makanan & Minuman'=>'🍜','Elektronik'=>'📱','Pakaian'=>'👕','Alat Rumah Tangga'=>'🏠','Kesehatan & Kecantikan'=>'💊','Perlengkapan Bayi'=>'🍼','Olahraga'=>'⚽','Buku & Alat Tulis'=>'📚'];
                    @endphp
                    {{ $icons[$product->category] ?? '📦' }}
                </div>
            </div>
            <div class="card-body pt-2 pb-2 d-flex flex-column">
                <span class="badge rounded-pill mb-1" style="background:var(--cream-100);color:var(--cream-700);font-size:.62rem;font-weight:500;width:fit-content;">
                    {{ $product->category }}
                </span>
                <h6 style="font-weight:500;margin-bottom:.3rem;font-size:.83rem;line-height:1.3;color:var(--brown-text);">
                    {{ $product->name }}
                </h6>
                @if($product->description)
                    <p style="color:var(--muted-text);margin-bottom:.5rem;font-size:.72rem;line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                        {{ $product->description }}
                    </p>
                @endif
                <div class="mt-auto">
                    <div style="font-weight:700;color:var(--cream-600);margin-bottom:.2rem;font-size:.9rem;">{{ $product->formatted_price }}</div>
                    <div style="font-size:.7rem;color:var(--muted-text);">Stok: {{ $product->stock }} pcs</div>
                </div>
            </div>
            <div class="card-footer" style="background:transparent;border-top:1px solid var(--cream-200);padding:.6rem .75rem;">
                <form method="POST" action="{{ route('shop.cart.add', $product) }}" class="d-flex gap-1">
                    @csrf
                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                           class="form-control form-control-sm text-center" style="width:58px;border-radius:8px;">
                    <button type="submit" class="btn btn-primary btn-sm flex-fill" style="font-size:.8rem;border-radius:8px;">
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
    <div class="card-body text-center py-5" style="color:var(--muted-text);">
        <i class="bi bi-search d-block mb-3" style="font-size:2.5rem;opacity:.4;"></i>
        <h5 style="font-family:'Playfair Display',serif;color:var(--brown-text);">Produk tidak ditemukan</h5>
        <p class="mb-3" style="font-size:.85rem;">Coba ubah filter atau kata kunci pencarian.</p>
        <a href="{{ route('shop.index') }}" class="btn btn-primary btn-sm px-4">Lihat Semua Produk</a>
    </div>
</div>
@endif
@endsection