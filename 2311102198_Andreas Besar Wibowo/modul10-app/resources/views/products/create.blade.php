@extends('layouts.app')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk Baru')

@section('content')

    <div class="d-flex align-items-center gap-2 mb-4">
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i>
        </a>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size:14px;">
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
                <li class="breadcrumb-item active">Tambah Produk</li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-1 fw-bold" style="font-size:16px;">
                        <i class="bi bi-plus-circle text-primary me-2"></i>
                        Form Tambah Produk
                    </h5>
                    <small class="text-muted">Isi semua field yang diperlukan dengan benar</small>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('products.store') }}" method="POST" novalidate>
                        @csrf

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
                                        value="{{ old('code') }}" placeholder="Cth: MKN-0001" maxlength="50" required>
                                    @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Kode unik untuk identifikasi produk</div>
                                </div>

                                <div class="col-md-8">
                                    <label class="form-label">
                                        Nama Produk <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" placeholder="Nama lengkap produk" maxlength="150"
                                        required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        Kategori <span class="text-danger">*</span>
                                    </label>
                                    {{-- select TANPA name, hanya sebagai UI picker --}}
                                    <select id="categorySelect" class="form-select @error('category') is-invalid @enderror">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>
                                                {{ $cat }}
                                            </option>
                                        @endforeach
                                        <option value="__new__">+ Tambah Kategori Baru...</option>
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    {{-- Input teks untuk kategori baru --}}
                                    <input type="text" id="newCategoryInput" class="form-control mt-2 d-none"
                                        placeholder="Ketik nama kategori baru..." maxlength="100">
                                    {{-- Hidden input inilah yang benar-benar dikirim ke server --}}
                                    <input type="hidden" name="category" id="categoryHidden" value="{{ old('category') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        Satuan <span class="text-danger">*</span>
                                    </label>
                                    <select name="unit" class="form-select @error('unit') is-invalid @enderror" required>
                                        <option value="">-- Pilih Satuan --</option>
                                        @foreach(['Pcs', 'Buah', 'Box', 'Karung', 'Bungkus', 'Botol', 'Kaleng', 'Kotak', 'Kg', 'Gram', 'Liter', 'Ml', 'Tube', 'Lusin', 'Tabung'] as $unit)
                                            <option value="{{ $unit }}" {{ old('unit') === $unit ? 'selected' : '' }}>
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
                                            value="{{ old('buy_price', 0) }}" min="0" step="100" required
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
                                            value="{{ old('sell_price', 0) }}" min="0" step="100" required
                                            oninput="hitungMargin()">
                                        @error('sell_price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Margin Preview --}}
                                <div class="col-12">
                                    <div id="marginPreview"
                                        class="alert alert-info py-2 px-3 d-flex align-items-center gap-2"
                                        style="font-size:13px; display:none!important;">
                                        <i class="bi bi-graph-up"></i>
                                        <span id="marginText">Margin: –</span>
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
                                        Jumlah Stok Awal <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="stock"
                                        class="form-control @error('stock') is-invalid @enderror"
                                        value="{{ old('stock', 0) }}" min="0" required>
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        Stok Minimum (batas alert) <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="min_stock"
                                        class="form-control @error('min_stock') is-invalid @enderror"
                                        value="{{ old('min_stock', 5) }}" min="0" required>
                                    @error('min_stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Sistem akan memberi peringatan saat stok ≤ angka ini</div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- Deskripsi --}}
                        <div class="mb-4">
                            <label class="form-label">Deskripsi Produk</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                rows="3" maxlength="500"
                                placeholder="Keterangan tambahan tentang produk (opsional)...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Maksimal 500 karakter</div>
                        </div>

                        {{-- Actions --}}
                        <div class="d-flex gap-2 justify-content-end pt-2">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-x-lg me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-check-lg me-1"></i> Simpan Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Margin calculator
        function hitungMargin() {
            const beli = parseFloat(document.querySelector('[name="buy_price"]').value) || 0;
            const jual = parseFloat(document.querySelector('[name="sell_price"]').value) || 0;
            const preview = document.getElementById('marginPreview');
            const marginText = document.getElementById('marginText');

            if (beli > 0 && jual > 0) {
                const margin = ((jual - beli) / beli * 100).toFixed(1);
                const profit = (jual - beli).toLocaleString('id-ID');
                preview.style.display = 'flex';
                marginText.textContent = `Margin: ${margin}% | Keuntungan per unit: Rp ${profit}`;
                preview.className = `alert py-2 px-3 d-flex align-items-center gap-2 ${margin >= 0 ? 'alert-info' : 'alert-danger'}`;
            } else {
                preview.style.display = 'none';
            }
        }

        // Kategori baru
        const categorySelect = document.getElementById('categorySelect');
        const newCategoryInput = document.getElementById('newCategoryInput');
        const categoryHidden = document.getElementById('categoryHidden');

        // Set nilai awal hidden dari select (old value)
        if (categorySelect.value && categorySelect.value !== '__new__') {
            categoryHidden.value = categorySelect.value;
        }

        categorySelect.addEventListener('change', function () {
            if (this.value === '__new__') {
                newCategoryInput.classList.remove('d-none');
                newCategoryInput.focus();
                categoryHidden.value = '';
            } else {
                newCategoryInput.classList.add('d-none');
                categoryHidden.value = this.value;
            }
        });

        newCategoryInput.addEventListener('input', function () {
            categoryHidden.value = this.value.trim();
        });
    </script>
@endpush