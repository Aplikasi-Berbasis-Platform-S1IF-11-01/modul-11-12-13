@extends('layouts.app')
@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h5 class="fw-bold mb-0">Edit Produk</h5>
        <p class="text-muted small mb-0">
            Mengedit: <code>{{ $product->kode_produk }}</code> — {{ $product->nama_produk }}
        </p>
    </div>
</div>

<div class="row justify-content-center">
<div class="col-12 col-xl-9">

<form action="{{ route('products.update', $product) }}" method="POST" id="formEdit">
    @csrf
    @method('PUT')

    <div class="row g-3">

        {{-- ── Informasi Dasar ── --}}
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0 fw-semibold">
                        <i class="bi bi-info-circle me-2 text-primary"></i>Informasi Dasar
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label" for="kode_produk">
                                Kode Produk <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="kode_produk" name="kode_produk"
                                   class="form-control @error('kode_produk') is-invalid @enderror"
                                   value="{{ old('kode_produk', $product->kode_produk) }}" required>
                            @error('kode_produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-8">
                            <label class="form-label" for="nama_produk">
                                Nama Produk <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="nama_produk" name="nama_produk"
                                   class="form-control @error('nama_produk') is-invalid @enderror"
                                   value="{{ old('nama_produk', $product->nama_produk) }}" required>
                            @error('nama_produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="kategori">
                                Kategori <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="kategori" name="kategori"
                                   class="form-control @error('kategori') is-invalid @enderror"
                                   value="{{ old('kategori', $product->kategori) }}"
                                   list="kategoriList" required>
                            <datalist id="kategoriList">
                                @foreach($kategoris as $kat)
                                <option value="{{ $kat }}">
                                @endforeach
                            </datalist>
                            @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label" for="satuan">
                                Satuan <span class="text-danger">*</span>
                            </label>
                            <select id="satuan" name="satuan"
                                    class="form-select @error('satuan') is-invalid @enderror" required>
                                @php $satuanList = ['pcs','kg','gram','liter','ml','dus','lusin','pack','meter','roll','lembar','buah']; @endphp
                                @foreach($satuanList as $s)
                                <option value="{{ $s }}"
                                    {{ old('satuan', $product->satuan) == $s ? 'selected' : '' }}>
                                    {{ $s }}
                                </option>
                                @endforeach
                            </select>
                            @error('satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label" for="status">
                                Status <span class="text-danger">*</span>
                            </label>
                            <select id="status" name="status"
                                    class="form-select @error('status') is-invalid @enderror" required>
                                <option value="aktif"
                                    {{ old('status', $product->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif"
                                    {{ old('status', $product->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="deskripsi">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" rows="3"
                                      class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $product->deskripsi) }}</textarea>
                            @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- ── Stok & Harga ── --}}
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0 fw-semibold">
                        <i class="bi bi-currency-dollar me-2 text-success"></i>Stok & Harga
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label" for="stok">
                                Stok <span class="text-danger">*</span>
                            </label>
                            <input type="number" id="stok" name="stok" min="0"
                                   class="form-control @error('stok') is-invalid @enderror"
                                   value="{{ old('stok', $product->stok) }}" required>
                            @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="harga_beli">
                                Harga Beli (Rp) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" id="harga_beli" name="harga_beli" min="0" step="100"
                                       class="form-control @error('harga_beli') is-invalid @enderror"
                                       value="{{ old('harga_beli', $product->harga_beli) }}" required>
                                @error('harga_beli')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="harga_jual">
                                Harga Jual (Rp) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" id="harga_jual" name="harga_jual" min="0" step="100"
                                       class="form-control @error('harga_jual') is-invalid @enderror"
                                       value="{{ old('harga_jual', $product->harga_jual) }}" required>
                                @error('harga_jual')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="p-3 rounded-3" style="background:#f0f4ff; border:1px dashed #c7d2fe;">
                                <div class="row text-center">
                                    <div class="col">
                                        <div class="text-muted small">Margin Keuntungan</div>
                                        <div class="fw-bold text-primary fs-5" id="marginPct">0%</div>
                                    </div>
                                    <div class="col">
                                        <div class="text-muted small">Keuntungan / Item</div>
                                        <div class="fw-bold text-success fs-5" id="marginRp">Rp 0</div>
                                    </div>
                                    <div class="col">
                                        <div class="text-muted small">Est. Nilai Stok</div>
                                        <div class="fw-bold text-warning fs-5" id="nilaiStok">Rp 0</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- ── Info Update ── --}}
        <div class="col-12">
            <div class="card border-0" style="background:#f8faff;">
                <div class="card-body py-2 d-flex gap-4 flex-wrap small text-muted">
                    <span><i class="bi bi-clock me-1"></i>Dibuat: {{ $product->created_at->format('d M Y, H:i') }}</span>
                    <span><i class="bi bi-pencil me-1"></i>Diperbarui: {{ $product->updated_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>

        {{-- ── Submit ── --}}
        <div class="col-12 d-flex gap-2 justify-content-end">
            <a href="{{ route('products.index') }}" class="btn btn-light">
                <i class="bi bi-x me-1"></i>Batal
            </a>
            <a href="{{ route('products.show', $product) }}" class="btn btn-outline-info">
                <i class="bi bi-eye me-1"></i>Lihat Detail
            </a>
            <button type="submit" class="btn btn-warning text-dark">
                <i class="bi bi-save me-1"></i>Simpan Perubahan
            </button>
        </div>

    </div>
</form>

</div>
</div>

@endsection

@push('scripts')
<script>
    function hitungMargin() {
        const beli = parseFloat(document.getElementById('harga_beli').value) || 0;
        const jual = parseFloat(document.getElementById('harga_jual').value) || 0;
        const stok = parseInt(document.getElementById('stok').value) || 0;
        const diff = jual - beli;
        const pct  = beli > 0 ? ((diff / beli) * 100).toFixed(1) : 0;

        document.getElementById('marginPct').textContent = pct + '%';
        document.getElementById('marginRp').textContent  = 'Rp ' + diff.toLocaleString('id-ID');
        document.getElementById('nilaiStok').textContent = 'Rp ' + (jual * stok).toLocaleString('id-ID');
    }

    ['harga_beli','harga_jual','stok'].forEach(id => {
        document.getElementById(id).addEventListener('input', hitungMargin);
    });
    hitungMargin();
</script>
@endpush
