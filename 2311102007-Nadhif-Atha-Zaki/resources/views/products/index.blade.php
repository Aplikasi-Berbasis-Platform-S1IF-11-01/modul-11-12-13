@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>📦 Data Produk</h2>
            <small class="text-muted">Inventori toko Pak Cik & Mas Aimar</small>
        </div>

        <a href="{{ route('products.create') }}" class="btn btn-primary shadow-sm">
            + Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <table class="table table-hover align-middle">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($products as $index => $product)
                    <tr>
                        <td class="text-center">{{ $products->firstItem() + $index }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category }}</td>
                        <td class="text-center">
                            <span class="badge bg-primary">{{ $product->stock }}</span>
                        </td>
                        <td>Rp {{ number_format($product->price,0,',','.') }}</td>
                        <td>{{ $product->description }}</td>

                        <td class="text-center">
                            <a href="{{ route('products.edit',$product->id) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <button class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#delete{{ $product->id }}">
                                Hapus
                            </button>

                            <!-- MODAL -->
                            <div class="modal fade" id="delete{{ $product->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header bg-danger text-white">
                                            <h5>Konfirmasi</h5>
                                        </div>

                                        <div class="modal-body">
                                            Hapus produk <b>{{ $product->name }}</b>?
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">
                                                Batal
                                            </button>

                                            <form method="POST" action="{{ route('products.destroy',$product->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Data kosong
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>

            <div class="mt-3">
                {{ $products->links() }}
            </div>

        </div>
    </div>

</div>
@endsection