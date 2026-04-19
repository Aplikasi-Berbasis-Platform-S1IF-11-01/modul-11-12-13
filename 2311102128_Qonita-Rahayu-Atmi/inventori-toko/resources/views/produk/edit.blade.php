@extends('layouts.app')

@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')
@section('breadcrumb', 'AiCik Stock / Produk / Edit')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="card-custom">
            <div class="mb-4 d-flex justify-content-between align-items-start flex-wrap gap-2">
                <div>
                    <h5 style="font-family:'Poppins',sans-serif;font-weight:600;margin-bottom:.25rem;">Edit Data Produk</h5>
                    <p style="font-size:.82rem;color:var(--muted);">
                        Mengubah: <span style="color:#7c3aed;font-weight:600;">{{ $produk->nama }}</span>
                        &nbsp;<span style="font-family:monospace;font-size:.78rem;background:#ede9fe;color:#5b21b6;padding:.1rem .4rem;border-radius:5px;">[{{ $produk->kode }}]</span>
                    </p>
                </div>
                <span class="{{ $produk->status === 'aktif' ? 'badge-aktif' : 'badge-nonaktif' }}" style="font-size:.78rem;">
                    {{ ucfirst($produk->status) }}
                </span>
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

            <form action="{{ route('produk.update', $produk) }}" method="POST" id="form-edit">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    {{-- Nama Produk --}}
                    <div class="col-12">
                        <label class="form-label-dark" for="nama">Nama Produk <span style="color:#f87171;">*</span></label>
                        <input
                            type="text"
                            id="nama"
                            name="nama"
                            class="form-control form-control-dark @error('nama') is-invalid @enderror"
                            value="{{ old('nama', $produk->nama) }}"
                            required
                        >
                        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Kode Produk --}}
                    <div class="col-md-6">
                        <label class="form-label-dark" for="kode">Kode Produk <span style="color:#f87171;">*</span></label>
                        <input
                            type="text"
                            id="kode"
                            name="kode"
                            class="form-control form-control-dark @error('kode') is-invalid @enderror"
                            value="{{ old('kode', $produk->kode) }}"
                            style="font-family:monospace;"
                            required
                        >
                        @error('kode') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="col-md-6">
                        <label class="form-label-dark" for="kategori_id">Kategori <span style="color:#f87171;">*</span></label>
                        <select id="kategori_id" name="kategori_id" class="form-select form-select-dark @error('kategori_id') is-invalid @enderror" required>
                            <option value="" disabled>-- Pilih Kategori --</option>
                            @foreach($kategoris as $k)
                                <option value="{{ $k->id }}" {{ old('kategori_id', $produk->kategori_id) == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                                value="{{ old('harga', $produk->harga) }}"
                                min="0" step="500" required
                                style="border-radius:0 10px 10px 0 !important;"
                            >
                        </div>
                        @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Stok --}}
                    <div class="col-md-3">
                        <label class="form-label-dark" for="stok">Stok <span style="color:#f87171;">*</span></label>
                        <input
                            type="number"
                            id="stok"
                            name="stok"
                            class="form-control form-control-dark @error('stok') is-invalid @enderror"
                            value="{{ old('stok', $produk->stok) }}"
                            min="0" required
                        >
                        @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Satuan --}}
                    <div class="col-md-3">
                        <label class="form-label-dark" for="satuan">Satuan <span style="color:#f87171;">*</span></label>
                        <select id="satuan" name="satuan" class="form-select form-select-dark @error('satuan') is-invalid @enderror" required>
                            @php
                            $satuans = ['pcs','buah','kg','gram','liter','ml','botol','bungkus','kotak','karung','pack','gulung','batang','tube','lembar'];
                            @endphp
                            @foreach($satuans as $s)
                                <option value="{{ $s }}" {{ old('satuan', $produk->satuan) == $s ? 'selected' : '' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                        @error('satuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6">
                        <label class="form-label-dark" for="status">Status <span style="color:#f87171;">*</span></label>
                        <select id="status" name="status" class="form-select form-select-dark @error('status') is-invalid @enderror" required>
                            <option value="aktif"    {{ old('status', $produk->status) == 'aktif'    ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', $produk->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="col-12">
                        <label class="form-label-dark" for="deskripsi">Deskripsi <span style="color:var(--muted);font-size:.75rem;">(opsional)</span></label>
                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            class="form-control form-control-dark @error('deskripsi') is-invalid @enderror"
                            rows="3"
                        >{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                        @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Info terakhir diubah --}}
                <div class="mt-3 p-3" style="background:#f9fafb;border-radius:9px;border:1px solid var(--border);">
                    <div style="font-size:.76rem;color:var(--muted);">
                        <i class="bi bi-clock-history me-1"></i>
                        Dibuat: <strong style="color:var(--text);">{{ $produk->created_at->format('d M Y, H:i') }}</strong>
                        &nbsp;&bull;&nbsp;
                        Diubah: <strong style="color:var(--text);">{{ $produk->updated_at->format('d M Y, H:i') }}</strong>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex gap-3 mt-4 flex-wrap">
                    <button type="submit" class="btn-primary-custom" id="btn-update">
                        <i class="bi bi-save-fill me-1"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('produk.index') }}" class="btn text-decoration-none"
                        style="background:#f3f4f6;color:var(--text);border:1px solid var(--border);border-radius:10px;padding:.6rem 1.4rem;font-size:.88rem;">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="button" class="btn"
                        style="background:#fef2f2;color:#dc2626;border:1px solid #fecaca;border-radius:10px;padding:.6rem 1.4rem;font-size:.88rem;"
                        onclick="confirmDelete({{ $produk->id }}, '{{ addslashes($produk->nama) }}')">
                        <i class="bi bi-trash-fill me-1"></i> Hapus Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Hapus --}}
<div class="modal fade" id="modalHapus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title" style="color:var(--text);font-family:'Poppins',sans-serif;">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="padding:1.5rem;text-align:center;">
                <div style="font-size:2.5rem;margin-bottom:.75rem;">
                    <div style="width:72px;height:72px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto .75rem;">
                        <i class="bi bi-trash-fill" style="font-size:1.8rem;color:#dc2626;"></i>
                    </div>
                </div>
                <p style="color:var(--text);">Kamu yakin ingin menghapus produk:</p>
                <p id="modal-produk-nama" style="font-weight:700;color:#f87171;font-size:1rem;"></p>
                <p style="font-size:.82rem;color:var(--muted);margin-top:.5rem;">
                    Tindakan ini <strong style="color:#f87171;">tidak dapat dibatalkan</strong>.
                </p>
            </div>
            <div class="modal-footer" style="justify-content:center;gap:.75rem;">
                <button type="button" class="btn" data-bs-dismiss="modal"
                    style="background:#f3f4f6;color:var(--text);border:1px solid var(--border);border-radius:9px;padding:.55rem 1.25rem;">
                    Batal
                </button>
                <form id="form-hapus" method="POST" action="">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn"
                        style="background:linear-gradient(135deg,#ef4444,#dc2626);color:#fff;border:none;border-radius:9px;padding:.55rem 1.25rem;font-weight:600;">
                        <i class="bi bi-trash-fill me-1"></i> Ya, Hapus!
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.getElementById('form-edit').addEventListener('submit', function () {
    const btn = document.getElementById('btn-update');
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';
    btn.disabled = true;
});

function confirmDelete(id, nama) {
    document.getElementById('modal-produk-nama').textContent = '"' + nama + '"';
    document.getElementById('form-hapus').action = '/produk/' + id;
    new bootstrap.Modal(document.getElementById('modalHapus')).show();
}
</script>
@endpush
