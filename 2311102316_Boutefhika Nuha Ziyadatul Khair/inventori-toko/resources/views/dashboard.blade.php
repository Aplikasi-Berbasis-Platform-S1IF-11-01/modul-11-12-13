@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Greeting --}}
<div class="mb-4">
    <h5 style="font-family:'Playfair Display',serif;color:var(--brown-text);font-size:1.15rem;margin:0;">
        Selamat datang kembali, <strong>{{ auth()->user()->name }}</strong> 👋
    </h5>
    <div style="font-size:.8rem;color:var(--muted-text);">{{ now()->translatedFormat('l, d F Y') }}</div>
</div>

{{-- Stats Row --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3 py-3">
                <div class="stat-icon" style="background:var(--cream-100);color:var(--cream-600);">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div>
                    <div style="font-size:1.5rem;font-weight:600;color:var(--brown-text);line-height:1.1;">{{ $total }}</div>
                    <div style="font-size:.73rem;color:var(--muted-text);">Total Produk</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3 py-3">
                <div class="stat-icon" style="background:#eef7e8;color:#3a7d2a;">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div>
                    <div style="font-size:1.5rem;font-weight:600;color:var(--brown-text);line-height:1.1;">{{ $inStock }}</div>
                    <div style="font-size:.73rem;color:var(--muted-text);">Tersedia</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3 py-3">
                <div class="stat-icon" style="background:#fdf6e3;color:#8a5a00;">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <div>
                    <div style="font-size:1.5rem;font-weight:600;color:var(--brown-text);line-height:1.1;">{{ $lowStock }}</div>
                    <div style="font-size:.73rem;color:var(--muted-text);">Stok Menipis</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3 py-3">
                <div class="stat-icon" style="background:#fdf0f0;color:#b03030;">
                    <i class="bi bi-x-circle"></i>
                </div>
                <div>
                    <div style="font-size:1.5rem;font-weight:600;color:var(--brown-text);line-height:1.1;">{{ $outStock }}</div>
                    <div style="font-size:.73rem;color:var(--muted-text);">Habis</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Total Nilai Stok --}}
<div class="card mb-4" style="border-left:4px solid var(--cream-500);">
    <div class="card-body d-flex align-items-center gap-3 py-3">
        <div class="stat-icon" style="background:var(--cream-100);color:var(--cream-600);">
            <i class="bi bi-cash-stack"></i>
        </div>
        <div>
            <div style="font-size:.73rem;color:var(--muted-text);">Estimasi Total Nilai Stok</div>
            <div style="font-size:1.35rem;font-weight:600;color:var(--brown-text);">
                Rp {{ number_format($totalValue, 0, ',', '.') }}
            </div>
        </div>
    </div>
</div>

{{-- Row: Stok Menipis + Produk Terbaru --}}
<div class="row g-3 mb-4">

    {{-- Stok Menipis --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center gap-2 py-3">
                <i class="bi bi-exclamation-triangle" style="color:#8a5a00;"></i>
                <span style="font-size:.9rem;">Stok Hampir Habis</span>
            </div>
            <div class="card-body p-0">
                @forelse($lowStockProducts as $p)
                <div class="d-flex align-items-center justify-content-between px-3 py-2"
                     style="border-bottom:1px solid var(--cream-100);">
                    <div>
                        <div style="font-size:.85rem;font-weight:500;color:var(--brown-text);">{{ $p->name }}</div>
                        <div style="font-size:.72rem;color:var(--muted-text);">{{ $p->category }}</div>
                    </div>
                    <span class="badge rounded-pill px-2"
                          style="background:#fdf6e3;color:#8a5a00;font-size:.72rem;font-weight:600;">
                        Sisa {{ $p->stock }}
                    </span>
                </div>
                @empty
                <div class="text-center py-4" style="color:var(--muted-text);font-size:.82rem;">
                    <i class="bi bi-check2-circle d-block mb-1" style="font-size:1.5rem;color:#3a7d2a;"></i>
                    Semua stok aman!
                </div>
                @endforelse
            </div>
            @if($lowStock > 5)
            <div class="card-footer text-center py-2" style="background:transparent;">
                <a href="{{ route('admin.products.index') }}" style="font-size:.78rem;color:var(--cream-600);">
                    Lihat semua produk menipis →
                </a>
            </div>
            @endif
        </div>
    </div>

    {{-- Produk Terbaru --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center gap-2 py-3">
                <i class="bi bi-clock-history" style="color:var(--cream-500);"></i>
                <span style="font-size:.9rem;">Produk Terbaru Ditambahkan</span>
            </div>
            <div class="card-body p-0">
                @foreach($latestProducts as $p)
                <div class="d-flex align-items-center justify-content-between px-3 py-2"
                     style="border-bottom:1px solid var(--cream-100);">
                    <div>
                        <div style="font-size:.85rem;font-weight:500;color:var(--brown-text);">{{ $p->name }}</div>
                        <div style="font-size:.72rem;color:var(--muted-text);">
                            <code style="background:var(--cream-100);color:var(--cream-700);border-radius:3px;padding:1px 5px;">{{ $p->sku }}</code>
                            &nbsp;·&nbsp; {{ $p->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <span style="font-size:.82rem;font-weight:500;color:var(--brown-text);">
                        {{ $p->formatted_price }}
                    </span>
                </div>
                @endforeach
            </div>
            <div class="card-footer text-center py-2" style="background:transparent;">
                <a href="{{ route('admin.products.index') }}" style="font-size:.78rem;color:var(--cream-600);">
                    Lihat semua produk →
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Distribusi Kategori --}}
<div class="card">
    <div class="card-header d-flex align-items-center gap-2 py-3">
        <i class="bi bi-bar-chart" style="color:var(--cream-500);"></i>
        <span style="font-size:.9rem;">Distribusi Produk per Kategori</span>
    </div>
    <div class="card-body">
        @foreach($categoryStats as $cat)
        @php $pct = $total > 0 ? round(($cat->total / $total) * 100) : 0; @endphp
        <div class="mb-3">
            <div class="d-flex justify-content-between mb-1">
                <span style="font-size:.82rem;font-weight:500;color:var(--brown-text);">{{ $cat->category }}</span>
                <span style="font-size:.78rem;color:var(--muted-text);">
                    {{ $cat->total }} produk &nbsp;·&nbsp; {{ number_format($cat->total_stock) }} stok
                </span>
            </div>
            <div class="progress" style="height:8px;border-radius:99px;background:var(--cream-100);">
                <div class="progress-bar" role="progressbar"
                     style="width:{{ $pct }}%;background:var(--cream-500);border-radius:99px;"
                     aria-valuenow="{{ $pct }}" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection