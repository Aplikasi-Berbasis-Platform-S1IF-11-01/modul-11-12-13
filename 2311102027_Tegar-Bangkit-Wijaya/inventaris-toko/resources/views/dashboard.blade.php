@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
<style>
    .stat-card { transition: transform .2s; }
    .stat-card:hover { transform: translateY(-3px); }
    .greeting-card {
        background: linear-gradient(135deg, #4361ee, #3a86ff);
        color: #fff; border-radius: 16px; padding: 1.5rem 2rem;
        margin-bottom: 1.5rem;
        position: relative; overflow: hidden;
    }
    .greeting-card::after {
        content: '\F54B';
        font-family: 'bootstrap-icons';
        position: absolute; right: 1.5rem; top: 50%;
        transform: translateY(-50%);
        font-size: 5rem; opacity: .1;
    }
    .greeting-card h4 { font-weight: 700; font-size: 1.3rem; margin-bottom: .25rem; }
    .greeting-card p  { opacity: .85; font-size: .9rem; margin: 0; }
</style>
@endpush

@section('content')

{{-- Greeting --}}
<div class="greeting-card">
    <h4>Selamat datang, {{ session('user_name') }}! 👋</h4>
    <p>Berikut ringkasan inventaris toko Anda hari ini.</p>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
        <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#ede9fe;">
                    <i class="bi bi-box-seam" style="color:#7c3aed;"></i>
                </div>
                <div>
                    <div class="stat-number text-dark">{{ number_format($totalProduk) }}</div>
                    <div class="text-muted small">Total Produk</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#d1fae5;">
                    <i class="bi bi-check-circle" style="color:#065f46;"></i>
                </div>
                <div>
                    <div class="stat-number" style="color:#065f46;">{{ number_format($produkAktif) }}</div>
                    <div class="text-muted small">Produk Aktif</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#fff3cd;">
                    <i class="bi bi-exclamation-triangle" style="color:#856404;"></i>
                </div>
                <div>
                    <div class="stat-number" style="color:#856404;">{{ number_format($stokHampirHabis) }}</div>
                    <div class="text-muted small">Stok Hampir Habis</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#fee2e2;">
                    <i class="bi bi-x-octagon" style="color:#991b1b;"></i>
                </div>
                <div>
                    <div class="stat-number" style="color:#991b1b;">{{ number_format($stokHabis) }}</div>
                    <div class="text-muted small">Stok Habis</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Nilai Inventaris --}}
<div class="card mb-4">
    <div class="card-body d-flex align-items-center gap-3 py-3">
        <div class="stat-icon rounded-3" style="background:#dbeafe; width:52px; height:52px; display:flex; align-items:center; justify-content:center; font-size:1.4rem;">
            <i class="bi bi-currency-dollar" style="color:#1d4ed8;"></i>
        </div>
        <div>
            <div class="text-muted small">Estimasi Nilai Inventaris (Harga Jual)</div>
            <div style="font-size:1.6rem; font-weight:700; color:#1d4ed8;">
                Rp {{ number_format($nilaiInventaris, 0, ',', '.') }}
            </div>
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm ms-auto">
            <i class="bi bi-arrow-right me-1"></i>Lihat Semua
        </a>
    </div>
</div>

{{-- Produk Terbaru --}}
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h6 class="mb-0 fw-semibold"><i class="bi bi-clock-history me-2 text-primary"></i>Produk Terbaru Ditambahkan</h6>
        <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Kode</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th class="text-center">Stok</th>
                    <th class="text-end">Harga Jual</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produkTerbaru as $p)
                <tr>
                    <td><code>{{ $p->kode_produk }}</code></td>
                    <td class="fw-medium">{{ $p->nama_produk }}</td>
                    <td><span class="badge bg-light text-dark border">{{ $p->kategori }}</span></td>
                    <td class="text-center">
                        @if($p->stok == 0)
                            <span class="stok-habis">Habis</span>
                        @elseif($p->stok <= 10)
                            <span class="stok-tipis">{{ $p->stok }} ⚠️</span>
                        @else
                            <span class="stok-normal">{{ $p->stok }}</span>
                        @endif
                    </td>
                    <td class="text-end">{{ $p->harga_jual_format }}</td>
                    <td class="text-center">
                        <span class="badge {{ $p->status === 'aktif' ? 'badge-aktif' : 'badge-nonaktif' }}">
                            {{ ucfirst($p->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Belum ada produk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
