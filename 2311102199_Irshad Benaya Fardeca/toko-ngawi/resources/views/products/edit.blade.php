@extends('layouts.app')

@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
    <span style="color:#94a3b8;font-size:14px">/ Edit: {{ $product->name }}</span>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <div style="font-weight:700;font-size:15px;color:#0f172a">
                    <i class="bi bi-pencil-square me-2 text-primary"></i>Edit Produk
                </div>
                <div style="font-size:12px;color:#94a3b8;margin-top:2px">
                    ID Produk: #{{ $product->id }} &middot; Terakhir diubah: {{ $product->updated_at->diffForHumans() }}
                </div>
            </div>
            <div class="card-body p-4">

                @if($errors->any())
                    <div class="alert alert-danger mb-4">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        <strong>Terdapat {{ $errors->count() }} kesalahan:</strong>
                        <ul class="mb-0 mt-1 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('products.update', $product) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        {{-- Nama Produk --}}
                        <div class="col-12">
                            <label class="form-label" for="name">
                                Nama Produk <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $product->name) }}"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Nama produk"
                                maxlength="255"
                                required
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Kategori --}}
                        <div class="col-md-6">
                            <label class="form-label" for="category">
                                Kategori <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                id="category"
                                name="category"
                                value="{{ old('category', $product->category) }}"
                                class="form-control @error('category') is-invalid @enderror"
                                list="categoryList"
                                maxlength="100"
                                required
                            >
                            <datalist id="categoryList">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}">
                                @endforeach
                            </datalist>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Satuan --}}
                        <div class="col-md-6">
                            <label class="form-label" for="unit">
                                Satuan <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                id="unit"
                                name="unit"
                                value="{{ old('unit', $product->unit) }}"
                                class="form-control @error('unit') is-invalid @enderror"
                                list="unitList"
                                maxlength="50"
                                required
                            >
                            <datalist id="unitList">
                                <option value="pcs">
                                <option value="kg">
                                <option value="gram">
                                <option value="liter">
                                <option value="ml">
                                <option value="botol">
                                <option value="bungkus">
                                <option value="karung">
                                <option value="kotak">
                                <option value="sachet">
                                <option value="renceng">
                                <option value="galon">
                                <option value="lusin">
                            </datalist>
                            @error('unit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Harga --}}
                        <div class="col-md-6">
                            <label class="form-label" for="price">
                                Harga (Rp) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius:8px 0 0 8px;border-color:#e2e8f0;background:#f8fafc;font-size:13px;font-weight:600">Rp</span>
                                <input
                                    type="number"
                                    id="price"
                                    name="price"
                                    value="{{ old('price', $product->price) }}"
                                    class="form-control @error('price') is-invalid @enderror"
                                    min="0"
                                    step="100"
                                    style="border-radius:0 8px 8px 0"
                                    required
                                >
                            </div>
                            @error('price')
                                <div class="text-danger mt-1" style="font-size:13px">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Stok --}}
                        <div class="col-md-6">
                            <label class="form-label" for="stock">
                                Stok <span class="text-danger">*</span>
                            </label>
                            <input
                                type="number"
                                id="stock"
                                name="stock"
                                value="{{ old('stock', $product->stock) }}"
                                class="form-control @error('stock') is-invalid @enderror"
                                min="0"
                                required
                            >
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="col-12">
                            <label class="form-label" for="description">
                                Deskripsi <span class="text-muted" style="font-weight:400">(Opsional)</span>
                            </label>
                            <textarea
                                id="description"
                                name="description"
                                rows="3"
                                class="form-control @error('description') is-invalid @enderror"
                                maxlength="1000"
                            >{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2 justify-content-between flex-wrap">
                        {{-- Tombol Hapus --}}
                        <button
                            type="button"
                            class="btn btn-outline-danger"
                            onclick="confirmDelete({{ $product->id }}, '{{ addslashes($product->name) }}')"
                        >
                            <i class="bi bi-trash me-1"></i> Hapus Produk
                        </button>

                        <div class="d-flex gap-2">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-x me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-floppy me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;border:none">
            <div class="modal-body text-center p-4">
                <div style="width:64px;height:64px;background:#fef2f2;border-radius:50%;display:grid;place-items:center;margin:0 auto 16px;font-size:28px;color:#dc2626">
                    <i class="bi bi-trash3"></i>
                </div>
                <h5 style="font-weight:700;color:#0f172a;margin-bottom:8px">Hapus Produk?</h5>
                <p style="color:#64748b;font-size:14px;margin-bottom:0">
                    Yakin ingin menghapus <strong id="deleteProductName"></strong>?
                    <br>Data yang dihapus tidak bisa dikembalikan.
                </p>
            </div>
            <div class="modal-footer border-0 justify-content-center gap-2 pb-4">
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">
                        <i class="bi bi-trash me-1"></i> Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function confirmDelete(id, name) {
    document.getElementById('deleteProductName').textContent = name;
    document.getElementById('deleteForm').action = '/products/' + id;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endpush
