@extends('layouts.app')

@section('title', 'Detail Produk')
@section('page-title', '🔍 Detail Produk')
@section('breadcrumb', 'AiCik Stock / Produk / Detail')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-lg-7">
        <div class="card-custom">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-4">
                <h5 style="font-family:'Poppins',sans-serif;font-weight:600;">
                    <i class="bi bi-eye-fill me-2" style="color:#93c5fd;"></i>Detail Produk
                </h5>
                <span class="{{ $produk->status === 'aktif' ? 'badge-aktif' : 'badge-nonaktif' }}">
                    {{ ucfirst($produk->status) }}
                </span>
            </div>

            <div class="row g-0">
                @php
                $rows = [
                    ['label' => 'Nama Produk',  'value' => $produk->nama,                                                 'icon' => 'bi-box-seam-fill',       'color' => '#a78bfa'],
                    ['label' => 'Kode Produk',  'value' => $produk->kode,                                                 'icon' => 'bi-upc-scan',            'color' => '#60a5fa', 'mono' => true],
                    ['label' => 'Kategori',     'value' => $produk->kategori->nama ?? '-',                                'icon' => 'bi-tag-fill',            'color' => '#a78bfa'],
                    ['label' => 'Harga',        'value' => 'Rp ' . number_format($produk->harga, 0, ',', '.'),           'icon' => 'bi-currency-dollar',     'color' => '#fbbf24'],
                    ['label' => 'Stok',         'value' => $produk->stok . ' ' . $produk->satuan,                        'icon' => 'bi-stack',               'color' => $produk->stok == 0 ? '#f87171' : '#34d399'],
                    ['label' => 'Satuan',       'value' => $produk->satuan,                                               'icon' => 'bi-rulers',              'color' => '#94a3b8'],
                    ['label' => 'Deskripsi',    'value' => $produk->deskripsi ?: '-',                                     'icon' => 'bi-card-text',           'color' => '#94a3b8'],
                    ['label' => 'Dibuat',       'value' => $produk->created_at->format('d M Y, H:i'),                   'icon' => 'bi-calendar-plus',       'color' => '#94a3b8'],
                    ['label' => 'Diupdate',     'value' => $produk->updated_at->format('d M Y, H:i'),                   'icon' => 'bi-calendar-check',      'color' => '#94a3b8'],
                ];
                @endphp

                @foreach($rows as $row)
                <div class="col-12" style="border-bottom:1px solid var(--border);padding:.85rem 0;display:flex;align-items:flex-start;gap:.85rem;">
                    <i class="bi {{ $row['icon'] }}" style="color:{{ $row['color'] }};font-size:1rem;margin-top:.1rem;flex-shrink:0;width:20px;text-align:center;"></i>
                    <div style="flex:1;">
                        <div style="font-size:.73rem;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.15rem;">{{ $row['label'] }}</div>
                        <div style="font-size:.9rem;color:var(--text);{{ isset($row['mono']) ? 'font-family:monospace;' : '' }}">{{ $row['value'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="d-flex gap-3 mt-4 flex-wrap">
                <a href="{{ route('produk.edit', $produk) }}" class="btn-primary-custom text-decoration-none">
                    <i class="bi bi-pencil-fill me-1"></i> Edit Produk
                </a>
                <a href="{{ route('produk.index') }}" class="btn text-decoration-none"
                    style="background:rgba(255,255,255,.08);color:var(--text);border:1px solid var(--border);border-radius:10px;padding:.6rem 1.4rem;font-size:.88rem;">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
