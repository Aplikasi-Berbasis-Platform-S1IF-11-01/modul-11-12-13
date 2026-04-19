@extends('layouts.app')

<!-- Watermark: 2311102001-NofitaFitriyani -->

@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

@section('content')
<div style="max-width: 860px;">

    <div style="margin-bottom: 16px;">
        <a href="{{ route('products.index') }}" class="btn btn-outline btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title"><i class="fas fa-edit" style="color:#0047ba;margin-right:8px;"></i>Edit: {{ $product->name }}</div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- ROW 1: Nama & Satuan --}}
                <div class="form-row cols-2">
                    <div class="form-group">
                        <label class="form-label" for="name">
                            Nama Produk <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            value="{{ old('name', $product->name) }}"
                            placeholder="Contoh: Aqua Galon 19L"
                        >
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="unit">
                            Satuan <span class="required">*</span>
                        </label>
                        <select id="unit" name="unit" class="form-control {{ $errors->has('unit') ? 'is-invalid' : '' }}">
                            @foreach(['pcs','dus','botol','kg','liter','pack','lusin','karton','gram','ml'] as $u)
                                <option value="{{ $u }}" {{ old('unit', $product->unit) === $u ? 'selected' : '' }}>{{ $u }}</option>
                            @endforeach
                        </select>
                        @error('unit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>



                {{-- ROW 2: Harga & Stok --}}
                <div class="form-row cols-3">
                    <div class="form-group">
                        <label class="form-label" for="price">
                            Harga Jual (Rp) <span class="required">*</span>
                        </label>
                        <input
                            type="number"
                            id="price"
                            name="price"
                            class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                            value="{{ old('price', $product->price) }}"
                            placeholder="0"
                            min="0"
                        >
                        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="buying_price">Harga Beli (Rp)</label>
                        <input
                            type="number"
                            id="buying_price"
                            name="buying_price"
                            class="form-control {{ $errors->has('buying_price') ? 'is-invalid' : '' }}"
                            value="{{ old('buying_price', $product->buying_price) }}"
                            placeholder="0"
                            min="0"
                        >
                        @error('buying_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="stock">
                            Stok <span class="required">*</span>
                        </label>
                        <input
                            type="number"
                            id="stock"
                            name="stock"
                            class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}"
                            value="{{ old('stock', $product->stock) }}"
                            placeholder="0"
                            min="0"
                        >
                        @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>



                {{-- ROW 3: Deskripsi --}}
                <div class="form-group">
                    <label class="form-label" for="description">Deskripsi Produk</label>
                    <textarea
                        id="description"
                        name="description"
                        class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                        rows="3"
                        placeholder="Deskripsi singkat tentang produk ini..."
                    >{{ old('description', $product->description) }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- ROW 4: Gambar --}}
                <div class="form-group">
                    <label class="form-label" for="image">Gambar Produk</label>

                    {{-- Current image --}}
                    @if($product->image)
                    <div style="margin-bottom: 12px; display:flex; align-items:center; gap:12px;">
                        <img src="{{ Storage::url($product->image) }}" alt="Current"
                            style="height:80px;border-radius:10px;border:2px solid #e2e8f0;object-fit:cover;">
                        <div>
                            <div style="font-size:13px;font-weight:600;color:#334155;margin-bottom:4px;">Gambar saat ini</div>
                            <div style="font-size:12px;color:#94a3b8;">Upload gambar baru untuk mengganti</div>
                        </div>
                    </div>
                    @endif

                    <div style="border:2px dashed #e2e8f0;border-radius:12px;padding:24px;text-align:center;cursor:pointer;transition:border-color 0.2s;" id="drop-zone" onclick="document.getElementById('image').click()">
                        <div id="upload-placeholder">
                            <i class="fas fa-cloud-upload-alt" style="font-size:32px;color:#94a3b8;margin-bottom:10px;"></i>
                            <p style="font-size:13px;color:#64748b;margin-bottom:8px;">Klik atau drag & drop untuk mengganti gambar</p>
                            <p style="font-size:11px;color:#94a3b8;">JPG, PNG, WEBP — Max 2MB</p>
                        </div>
                        <img id="image-preview" src="" alt="Preview" style="display:none;max-height:160px;border-radius:10px;margin:0 auto;">
                        <input type="file" id="image" name="image" accept="image/*" style="display:none;" onchange="previewImage(event)">
                    </div>
                    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- ACTIONS --}}
                <div style="display:flex;gap:12px;justify-content:flex-end;padding-top:8px;border-top:1px solid #f1f5f9;margin-top:8px;">
                    <a href="{{ route('products.index') }}" class="btn btn-outline">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('upload-placeholder').style.display = 'none';
        const prev = document.getElementById('image-preview');
        prev.src = e.target.result;
        prev.style.display = 'block';
    };
    reader.readAsDataURL(file);
}

const dropZone = document.getElementById('drop-zone');
dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.style.borderColor = '#0047ba'; });
dropZone.addEventListener('dragleave', () => { dropZone.style.borderColor = '#e2e8f0'; });
dropZone.addEventListener('drop', e => {
    e.preventDefault();
    dropZone.style.borderColor = '#e2e8f0';
    const dt = e.dataTransfer;
    if (dt.files.length) {
        document.getElementById('image').files = dt.files;
        previewImage({ target: { files: dt.files } });
    }
});
</script>
@endsection
