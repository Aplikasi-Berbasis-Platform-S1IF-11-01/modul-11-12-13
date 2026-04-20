@extends('layouts.app')

@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

@section('content')

    <div class="d-flex align-items-center gap-2 mb-4">
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i>
        </a>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size:14px;">
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
                <li class="breadcrumb-item active">Edit: {{ $product->name }}</li>
            </ol>
        </nav>
    </div>

    {{-- Info produk yang diedit --}}
    <div class="alert alert-primary d-flex align-items-center gap-3 mb-4" style="border-radius:10px;">
        <i class="bi bi-info-circle-fill fs-5"></i>
        <div>
            <strong>Sedang mengedit:</strong>
            <code class="ms-1">{{ $product->code }}</code> — {{ $product->name }}
            <span class="ms-2 badge bg-primary-subtle text-primary" style="font-size:11px;">{{ $product->category }}</span>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-1 fw-bold" style="font-size:16px;">
                        <i class="bi bi-pencil-square text-warning me-2"></i>
                        Form Edit Produk
                    </h5>
                    <small class="text-muted">Ubah data yang diperlukan lalu simpan</small>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('products.update', $product) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')

                        {{-- Section: Informasi Dasar --}}
                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div
                                    style="width:28px; height:28px; background:#eff6ff; border-radius:7px; display:flex; align-items:center; justify-content:center; font-size:14px;">
                                    📋</div>
                                <h6 class="mb-0 fw-bold text-primary" style="font-size:14px;">Informasi Dasar</h6>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">
                                        Kode Produk <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                                        value="{{ old('code', $product->code) }}" placeholder="Cth: MKN-0001" maxlength="50"
                                        required>
                                    @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-8">
                                    <label class="form-label">
                                        Nama Produk <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $product->name) }}" placeholder="Nama lengkap produk"
                                        maxlength="150" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        Kategori <span class="text-danger">*</span>
                                    </label>
                                    <select name="category" class="form-select @error('category') is-invalid @enderror"
                                        required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @php
                                            $currentCategory = old('category', $product->category);
                                            $allCategories = $categories->contains($currentCategory)
                                                ? $categories
                                                : $categories->push($currentCategory)->sort()->values();
                                        @endphp
                                        @foreach($allCategories as $cat)
                                            <option value="{{ $cat }}" {{ $currentCategory === $cat ? 'selected' : '' }}>
                                                {{ $cat }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        Satuan <span class="text-danger">*</span>
                                    </label>
                                    <select name="unit" class="form-select @error('unit') is-invalid @enderror" required>
                                        @php $currentUnit = old('unit', $product->unit); @endphp
                                        @foreach(['Pcs', 'Buah', 'Box', 'Karung', 'Bungkus', 'Botol', 'Kaleng', 'Kotak', 'Kg', 'Gram', 'Liter', 'Ml', 'Tube', 'Lusin', 'Tabung'] as $unit)
                                            <option value="{{ $unit }}" {{ $currentUnit === $unit ? 'selected' : '' }}>
                                                {{ $unit }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('unit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- Section: Harga --}}
                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div
                                    style="width:28px; height:28px; background:#f0fdf4; border-radius:7px; display:flex; align-items:center; justify-content:center; font-size:14px;">
                                    💰</div>
                                <h6 class="mb-0 fw-bold text-success" style="font-size:14px;">Informasi Harga</h6>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">
                                        Harga Beli (dari supplier) <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"
                                            style="border-radius:8px 0 0 8px; font-size:13px; color:#64748b;">Rp</span>
                                        <input type="number" name="buy_price"
                                            class="form-control @error('buy_price') is-invalid @enderror"
                                            value="{{ old('buy_price', $product->buy_price) }}" min="0" step="100" required
                                            oninput="hitungMargin()">
                                        @error('buy_price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        Harga Jual (ke pelanggan) <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"
                                            style="border-radius:8px 0 0 8px; font-size:13px; color:#64748b;">Rp</span>
                                        <input type="number" name="sell_price"
                                            class="form-control @error('sell_price') is-invalid @enderror"
                                            value="{{ old('sell_price', $product->sell_price) }}" min="0" step="100"
                                            required oninput="hitungMargin()">
                                        @error('sell_price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div id="marginPreview"
                                        class="alert alert-info py-2 px-3 d-flex align-items-center gap-2"
                                        style="font-size:13px;">
                                        <i class="bi bi-graph-up"></i>
                                        <span id="marginText">Menghitung margin...</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- Section: Stok --}}
                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div
                                    style="width:28px; height:28px; background:#fff7ed; border-radius:7px; display:flex; align-items:center; justify-content:center; font-size:14px;">
                                    📦</div>
                                <h6 class="mb-0 fw-bold text-warning" style="font-size:14px;">Informasi Stok</h6>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">
                                        Jumlah Stok <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="stock"
                                        class="form-control @error('stock') is-invalid @enderror"
                                        value="{{ old('stock', $product->stock) }}" min="0" required>
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if($product->isLowStock())
                                        <div class="form-text text-danger">
                                            <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                            Stok saat ini menipis ({{ $product->stock }} ≤ {{ $product->min_stock }})
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        Stok Minimum (batas alert) <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="min_stock"
                                        class="form-control @error('min_stock') is-invalid @enderror"
                                        value="{{ old('min_stock', $product->min_stock) }}" min="0" required>
                                    @error('min_stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- Deskripsi --}}
                        <div class="mb-4">
                            <label class="form-label">Deskripsi Produk</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                rows="3" maxlength="500"
                                placeholder="Keterangan tambahan (opsional)...">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Actions --}}
                        <div class="d-flex gap-2 justify-content-between pt-2">
                            {{-- Delete Button --}}
                            <button type="button" class="btn btn-outline-danger"
                                onclick="confirmDelete({{ $product->id }}, '{{ addslashes($product->name) }}')">
                                <i class="bi bi-trash3 me-1"></i> Hapus Produk
                            </button>

                            <div class="d-flex gap-2">
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary px-4">
                                    <i class="bi bi-x-lg me-1"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-warning px-4">
                                    <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- Hidden delete form --}}
                    <form id="deleteForm-{{ $product->id }}" action="{{ route('products.destroy', $product) }}"
                        method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- DELETE MODAL --}}
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:14px; border:none;">
                <div class="modal-header border-0 pb-0 pt-4 px-4">
                    <div class="text-center w-100">
                        <div
                            style="width:60px; height:60px; background:#fee2e2; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px; font-size:26px;">
                            🗑️</div>
                        <h5 class="modal-title fw-bold">Hapus Produk?</h5>
                    </div>
                </div>
                <div class="modal-body text-center px-4 pb-0">
                    <p class="text-muted" style="font-size:14px;">
                        Anda akan menghapus produk:<br>
                        <strong id="deleteProductName" class="text-dark"></strong>
                    </p>
                    <div class="alert alert-danger py-2 px-3 mt-2 d-flex align-items-center gap-2" style="font-size:13px;">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        Tindakan ini tidak dapat dibatalkan!
                    </div>
                </div>
                <div class="modal-footer border-0 pt-2 pb-4 px-4 justify-content-center gap-2">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> Batal
                    </button>
                    <button type="button" class="btn btn-danger px-4" id="confirmDeleteBtn">
                        <i class="bi bi-trash3 me-1"></i> Ya, Hapus!
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Auto hitung margin saat load
        window.addEventListener('load', hitungMargin);

        function hitungMargin() {
            const beli = parseFloat(document.querySelector('[name="buy_price"]').value) || 0;
            const jual = parseFloat(document.querySelector('[name="sell_price"]').value) || 0;
            const preview = document.getElementById('marginPreview');
            const marginText = document.getElementById('marginText');

            if (beli > 0 && jual > 0) {
                const margin = ((jual - beli) / beli * 100).toFixed(1);
                const profit = (jual - beli).toLocaleString('id-ID');
                marginText.textContent = `Margin: ${margin}% | Keuntungan per unit: Rp ${profit}`;
                preview.className = `alert py-2 px-3 d-flex align-items-center gap-2 ${parseFloat(margin) >= 0 ? 'alert-info' : 'alert-danger'}`;
            }
        }

        // Delete modal
        let deleteFormId = null;
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));

        function confirmDelete(productId, productName) {
            deleteFormId = productId;
            document.getElementById('deleteProductName').textContent = productName;
            deleteModal.show();
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (deleteFormId) {
                document.getElementById('deleteForm-' + deleteFormId).submit();
            }
        });
    </script>
@endpush