@extends('layouts.app')
@section('title', 'Keranjang Belanja')
@section('page-title', '🛒 Keranjang Belanja')

@section('content')
<div class="row g-4">
    {{-- Cart Items --}}
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-cart3 text-primary"></i>
                    <span class="fw-600">Item di Keranjang ({{ count($cart) }})</span>
                </div>
                @if(count($cart) > 0)
                <a href="{{ route('shop.index') }}" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-plus-lg me-1"></i> Lanjut Belanja
                </a>
                @endif
            </div>
            <div class="card-body p-0">
                @forelse($cart as $id => $item)
                <div class="p-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:52px;height:52px;background:#f0fdf4;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0;">
                            📦
                        </div>
                        <div class="flex-fill">
                            <div class="fw-600">{{ $item['name'] }}</div>
                            <div class="text-success fw-600 small">Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                        </div>
                        {{-- Update Quantity --}}
                        <form method="POST" action="{{ route('shop.cart.update', $id) }}" class="d-flex align-items-center gap-2">
                            @csrf @method('PATCH')
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                   class="form-control form-control-sm text-center" style="width:70px;">
                            <button type="submit" class="btn btn-sm btn-outline-secondary" title="Update">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </form>
                        {{-- Subtotal --}}
                        <div class="text-end" style="min-width:100px;">
                            <div class="fw-700 text-success">
                                Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                            </div>
                        </div>
                        {{-- Remove --}}
                        <form method="POST" action="{{ route('shop.cart.remove', $id) }}">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-cart-x fs-1 d-block mb-3"></i>
                    <h5>Keranjang masih kosong</h5>
                    <p class="mb-3">Yuk belanja dulu, banyak produk seru menunggumu!</p>
                    <a href="{{ route('shop.index') }}" class="btn btn-primary">
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
            <div class="card-header py-3 fw-600">
                <i class="bi bi-receipt me-2 text-primary"></i>Ringkasan Pesanan
            </div>
            <div class="card-body">
                @foreach($cart as $id => $item)
                <div class="d-flex justify-content-between small mb-2">
                    <span class="text-muted">{{ mb_strimwidth($item['name'], 0, 22, '...') }} x{{ $item['quantity'] }}</span>
                    <span>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                </div>
                @endforeach
                <hr>
                <div class="d-flex justify-content-between fw-700 fs-5 mb-3">
                    <span>Total</span>
                    <span class="text-success">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                {{-- Checkout Form --}}
                <form method="POST" action="{{ route('shop.cart.checkout') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-600">Catatan (opsional)</label>
                        <textarea name="note" class="form-control form-control-sm" rows="2"
                                  placeholder="Contoh: Tolong dibungkus rapi..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="bi bi-bag-check me-1"></i> Checkout Sekarang
                    </button>
                </form>

                <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary w-100 mt-2 btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Lanjut Belanja
                </a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
