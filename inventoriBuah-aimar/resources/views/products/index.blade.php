@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-primary text-white p-3"
                style="background: linear-gradient(45deg, #0d6efd, #0099ff);">
                <div class="d-flex align-items-center">
                    <i class="bi bi-box-seam display-6 me-3"></i>
                    <div>
                        <h6 class="mb-0 opacity-75">Total Produk</h6>
                        <h3 class="mb-0 fw-bold">{{ $products->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 d-flex align-items-end justify-content-end">
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg shadow px-4 py-2 fw-bold"
                style="border-radius: 12px; transition: transform 0.2s;">
                <i class="bi bi-plus-circle-fill me-2"></i> Tambah Produk Baru
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
        <div class="card-header bg-white py-4 border-0">
            <h4 class="fw-bold mb-0 text-dark"><i class="bi bi-basket3-fill text-warning me-2"></i> Katalog Produk Toko</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th class="ps-4 py-3 text-secondary small fw-bold">NAMA PRODUK</th>
                            <th class="py-3 text-secondary small fw-bold">STATUS STOK</th>
                            <th class="py-3 text-secondary small fw-bold">HARGA SATUAN</th>
                            <th class="py-3 text-secondary small fw-bold text-center">MANAJEMEN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $p)
                            <tr style="transition: all 0.3s ease;">
                                <td class="ps-4 py-4">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                                            style="width: 40px; height: 40px; border: 1px solid #eee;">
                                            <i class="bi bi-cart-fill text-primary"></i>
                                        </div>
                                        <span class="fw-bold text-dark fs-5">{{ $p->nama_produk }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if ($p->stok <= 5)
                                        <span class="badge rounded-pill bg-danger px-3 py-2 shadow-sm">Kritis:
                                            {{ $p->stok }} Unit</span>
                                    @elseif($p->stok <= 20)
                                        <span class="badge rounded-pill bg-warning text-dark px-3 py-2 shadow-sm">Menipis:
                                            {{ $p->stok }} Unit</span>
                                    @else
                                        <span class="badge rounded-pill bg-success px-3 py-2 shadow-sm text-white"
                                            style="background: linear-gradient(45deg, #198754, #20c997);">Tersedia:
                                            {{ $p->stok }} Unit</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-bold text-primary fs-5">Rp
                                        {{ number_format($p->harga, 0, ',', '.') }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group shadow-sm" style="border-radius: 8px; overflow: hidden;">
                                        <a href="{{ route('products.edit', $p->id) }}"
                                            class="btn btn-warning text-white px-3 border-0">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button class="btn btn-danger px-3 border-0" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $p->id }}">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="deleteModal{{ $p->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <form action="{{ route('products.destroy', $p->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                                            <div class="modal-body text-center p-5">
                                                <div class="rounded-circle bg-danger-subtle d-inline-flex p-4 mb-4">
                                                    <i class="bi bi-trash3 text-danger h1 mb-0"></i>
                                                </div>
                                                <h3 class="fw-bold text-dark">Hapus Produk?</h3>
                                                <p class="text-muted">Apakah kamu yakin ingin menghapus
                                                    <b>{{ $p->nama_produk }}</b>? Tindakan ini tidak bisa dibatalkan, King!
                                                </p>
                                                <div class="d-flex gap-2 mt-4">
                                                    <button type="button" class="btn btn-light w-100 py-3 fw-bold"
                                                        data-bs-dismiss="modal" style="border-radius: 12px;">Batal</button>
                                                    <button type="submit" class="btn btn-danger w-100 py-3 fw-bold shadow"
                                                        style="border-radius: 12px;">Ya, Hapus!</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        /* Animasi Hover Baris Tabel */
        tr:hover {
            background-color: #fbfcfe !important;
            transform: scale(1.005);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .btn:hover {
            transform: translateY(-2px);
        }
    </style>
@endsection
