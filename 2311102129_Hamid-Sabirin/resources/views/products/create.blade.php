<x-app-layout>
    <x-slot name="header">Tambah Buku Baru</x-slot>

    <form method="POST" action="{{ route('products.store') }}">
        @csrf

        {{-- ═══ FORM CARD ═══ --}}
        <div style="background:white;border-radius:16px;border:1px solid #e2e8f0;box-shadow:0 1px 6px rgba(0,0,0,0.06);overflow:hidden">

            {{-- Card Header --}}
            <div style="padding:20px 28px;border-bottom:1px solid #f1f5f9;background:#fafafa;display:flex;align-items:center;gap:14px">
                <a href="{{ route('products.index') }}"
                   style="width:34px;height:34px;background:white;border:1px solid #e2e8f0;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#64748b;text-decoration:none;box-shadow:0 1px 3px rgba(0,0,0,0.06);flex-shrink:0;transition:all 0.15s"
                   onmouseover="this.style.borderColor='#94a3b8';this.style.color='#1e293b'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#64748b'">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </a>
                <div>
                    <h3 style="font-size:15px;font-weight:700;color:#1e293b;margin:0">Tambah Buku</h3>
                    <p style="font-size:13px;color:#94a3b8;margin:3px 0 0">Lengkapi semua field untuk menambahkan buku baru ke inventori.</p>
                </div>
            </div>

            {{-- Form Fields --}}
            <div style="padding:28px">

                {{-- Nama Buku --}}
                <div style="margin-bottom:22px">
                    <label for="name" style="display:block;font-size:13px;font-weight:700;color:#374151;margin-bottom:8px">
                        Nama Buku <span style="color:#ef4444">*</span>
                    </label>
                    <input id="name" type="text" name="name"
                           value="{{ old('name') }}" required autofocus
                           placeholder="Contoh: Matematika Wajib Kelas X SMA"
                           style="display:block;width:100%;box-sizing:border-box;padding:12px 16px;background:{{ $errors->has('name') ? '#fef2f2' : '#f8fafc' }};border:1.5px solid {{ $errors->has('name') ? '#fca5a5' : '#e2e8f0' }};border-radius:10px;font-size:14px;font-weight:500;color:#1e293b;outline:none;transition:all 0.18s;font-family:'Inter',sans-serif"
                           onfocus="this.style.borderColor='#3b82f6';this.style.background='white';this.style.boxShadow='0 0 0 4px rgba(59,130,246,0.08)'"
                           onblur="this.style.borderColor='{{ $errors->has('name') ? '#fca5a5' : '#e2e8f0' }}';this.style.background='{{ $errors->has('name') ? '#fef2f2' : '#f8fafc' }}';this.style.boxShadow='none'">
                    @error('name')
                    <p style="font-size:12px;color:#ef4444;font-weight:600;margin:6px 0 0;display:flex;align-items:center;gap:5px">
                        <svg width="12" height="12" viewBox="0 0 20 20" fill="#ef4444"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div style="margin-bottom:22px">
                    <label for="description" style="display:block;font-size:13px;font-weight:700;color:#374151;margin-bottom:8px">
                        Deskripsi <span style="font-size:12px;font-weight:400;color:#94a3b8">(Opsional)</span>
                    </label>
                    <textarea id="description" name="description" rows="4"
                              placeholder="Masukkan keterangan tentang buku: penerbit, tahun terbit, kurikulum, dll."
                              style="display:block;width:100%;box-sizing:border-box;padding:12px 16px;background:#f8fafc;border:1.5px solid {{ $errors->has('description') ? '#fca5a5' : '#e2e8f0' }};border-radius:10px;font-size:14px;font-weight:500;color:#1e293b;outline:none;resize:none;transition:all 0.18s;font-family:'Inter',sans-serif"
                              onfocus="this.style.borderColor='#3b82f6';this.style.background='white';this.style.boxShadow='0 0 0 4px rgba(59,130,246,0.08)'"
                              onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc';this.style.boxShadow='none'">{{ old('description') }}</textarea>
                </div>

                {{-- Harga & Stok — 2 kolom --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:22px">

                    {{-- Harga --}}
                    <div>
                        <label for="price" style="display:block;font-size:13px;font-weight:700;color:#374151;margin-bottom:8px">
                            Harga Jual <span style="color:#ef4444">*</span>
                        </label>
                        <div style="position:relative">
                            <span style="position:absolute;left:14px;top:50%;transform:translateY(-50%);font-size:13px;font-weight:700;color:#64748b;pointer-events:none">Rp</span>
                            <input id="price" type="number" name="price"
                                   value="{{ old('price') }}" required min="0" step="500"
                                   placeholder="85000"
                                   style="display:block;width:100%;box-sizing:border-box;padding:12px 16px 12px 40px;background:{{ $errors->has('price') ? '#fef2f2' : '#f8fafc' }};border:1.5px solid {{ $errors->has('price') ? '#fca5a5' : '#e2e8f0' }};border-radius:10px;font-size:14px;font-weight:500;color:#1e293b;outline:none;transition:all 0.18s;font-family:'Inter',sans-serif"
                                   onfocus="this.style.borderColor='#3b82f6';this.style.background='white';this.style.boxShadow='0 0 0 4px rgba(59,130,246,0.08)'"
                                   onblur="this.style.borderColor='{{ $errors->has('price') ? '#fca5a5' : '#e2e8f0' }}';this.style.background='{{ $errors->has('price') ? '#fef2f2' : '#f8fafc' }}';this.style.boxShadow='none'">
                        </div>
                        @error('price')
                        <p style="font-size:12px;color:#ef4444;font-weight:600;margin:6px 0 0">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Stok --}}
                    <div>
                        <label for="stock" style="display:block;font-size:13px;font-weight:700;color:#374151;margin-bottom:8px">
                            Stok Awal <span style="color:#ef4444">*</span>
                        </label>
                        <input id="stock" type="number" name="stock"
                               value="{{ old('stock', 0) }}" required min="0"
                               placeholder="0"
                               style="display:block;width:100%;box-sizing:border-box;padding:12px 16px;background:{{ $errors->has('stock') ? '#fef2f2' : '#f8fafc' }};border:1.5px solid {{ $errors->has('stock') ? '#fca5a5' : '#e2e8f0' }};border-radius:10px;font-size:14px;font-weight:500;color:#1e293b;outline:none;transition:all 0.18s;font-family:'Inter',sans-serif"
                               onfocus="this.style.borderColor='#3b82f6';this.style.background='white';this.style.boxShadow='0 0 0 4px rgba(59,130,246,0.08)'"
                               onblur="this.style.borderColor='{{ $errors->has('stock') ? '#fca5a5' : '#e2e8f0' }}';this.style.background='{{ $errors->has('stock') ? '#fef2f2' : '#f8fafc' }}';this.style.boxShadow='none'">
                        @error('stock')
                        <p style="font-size:12px;color:#ef4444;font-weight:600;margin:6px 0 0">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Info Banner --}}
                <div style="display:flex;align-items:flex-start;gap:12px;padding:14px 16px;background:#eff6ff;border:1px solid #bfdbfe;border-radius:12px">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;margin-top:1px"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    <p style="font-size:13px;color:#1d4ed8;font-weight:500;margin:0">Field bertanda <strong style="color:#ef4444">*</strong> wajib diisi. Deskripsi bersifat opsional namun sangat disarankan.</p>
                </div>
            </div>

            {{-- Card Footer --}}
            <div style="padding:18px 28px;border-top:1px solid #f1f5f9;background:#fafafa;display:flex;align-items:center;justify-content:space-between;gap:12px">
                <a href="{{ route('products.index') }}"
                   style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:white;border:1.5px solid #e2e8f0;border-radius:10px;font-size:13px;font-weight:600;color:#475569;text-decoration:none;transition:all 0.15s"
                   onmouseover="this.style.borderColor='#94a3b8';this.style.color='#1e293b'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#475569'">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    Batal
                </a>
                <button type="submit"
                        style="display:inline-flex;align-items:center;gap:8px;padding:10px 28px;background:linear-gradient(135deg,#3b82f6,#6366f1);border:none;border-radius:10px;font-size:13px;font-weight:700;color:white;cursor:pointer;box-shadow:0 4px 12px rgba(59,130,246,0.35);transition:all 0.2s;font-family:'Inter',sans-serif"
                        onmouseover="this.style.boxShadow='0 6px 20px rgba(59,130,246,0.5)';this.style.transform='translateY(-1px)'"
                        onmouseout="this.style.boxShadow='0 4px 12px rgba(59,130,246,0.35)';this.style.transform='translateY(0)'">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    Simpan Buku
                </button>
            </div>
        </div>
    </form>

</x-app-layout>
