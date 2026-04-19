@extends('layouts.app')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk Baru')
@section('page-subtitle', 'Lengkapi form di bawah untuk menambah produk ke inventaris')

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb" style="font-size: .85rem;">
                    <li class="breadcrumb-item">
                        <a href="{{ route('products.index') }}" class="text-decoration-none" style="color: #e94560;">
                            <i class="bi bi-box-seam me-1"></i>Produk
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-muted">Tambah Produk</li>
                </ol>
            </nav>

            <!-- Form Card -->
            <div class="card">
                <div class="card-header bg-white py-3 px-4"
                     style="border-bottom: 1px solid #e8eaed; border-radius: 16px 16px 0 0;">
                    <h5 class="mb-0 fw-bold" style="font-family: 'Syne', sans-serif; color: #1a1a2e;">
                        <i class="bi bi-plus-circle me-2" style="color: #e94560;"></i>
                        Informasi Produk
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('products.store') }}" id="createForm">
                        @csrf

                        <div class="row g-4">

                            {{-- Nama Produk --}}
                            <div class="col-12">
                                <label for="name" class="form-label">
                                    Nama Produk
                                    <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}"
                                    placeholder="Contoh: Indomie Goreng, Aqua 600ml..."
                                    maxlength="255"
                                    required
                                >
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Nama produk yang jelas dan mudah dicari</div>
                            </div>

                            {{-- Kategori --}}
                            <div class="col-md-6">
                                <label for="category" class="form-label">
                                    Kategori
                                    <span class="text-danger">*</span>
                                </label>

                                {{-- Dropdown kategori yang sudah ada + opsi tambah baru --}}
                                <select
                                    id="category"
                                    name="category"
                                    class="form-select @error('category') is-invalid @enderror"
                                    onchange="handleCategoryChange(this)"
                                    required
                                >
                                    <option value="" disabled {{ old('category') ? '' : 'selected' }}>
                                        — Pilih Kategori —
                                    </option>

                                    {{-- Opsi kategori yang sudah ada di database --}}
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>
                                            {{ $cat }}
                                        </option>
                                    @endforeach

                                    {{-- Opsi untuk tambah kategori baru --}}
                                    <option value="__new__">+ Tambah Kategori Baru...</option>
                                </select>

                                {{-- Input kategori baru (tersembunyi, muncul kalau pilih "Tambah Baru") --}}
                                <input
                                    type="text"
                                    id="newCategory"
                                    class="form-control mt-2 d-none"
                                    placeholder="Ketik nama kategori baru..."
                                    maxlength="100"
                                >

                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Harga --}}
                            <div class="col-md-6">
                                <label for="price" class="form-label">
                                    Harga Satuan (Rp)
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"
                                          style="background: #f8f9fa; border: 1.5px solid #e8eaed; border-right: none; border-radius: 10px 0 0 10px; font-weight: 600; font-size: .85rem;">
                                        Rp
                                    </span>
                                    <input
                                        type="number"
                                        id="price"
                                        name="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price') }}"
                                        placeholder="0"
                                        min="0"
                                        step="500"
                                        style="border-left: none; border-radius: 0 10px 10px 0;"
                                        required
                                    >
                                </div>
                                @error('price')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="form-text" id="pricePreview"></div>
                            </div>

                            {{-- Stok --}}
                            <div class="col-md-6">
                                <label for="stock" class="form-label">
                                    Jumlah Stok
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input
                                        type="number"
                                        id="stock"
                                        name="stock"
                                        class="form-control @error('stock') is-invalid @enderror"
                                        value="{{ old('stock', 0) }}"
                                        placeholder="0"
                                        min="0"
                                        required
                                    >
                                    <span class="input-group-text"
                                          style="background: #f8f9fa; border: 1.5px solid #e8eaed; border-left: none; border-radius: 0 10px 10px 0; font-size: .85rem;">
                                        unit
                                    </span>
                                </div>
                                @error('stock')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Deskripsi --}}
                            <div class="col-12">
                                <label for="description" class="form-label">
                                    Deskripsi
                                    <span class="text-muted" style="font-weight: 400;">(opsional)</span>
                                </label>
                                <textarea
                                    id="description"
                                    name="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    rows="3"
                                    placeholder="Tambahkan deskripsi produk, keterangan varian, dll..."
                                    maxlength="1000"
                                >{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <span id="charCount">0</span>/1000 karakter
                                </div>
                            </div>

                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="d-flex gap-2 mt-4 pt-3" style="border-top: 1px solid #e8eaed;">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-check-lg me-1"></i>
                                Simpan Produk
                            </button>
                            <a href="{{ route('products.index') }}"
                               class="btn btn-outline-secondary px-4"
                               style="border-radius: 10px;">
                                <i class="bi bi-arrow-left me-1"></i>
                                Kembali
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
<script>
    // Preview format harga saat user mengetik
    document.getElementById('price').addEventListener('input', function() {
        const val = parseInt(this.value);
        const preview = document.getElementById('pricePreview');
        if (val && val > 0) {
            preview.textContent = 'Rp ' + val.toLocaleString('id-ID');
        } else {
            preview.textContent = '';
        }
    });

    // Counter karakter untuk textarea deskripsi
    document.getElementById('description').addEventListener('input', function() {
        document.getElementById('charCount').textContent = this.value.length;
    });

    // Handle perubahan dropdown kategori
    function handleCategoryChange(select) {
        const newCategoryInput = document.getElementById('newCategory');
        const categorySelect   = document.getElementById('category');

        if (select.value === '__new__') {
            // Tampilkan input kategori baru
            newCategoryInput.classList.remove('d-none');
            newCategoryInput.focus();

            // Override: saat form disubmit, pakai nilai input baru
            newCategoryInput.addEventListener('input', function() {
                // Ganti value select dengan nilai yang diketik
                // Tambahkan opsi sementara jika belum ada
                let tempOption = select.querySelector('[value="__temp__"]');
                if (!tempOption) {
                    tempOption = new Option(this.value, this.value);
                    tempOption.value = this.value;
                    select.appendChild(tempOption);
                } else {
                    tempOption.value = this.value;
                    tempOption.textContent = this.value;
                }
                select.value = this.value;
            });
        } else {
            newCategoryInput.classList.add('d-none');
            newCategoryInput.value = '';
        }
    }
</script>
@endpush