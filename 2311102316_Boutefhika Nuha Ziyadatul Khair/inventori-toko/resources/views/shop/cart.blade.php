@extends('layouts.app')
@section('title', 'Keranjang Belanja')
@section('page-title', 'Keranjang Belanja')

@section('content')
<div class="row g-4">
    {{-- Cart Items --}}
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-cart3" style="color:var(--cream-500);"></i>
                    <span>Item di Keranjang ({{ count($cart) }})</span>
                </div>
                @if(count($cart) > 0)
                <a href="{{ route('shop.index') }}" class="btn btn-sm btn-outline-primary" style="border-radius:8px;font-size:.8rem;">
                    <i class="bi bi-plus-lg me-1"></i> Lanjut Belanja
                </a>
                @endif
            </div>
            <div class="card-body p-0">
                @forelse($cart as $id => $item)
                <div class="p-3 {{ !$loop->last ? 'border-bottom' : '' }}" style="border-color:var(--border) !important;">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:50px;height:50px;background:var(--cream-100);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0;border:1px solid var(--border);">
                            📦
                        </div>
                        <div class="flex-fill">
                            <div style="font-weight:500;font-size:.88rem;color:var(--brown-text);">{{ $item['name'] }}</div>
                            <div style="color:var(--cream-600);font-weight:600;font-size:.82rem;">Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                        </div>
                        {{-- Update Quantity --}}
                        <form method="POST" action="{{ route('shop.cart.update', $id) }}" class="d-flex align-items-center gap-2">
                            @csrf @method('PATCH')
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                   class="form-control form-control-sm text-center" style="width:68px;border-radius:8px;">
                            <button type="submit" class="btn btn-sm btn-secondary" title="Update" style="border-radius:8px;">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </form>
                        {{-- Subtotal --}}
                        <div class="text-end" style="min-width:100px;">
                            <div style="font-weight:600;color:var(--brown-text);font-size:.9rem;">
                                Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                            </div>
                        </div>
                        {{-- Remove --}}
                        <form method="POST" action="{{ route('shop.cart.remove', $id) }}">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm" title="Hapus"
                                    style="border:1px solid #e8c0c0;color:#b03030;border-radius:8px;">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="text-center py-5" style="color:var(--muted-text);">
                    <i class="bi bi-cart-x d-block mb-3" style="font-size:2.5rem;opacity:.4;"></i>
                    <h5 style="color:var(--brown-text);font-family:'Playfair Display',serif;font-size:1.1rem;">Keranjang masih kosong</h5>
                    <p class="mb-3" style="font-size:.85rem;">Yuk belanja dulu, banyak produk seru menunggumu!</p>
                    <a href="{{ route('shop.index') }}" class="btn btn-primary btn-sm px-4">
                        <i class="bi bi-shop me-1"></i> Ke Toko
                    </a>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Order Summary --}}
    @if(count($cart) > 0)
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header py-3" style="font-family:'Playfair Display',serif;font-size:.95rem;">
                <i class="bi bi-receipt me-2" style="color:var(--cream-500);"></i>Ringkasan Pesanan
            </div>
            <div class="card-body">
                @foreach($cart as $id => $item)
                <div class="d-flex justify-content-between mb-2" style="font-size:.8rem;">
                    <span style="color:var(--muted-text);">{{ str($item['name'])->limit(22) }} x{{ $item['quantity'] }}</span>
                    <span style="color:var(--brown-text);">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                </div>
                @endforeach

                <hr style="border-color:var(--border);">

                <div class="d-flex justify-content-between mb-3">
                    <span style="font-weight:600;color:var(--brown-text);">Total</span>
                    <span style="font-weight:700;color:var(--cream-600);font-size:1.1rem;">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <form method="POST" action="{{ route('shop.cart.checkout') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Catatan (opsional)</label>
                        <textarea name="note" class="form-control form-control-sm" rows="2"
                                  placeholder="Contoh: Tolong dibungkus rapi..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-bag-check me-1"></i> Checkout Sekarang
                    </button>
                </form>

                <a href="{{ route('shop.index') }}" class="btn btn-secondary w-100 mt-2 btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Lanjut Belanja
                </a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection