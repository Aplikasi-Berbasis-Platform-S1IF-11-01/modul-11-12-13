@extends('layouts.app')
@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk Baru')

@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h5 class="fw-bold mb-0">Tambah Produk Baru</h5>
        <p class="text-muted small mb-0">Isi form di bawah untuk menambahkan produk ke inventaris</p>
    </div>
</div>

<div class="row justify-content-center">
<div class="col-12 col-xl-9">

<form action="{{ route('products.store') }}" method="POST" id="formCreate">
    @csrf

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
                            <div class="input-group">
                                <input type="text" id="kode_produk" name="kode_produk"
                                       class="form-control @error('kode_produk') is-invalid @enderror"
                                       value="{{ old('kode_produk') }}"
                                       placeholder="PRD-0001" required>
                                <button type="button" class="btn btn-outline-secondary" id="btnGenerateKode"
                                        title="Generate kode otomatis">
                                    <i class="bi bi-magic"></i>
                                </button>
                                @error('kode_produk')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Klik ✨ untuk generate otomatis</small>
                        </div>

                        <div class="col-md-8">
                            <label class="form-label" for="nama_produk">
                                Nama Produk <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="nama_produk" name="nama_produk"
                                   class="form-control @error('nama_produk') is-invalid @enderror"
                                   value="{{ old('nama_produk') }}"
                                   placeholder="Contoh: Smartphone Samsung Galaxy A54" required>
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
                                   value="{{ old('kategori') }}"
                                   list="kategoriList"
                                   placeholder="Pilih atau ketik kategori baru" required>
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
                                <option value="{{ $s }}" {{ old('satuan') == $s ? 'selected' : '' }}>
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
                                <option value="aktif"    {{ old('status','aktif') == 'aktif'    ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="deskripsi">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" rows="3"
                                      class="form-control @error('deskripsi') is-invalid @enderror"
                                      placeholder="Deskripsi singkat produk (opsional)">{{ old('deskripsi') }}</textarea>
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
                                Stok Awal <span class="text-danger">*</span>
                            </label>
                            <input type="number" id="stok" name="stok" min="0"
                                   class="form-control @error('stok') is-invalid @enderror"
                                   value="{{ old('stok', 0) }}" required>
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
                                       value="{{ old('harga_beli', 0) }}" required>
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
                                       value="{{ old('harga_jual', 0) }}" required>
                                @error('harga_jual')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Preview margin --}}
                        <div class="col-12">
                            <div class="p-3 rounded-3" style="background:#f0f4ff; border:1px dashed #c7d2fe;" id="marginPreview">
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

        {{-- ── Submit ── --}}
        <div class="col-12 d-flex gap-2 justify-content-end">
            <a href="{{ route('products.index') }}" class="btn btn-light">
                <i class="bi bi-x me-1"></i>Batal
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i>Simpan Produk
            </button>
        </div>

    </div>
</form>

</div>
</div>

@endsection

@push('scripts')
<script>
    // Generate kode otomatis
    document.getElementById('btnGenerateKode').addEventListener('click', function () {
        fetch('{{ route("products.generate-kode") }}')
            .then(r => r.json())
            .then(data => { document.getElementById('kode_produk').value = data.kode; })
            .catch(() => alert('Gagal generate kode.'));
    });

    // Hitung margin
    function hitungMargin() {
        const beli = parseFloat(document.getElementById('harga_beli').value) || 0;
        const jual = parseFloat(document.getElementById('harga_jual').value) || 0;
        const stok = parseInt(document.getElementById('stok').value) || 0;
        const diff = jual - beli;
        const pct  = beli > 0 ? ((diff / beli) * 100).toFixed(1) : 0;

        document.getElementById('marginPct').textContent = pct + '%';
        document.getElementById('marginRp').textContent  = 'Rp ' + diff.toLocaleString('id-ID');
        document.getElementById('nilaiStok').textContent = 'Rp ' + (jual * stok).toLocaleString('id-ID');

        document.getElementById('marginPct').className =
            'fw-bold fs-5 ' + (diff >= 0 ? 'text-primary' : 'text-danger');
        document.getElementById('marginRp').className =
            'fw-bold fs-5 ' + (diff >= 0 ? 'text-success' : 'text-danger');
    }

    ['harga_beli','harga_jual','stok'].forEach(id => {
        document.getElementById(id).addEventListener('input', hitungMargin);
    });

    hitungMargin();
</script>
@endpush
