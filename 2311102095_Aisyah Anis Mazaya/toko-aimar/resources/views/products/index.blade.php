@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 px-2">
            <div>
                <h2 class="fw-800 mb-0" style="color: #d14781; letter-spacing: -1px;">Daftar Produk</h2>
                <p class="text-muted">Halo Mas Jakobi.</p>
            </div>
            <a href="{{ route('products.create') }}" class="btn btn-pink rounded-pill px-4 py-2 shadow-lg transition">
                <i class="fas fa-plus-circle me-2"></i> + Tambah Produk Baru
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 text-center py-3">
                <strong>Berhasil!</strong> {{ session('success') }} 
            </div>
        @endif

        <div class="inventory-list">
            <div class="row px-4 py-3 fw-bold text-muted d-none d-md-flex mb-2" style="font-size: 0.9rem;">
                <div class="col-md-1">NO</div>
                <div class="col-md-4">INFORMASI PRODUK</div>
                <div class="col-md-2 text-center">HARGA</div>
                <div class="col-md-2 text-center">STOK</div>
                <div class="col-md-3 text-end">KETERANGAN</div>
            </div>

            @forelse($products as $product)
            <div class="product-row bg-white rounded-4 shadow-sm p-4 mb-3 border-start border-5 transition" style="border-color: #FFB6C1 !important;">
                <div class="row align-items-center">
                    <div class="col-md-1 d-none d-md-block">
                        <span class="text-muted fw-bold">#{{ $loop->iteration }}</span>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-3 shadow-sm" 
                                 style="width: 45px; height: 45px; background: linear-gradient(45deg, #FFB6C1, #FF69B4);">
                                {{ substr($product->nama_produk, 0, 1) }}
                            </div>
                            <div>
                                <h5 class="mb-0 fw-700 text-dark">{{ $product->nama_produk }}</h5>
                                <small class="text-muted">ID: PROD-{{ $product->id }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 text-center">
                        <span class="fw-800 text-pink-dark">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="col-md-2 text-center">
                        @if($product->stok <= 5)
                            <span class="badge bg-danger-subtle text-danger rounded-pill px-3">Kritis: {{ $product->stok }}</span>
                        @else
                            <span class="badge bg-success-subtle text-success rounded-pill px-3">Tersedia: {{ $product->stok }}</span>
                        @endif
                    </div>
                    <div class="col-md-3 text-end mt-3 mt-md-0">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm rounded-pill px-4 text-white shadow-sm border-0 me-1">Edit</a>
                        <button class="btn btn-outline-danger btn-sm rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->id }}">Hapus</button>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg rounded-5">
                        <div class="modal-body text-center p-5">
                            <span class="display-4 text-danger mb-4 d-block">🗑️</span>
                            <h3 class="fw-bold mb-3">Hapus Produk?</h3>
                            <p class="text-muted">Apakah kamu yakin mau hapus <b>{{ $product->nama_produk }}</b>? Data ini nggak bisa balik lagi lho wok.</p>
                            <div class="mt-4">
                                <button type="button" class="btn btn-light rounded-pill px-4 me-2" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger rounded-pill px-4">Ya, Hapus Saja</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-5">
                <p class="text-muted">Yah, tokonya masih kosong nih...</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    .fw-700 { font-weight: 700; }
    .fw-800 { font-weight: 800; }
    .text-pink-dark { color: #d14781; }
    
    /* Animasi saat baris di-hover */
    .product-row {
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }
    .product-row:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(255, 182, 193, 0.4) !important;
        background-color: #fffafb;
        border: 1px solid #FFB6C1;
    }

    .bg-danger-subtle { background-color: #ffe5e5; }
    .bg-success-subtle { background-color: #e5f9e5; }
    
    .btn-pink {
        background: linear-gradient(45deg, #FF69B4, #FF1493);
        border: none;
        color: white;
    }
</style>
@endsection