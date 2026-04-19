@extends('layouts.app')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')
@section('breadcrumb', 'AiCik Stock / Produk / Tambah')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="card-custom">
            <div class="mb-4">
                <h5 style="font-family:'Poppins',sans-serif;font-weight:600;margin-bottom:.25rem;">Form Tambah Produk Baru</h5>
                <p style="font-size:.82rem;color:var(--muted);">Isi semua field yang ditandai bintang (<span style="color:#f87171;">*</span>) dengan benar.</p>
            </div>

            @if($errors->any())
            <div class="alert-custom alert-error-custom mb-4">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <div>
                    <strong>Terdapat {{ $errors->count() }} kesalahan:</strong>
                    <ul class="mb-0 mt-1" style="padding-left:1.25rem;">
                        @foreach($errors->all() as $err)
                            <li style="font-size:.82rem;">{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <form action="{{ route('produk.store') }}" method="POST" id="form-create">
                @csrf

                <div class="row g-3">
                    {{-- Nama Produk --}}
                    <div class="col-12">
                        <label class="form-label-dark" for="nama">Nama Produk <span style="color:#f87171;">*</span></label>
                        <input
                            type="text"
                            id="nama"
                            name="nama"
                            class="form-control form-control-dark @error('nama') is-invalid @enderror"
                            placeholder="Contoh: Beras Premium 5kg"
                            value="{{ old('nama') }}"
                            required
                        >
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Kode Produk --}}
                    <div class="col-md-6">
                        <label class="form-label-dark" for="kode">Kode Produk <span style="color:#f87171;">*</span></label>
                        <input
                            type="text"
                            id="kode"
                            name="kode"
                            class="form-control form-control-dark @error('kode') is-invalid @enderror"
                            placeholder="Contoh: MKN-006"
                            value="{{ old('kode') }}"
                            style="font-family:monospace;"
                            required
                        >
                        @error('kode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="col-md-6">
                        <label class="form-label-dark" for="kategori_id">Kategori <span style="color:#f87171;">*</span></label>
                        <select
                            id="kategori_id"
                            name="kategori_id"
                            class="form-select form-select-dark @error('kategori_id') is-invalid @enderror"
                            required
                        >
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            @foreach($kategoris as $k)
                                <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Harga --}}
                    <div class="col-md-6">
                        <label class="form-label-dark" for="harga">Harga (Rp) <span style="color:#f87171;">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" style="background:#f9fafb;border:1px solid var(--border);border-right:none;color:var(--muted);border-radius:10px 0 0 10px;">Rp</span>
                            <input
                                type="number"
                                id="harga"
                                name="harga"
                                class="form-control form-control-dark @error('harga') is-invalid @enderror"
                                placeholder="0"
                                value="{{ old('harga') }}"
                                min="0"
                                step="500"
                                required
                                style="border-radius:0 10px 10px 0 !important;"
                            >
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Stok --}}
                    <div class="col-md-3">
                        <label class="form-label-dark" for="stok">Stok <span style="color:#f87171;">*</span></label>
                        <input
                            type="number"
                            id="stok"
                            name="stok"
                            class="form-control form-control-dark @error('stok') is-invalid @enderror"
                            placeholder="0"
                            value="{{ old('stok', 0) }}"
                            min="0"
                            required
                        >
                        @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Satuan --}}
                    <div class="col-md-3">
                        <label class="form-label-dark" for="satuan">Satuan <span style="color:#f87171;">*</span></label>
                        <select
                            id="satuan"
                            name="satuan"
                            class="form-select form-select-dark @error('satuan') is-invalid @enderror"
                            required
                        >
                            @php
                            $satuans = ['pcs','buah','kg','gram','liter','ml','botol','bungkus','kotak','karung','pack','gulung','batang','tube','lembar'];
                            @endphp
                            @foreach($satuans as $s)
                                <option value="{{ $s }}" {{ old('satuan') == $s ? 'selected' : '' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                        @error('satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6">
                        <label class="form-label-dark" for="status">Status <span style="color:#f87171;">*</span></label>
                        <select
                            id="status"
                            name="status"
                            class="form-select form-select-dark @error('status') is-invalid @enderror"
                            required
                        >
                            <option value="aktif"    {{ old('status', 'aktif') == 'aktif'    ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="col-12">
                        <label class="form-label-dark" for="deskripsi">Deskripsi <span style="color:var(--muted);font-size:.75rem;">(opsional)</span></label>
                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            class="form-control form-control-dark @error('deskripsi') is-invalid @enderror"
                            rows="3"
                            placeholder="Deskripsi singkat tentang produk ini..."
                        >{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex gap-3 mt-4 flex-wrap">
                    <button type="submit" class="btn-primary-custom" id="btn-submit">
                        <i class="bi bi-save-fill me-1"></i> Simpan Produk
                    </button>
                    <a href="{{ route('produk.index') }}" class="btn text-decoration-none"
                        style="background:#f3f4f6;color:var(--text);border:1px solid var(--border);border-radius:10px;padding:.6rem 1.4rem;font-size:.88rem;">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.getElementById('form-create').addEventListener('submit', function () {
    const btn = document.getElementById('btn-submit');
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';
    btn.disabled = true;
});
</script>
@endpush
