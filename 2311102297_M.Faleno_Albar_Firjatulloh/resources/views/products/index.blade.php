@extends('layouts.app')
@section('title', 'Daftar Produk')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 fw-bold">📦 Manajemen Produk</h4>
            <small class="text-muted">Kelola semua produk toko</small>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table id="productTable" class="table table-hover w-100">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $i => $product)
                    <tr>
                        <td>{{ $products->firstItem() + $i }}</td>
                        <td>{{ $product->name }}</td>
                        <td><span class="badge bg-secondary">{{ $product->category }}</span></td>
                        <td>
                            <span class="badge {{ $product->stock <= 5 ? 'bg-danger' : 'bg-success' }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td>{{ $product->unit }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product) }}" 
                               class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-danger btn-delete" 
                                    data-id="{{ $product->id }}"
                                    data-name="{{ $product->name }}">
                                <i class="fas fa-trash"></i>
                            </button>

                            <form id="delete-{{ $product->id }}" 
                                  action="{{ route('products.destroy', $product) }}" 
                                  method="POST" class="d-none">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                <p class="mb-1">Apakah kamu yakin ingin menghapus produk:</p>
                <strong id="productName" class="fs-5"></strong>
                <p class="text-muted mt-2 mb-0"><small>Tindakan ini tidak dapat dibatalkan.</small></p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="button" id="confirmDelete" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Ya, Hapus!
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#productTable').DataTable({
        paging: false,
        info: false,
        language: {
            search: "Cari:",
            zeroRecords: "Produk tidak ditemukan"
        }
    });

    let deleteId = null;

    $('.btn-delete').on('click', function() {
        deleteId = $(this).data('id');
        $('#productName').text($(this).data('name'));
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    });

    $('#confirmDelete').on('click', function() {
        if (deleteId) $('#delete-' + deleteId).submit();
    });
});
</script>
@endpush