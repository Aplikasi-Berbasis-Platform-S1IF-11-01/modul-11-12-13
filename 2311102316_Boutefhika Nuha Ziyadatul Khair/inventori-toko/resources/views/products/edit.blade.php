@extends('layouts.app')
@section('title', 'Edit Produk — ' . $product->name)
@section('page-title', 'Edit Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square" style="color:var(--cream-500);"></i>
                    <span>Edit: <strong>{{ $product->name }}</strong></span>
                </div>
                <span class="badge" style="background:var(--cream-200);color:var(--cream-700);font-size:.75rem;font-weight:500;">{{ $product->sku }}</span>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.products.update', $product) }}" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Nama produk" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">SKU <span class="text-danger">*</span></label>
                            <input type="text" name="sku" value="{{ old('sku', $product->sku) }}"
                                   class="form-control @error('sku') is-invalid @enderror" required>
                            @error('sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kategori <span class="text-danger">*</span></label>
                            <input type="text" name="category" value="{{ old('category', $product->category) }}"
                                   class="form-control @error('category') is-invalid @enderror"
                                   list="category-list" required>
                            <datalist id="category-list">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}">
                                @endforeach
                            </datalist>
                            @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="price" value="{{ old('price', $product->price) }}"
                                       class="form-control @error('price') is-invalid @enderror"
                                       min="0" step="500" required>
                            </div>
                            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Stok <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                                       class="form-control @error('stock') is-invalid @enderror"
                                       min="0" required>
                                <span class="input-group-text">pcs</span>
                            </div>
                            @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" rows="3"
                                      class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-lg me-1"></i> Update Produk
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary px-4">
                            <i class="bi bi-x-lg me-1"></i> Batal
                        </a>
                        <button type="button" class="btn ms-auto"
                                style="border:1px solid #e8c0c0;color:#b03030;background:transparent;"
                                onclick="confirmDelete({{ $product->id }}, '{{ addslashes($product->name) }}')">
                            <i class="bi bi-trash me-1"></i> Hapus
                        </button>
                    </div>
                </form>

                <form id="delete-form-{{ $product->id }}"
                      action="{{ route('admin.products.destroy', $product) }}"
                      method="POST" class="d-none">
                    @csrf @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius:14px;box-shadow:0 8px 40px rgba(61,44,20,.15);">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title" style="font-family:'Playfair Display',serif;font-size:1rem;">
                    <i class="bi bi-trash me-2" style="color:#b03030;"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div style="background:#fdf0f0;border:1px solid #f0c0c0;border-radius:9px;padding:.75rem 1rem;margin-bottom:.9rem;">
                    <p class="mb-0" style="color:#b03030;font-size:.82rem;"><i class="bi bi-exclamation-triangle-fill me-1"></i>Tindakan ini tidak dapat dibatalkan!</p>
                </div>
                <p style="font-size:.88rem;">Yakin ingin menghapus produk <strong id="deleteProductName" style="color:#b03030;"></strong>?</p>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-sm" id="confirmDeleteBtn"
                        style="background:#b03030;border-color:#b03030;color:#fff;">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let deleteId = null;
function confirmDelete(id, name) {
    deleteId = id;
    document.getElementById('deleteProductName').textContent = name;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
    if (deleteId) document.getElementById('delete-form-' + deleteId).submit();
});
</script>
@endsection