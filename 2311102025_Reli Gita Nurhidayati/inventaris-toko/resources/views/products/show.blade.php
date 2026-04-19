@extends('layouts.app')

@section('title', 'Detail Produk - ' . $product->nama_produk)

@section('content')

<!-- Page Header -->
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm me-3">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h4 class="page-title mb-0">🔍 Detail Produk</h4>
        <p class="page-subtitle mb-0">Informasi lengkap produk</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header py-3" style="background: linear-gradient(135deg, #155724, #28a745);">
                <h6 class="mb-0 text-white">
                    <i class="bi bi-box-seam me-2"></i> {{ $product->nama_produk }}
                </h6>
            </div>
            <div class="card-body p-4">
                <table class="table table-borderless" style="font-size: 0.9rem;">
                    <tr>
                        <td class="text-muted fw-500" style="width: 140px;">ID Produk</td>
                        <td><strong>#{{ $product->id }}</strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted fw-500">Nama Produk</td>
                        <td><strong>{{ $product->nama_produk }}</strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted fw-500">Kategori</td>
                        <td><span class="badge bg-primary">{{ $product->kategori }}</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted fw-500">Stok</td>
                        <td>
                            <strong>{{ $product->stok }}</strong> pcs
                            @if($product->stok <= 10)
                                <span class="badge bg-danger ms-1">Stok Kritis!</span>
                            @elseif($product->stok <= 30)
                                <span class="badge bg-warning text-dark ms-1">Stok Rendah</span>
                            @else
                                <span class="badge bg-success ms-1">Stok Aman</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted fw-500">Harga Satuan</td>
                        <td><strong>Rp {{ number_format($product->harga, 0, ',', '.') }}</strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted fw-500">Total Nilai</td>
                        <td><strong class="text-success">Rp {{ number_format($product->harga * $product->stok, 0, ',', '.') }}</strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted fw-500">Deskripsi</td>
                        <td>{{ $product->deskripsi ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted fw-500">Ditambahkan</td>
                        <td>{{ $product->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted fw-500">Terakhir Update</td>
                        <td>{{ $product->updated_at->format('d M Y, H:i') }}</td>
                    </tr>
                </table>

                <div class="d-flex gap-2 mt-3">
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-1"></i> Edit Produk
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
