@extends('layouts.app')
@section('title', 'Yhota`s')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">📦 Inventaris Produk</h4>
        <small class="text-muted">Total {{ $products->total() }} produk terdaftar</small>
    </div>
    <a href="{{ route('products.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Produk
    </a>
</div>

<!-- Search Bar -->
<div class="card mb-3 border-0 shadow-sm">
    <div class="card-body py-2">
        <form action="{{ route('products.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control"
                   placeholder="🔍 Cari nama atau deskripsi produk..."
                   value="{{ $search ?? '' }}">
            <button type="submit" class="btn btn-outline-primary px-4">Cari</button>
            @if($search)
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </form>
    </div>
</div>

<!-- Tabel Produk -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th width="160" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td class="text-muted small">{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td>
                        <td class="fw-semibold">{{ $product->name }}</td>
                        <td class="text-muted small">{{ Str::limit($product->description, 60) ?? '-' }}</td>
                        <td class="text-success fw-semibold">{{ $product->formatted_price }}</td>
                        <td>
                            <span class="badge rounded-pill
                                {{ $product->stock <= 10 ? 'bg-danger' : ($product->stock <= 30 ? 'bg-warning text-dark' : 'bg-success') }}">
                                {{ $product->stock }} pcs
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-warning me-1">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <!-- Tombol Hapus -->
                            <button type="button" class="btn btn-sm btn-outline-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"
                                    data-id="{{ $product->id }}"
                                    data-name="{{ $product->name }}">
                                <i class="bi bi-trash3"></i> Hapus
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            @if($search)
                                Tidak ada produk yang cocok dengan "<strong>{{ $search }}</strong>"
                            @else
                                Belum ada produk. <a href="{{ route('products.create') }}">Tambah sekarang?</a>
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
<div class="mt-3 d-flex justify-content-between align-items-center">
    <small class="text-muted">
        Menampilkan {{ $products->firstItem() }}–{{ $products->lastItem() }} dari {{ $products->total() }} produk
    </small>
    {{ $products->links() }}
</div>

<!-- ── Modal Konfirmasi Hapus ── -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-danger fw-bold">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-1">Apakah kamu yakin ingin menghapus produk:</p>
                <p class="fw-bold fs-5 text-dark" id="modalProductName">—</p>
                <div class="alert alert-warning py-2 small">
                    <i class="bi bi-info-circle me-1"></i>
                    Tindakan ini tidak dapat dibatalkan!
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>Batal
                </button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash3 me-1"></i>Ya, Hapus!
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Isi data modal hapus secara dinamis
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const productId   = button.getAttribute('data-id');
        const productName = button.getAttribute('data-name');

        document.getElementById('modalProductName').textContent = productName;
        document.getElementById('deleteForm').action = `/products/${productId}`;
    });
</script>
@endpush