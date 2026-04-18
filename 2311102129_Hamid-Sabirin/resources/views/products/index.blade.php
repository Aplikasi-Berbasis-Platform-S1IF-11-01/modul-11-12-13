<x-app-layout>
    <x-slot name="header">Daftar Buku</x-slot>

    {{-- Flash Message --}}
    @if(session('success'))
    <div id="flash-msg" style="display:flex;align-items:center;gap:12px;padding:14px 18px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:14px;margin-bottom:20px;box-shadow:0 1px 4px rgba(16,185,129,0.1)">
        <div style="width:30px;height:30px;background:#dcfce7;border:1px solid #bbf7d0;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
        </div>
        <p style="flex:1;font-size:13px;font-weight:600;color:#166534;margin:0">{{ session('success') }}</p>
        <button onclick="document.getElementById('flash-msg').style.display='none'" style="background:none;border:none;cursor:pointer;color:#16a34a;padding:4px">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    <script>setTimeout(() => { const el = document.getElementById('flash-msg'); if(el) el.style.display='none'; }, 4000);</script>
    @endif

    {{-- ═══ TABLE CARD ═══ --}}
    <div style="background:white;border-radius:16px;border:1px solid #e2e8f0;box-shadow:0 1px 6px rgba(0,0,0,0.06);overflow:hidden">

        {{-- Card header --}}
        <div style="padding:20px 28px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap">
            <div>
                <h3 style="font-size:15px;font-weight:700;color:#1e293b;margin:0">Inventori Buku Pelajaran</h3>
                <p style="font-size:13px;color:#94a3b8;font-weight:500;margin:4px 0 0">
                    Total <strong style="color:#3b82f6">{{ $products->total() }}</strong> buku terdaftar di sistem
                </p>
            </div>
            <a href="{{ route('products.create') }}"
               style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:linear-gradient(135deg,#3b82f6,#6366f1);color:white;font-size:13px;font-weight:700;border-radius:12px;text-decoration:none;box-shadow:0 4px 12px rgba(59,130,246,0.35);transition:all 0.2s ease;white-space:nowrap"
               onmouseover="this.style.boxShadow='0 6px 20px rgba(59,130,246,0.5)';this.style.transform='translateY(-1px)'"
               onmouseout="this.style.boxShadow='0 4px 12px rgba(59,130,246,0.35)';this.style.transform='translateY(0)'">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Tambah Buku
            </a>
        </div>

        {{-- Table --}}
        <div style="overflow-x:auto">
            <table style="width:100%;border-collapse:collapse;font-size:13px">
                <thead>
                    <tr style="background:#f8fafc;border-bottom:1px solid #e2e8f0">
                        <th style="padding:12px 20px 12px 28px;text-align:left;font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.07em;width:50px">No</th>
                        <th style="padding:12px 20px;text-align:left;font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.07em">Informasi Buku</th>
                        <th style="padding:12px 20px;text-align:left;font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.07em">Harga</th>
                        <th style="padding:12px 20px;text-align:center;font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.07em">Stok</th>
                        <th style="padding:12px 20px;text-align:center;font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.07em">Status</th>
                        <th style="padding:12px 28px 12px 20px;text-align:center;font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.07em">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr style="border-bottom:1px solid #f1f5f9;transition:background 0.12s"
                        onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">

                        <td style="padding:16px 20px 16px 28px;color:#cbd5e1;font-weight:700;font-size:12px">
                            {{ $loop->iteration + $products->firstItem() - 1 }}
                        </td>

                        <td style="padding:16px 20px;min-width:200px">
                            <p style="font-weight:700;color:#1e293b;margin:0;line-height:1.3">{{ $product->name }}</p>
                            <p style="font-size:12px;color:#94a3b8;font-weight:500;margin:4px 0 0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:260px">
                                {{ $product->description ?? '—' }}
                            </p>
                        </td>

                        <td style="padding:16px 20px;white-space:nowrap">
                            <span style="font-weight:800;color:#1e293b">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </td>

                        <td style="padding:16px 20px;text-align:center">
                            <span style="font-weight:900;color:#1e293b;font-size:16px">{{ $product->stock }}</span>
                        </td>

                        <td style="padding:16px 20px;text-align:center">
                            @if($product->stock > 0)
                                <span style="display:inline-flex;align-items:center;gap:5px;padding:5px 14px;background:#dcfce7;border:1px solid #bbf7d0;border-radius:20px;font-size:12px;font-weight:700;color:#16a34a">
                                    <span style="width:5px;height:5px;background:#22c55e;border-radius:50%"></span>Tersedia
                                </span>
                            @else
                                <span style="display:inline-flex;align-items:center;gap:5px;padding:5px 14px;background:#fee2e2;border:1px solid #fecaca;border-radius:20px;font-size:12px;font-weight:700;color:#dc2626">
                                    <span style="width:5px;height:5px;background:#ef4444;border-radius:50%"></span>Habis
                                </span>
                            @endif
                        </td>

                        <td style="padding:16px 28px 16px 20px;text-align:center">
                            <div style="display:flex;align-items:center;justify-content:center;gap:8px">

                                {{-- Tombol Edit --}}
                                <a href="{{ route('products.edit', $product) }}"
                                   style="display:inline-flex;align-items:center;gap:5px;padding:7px 13px;background:#eff6ff;border:1px solid #bfdbfe;border-radius:8px;font-size:11px;font-weight:700;color:#2563eb;text-decoration:none;transition:all 0.15s"
                                   onmouseover="this.style.background='#2563eb';this.style.color='white';this.style.borderColor='#2563eb'"
                                   onmouseout="this.style.background='#eff6ff';this.style.color='#2563eb';this.style.borderColor='#bfdbfe'">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    Ubah
                                </a>

                                {{-- Tombol Hapus — trigger modal vanilla JS --}}
                                <button type="button"
                                        onclick="openDeleteModal({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                        style="display:inline-flex;align-items:center;gap:5px;padding:7px 13px;background:#fef2f2;border:1px solid #fecaca;border-radius:8px;font-size:11px;font-weight:700;color:#dc2626;cursor:pointer;transition:all 0.15s"
                                        onmouseover="this.style.background='#dc2626';this.style.color='white';this.style.borderColor='#dc2626'"
                                        onmouseout="this.style.background='#fef2f2';this.style.color='#dc2626';this.style.borderColor='#fecaca'">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path></svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding:64px 28px;text-align:center">
                            <div style="display:flex;flex-direction:column;align-items:center;gap:14px">
                                <div style="width:72px;height:72px;background:#f1f5f9;border:2px dashed #cbd5e1;border-radius:18px;display:flex;align-items:center;justify-content:center">
                                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                                </div>
                                <div>
                                    <p style="font-size:15px;font-weight:700;color:#475569;margin:0">Belum Ada Data</p>
                                    <p style="font-size:13px;color:#94a3b8;margin:6px 0 0">Tambahkan buku pertama ke inventori</p>
                                </div>
                                <a href="{{ route('products.create') }}" style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:#3b82f6;color:white;border-radius:10px;font-size:13px;font-weight:700;text-decoration:none">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    Tambah Sekarang
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
        <div style="padding:14px 28px;border-top:1px solid #f1f5f9;background:#fafafa">
            {{ $products->links() }}
        </div>
        @endif
    </div>


    {{-- ════════════════════════════════════════════════════════
         DELETE MODAL — Pure Vanilla JS (no Alpine/Vite needed)
    ════════════════════════════════════════════════════════ --}}

    {{-- Backdrop --}}
    <div id="modal-backdrop"
         onclick="closeDeleteModal()"
         style="display:none;position:fixed;inset:0;background:rgba(15,23,42,0.6);backdrop-filter:blur(4px);z-index:40;opacity:0;transition:opacity 0.25s ease"></div>

    {{-- Modal Panel --}}
    <div id="modal-panel"
         style="display:none;position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;padding:20px">
        <div style="background:white;border-radius:24px;box-shadow:0 25px 60px rgba(0,0,0,0.2);width:100%;max-width:420px;overflow:hidden;transform:scale(0.9);opacity:0;transition:all 0.25s ease" id="modal-card">

            {{-- Header --}}
            <div style="padding:24px 24px 0">
                <div style="display:flex;align-items:flex-start;gap:16px">
                    <div style="width:52px;height:52px;background:#fee2e2;border:2px solid #fecaca;border-radius:16px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path></svg>
                    </div>
                    <div style="flex:1">
                        <h2 style="font-size:17px;font-weight:800;color:#1e293b;margin:0">Hapus Data Buku?</h2>
                        <p style="font-size:13px;color:#64748b;margin:4px 0 0">Tindakan ini <strong style="color:#dc2626">permanen</strong> dan tidak bisa dibatalkan.</p>
                    </div>
                    <button onclick="closeDeleteModal()" style="width:30px;height:30px;background:#f1f5f9;border:none;border-radius:8px;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;color:#64748b"
                            onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
            </div>

            {{-- Body --}}
            <div style="padding:20px 24px">
                {{-- Nama buku preview --}}
                <div style="display:flex;align-items:center;gap:12px;padding:14px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;margin-bottom:18px">
                    <div style="width:36px;height:36px;background:#e2e8f0;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                    </div>
                    <div style="min-width:0">
                        <p style="font-size:11px;color:#94a3b8;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;margin:0">Buku yang akan dihapus</p>
                        <p id="modal-product-name" style="font-size:13px;font-weight:700;color:#1e293b;margin:3px 0 0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"></p>
                    </div>
                </div>
                {{-- Warning list --}}
                <div style="display:flex;flex-direction:column;gap:10px;margin-bottom:4px">
                    <div style="display:flex;align-items:center;gap:10px">
                        <div style="width:18px;height:18px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                            <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="3" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </div>
                        <span style="font-size:13px;color:#475569;font-weight:500">Data buku akan dihapus dari database</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:10px">
                        <div style="width:18px;height:18px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                            <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="3" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </div>
                        <span style="font-size:13px;color:#475569;font-weight:500">Tindakan ini tidak bisa dibatalkan</span>
                    </div>
                </div>
                {{-- Hidden delete form --}}
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                </form>
            </div>

            {{-- Footer --}}
            <div style="padding:0 24px 24px;display:flex;gap:10px">
                <button onclick="closeDeleteModal()"
                        style="flex:1;padding:11px 20px;background:white;border:2px solid #e2e8f0;border-radius:14px;font-size:13px;font-weight:700;color:#475569;cursor:pointer;font-family:'Inter',sans-serif"
                        onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='white'">
                    Kembali
                </button>
                <button onclick="document.getElementById('deleteForm').submit()"
                        style="flex:1;display:flex;align-items:center;justify-content:center;gap:7px;padding:11px 20px;background:linear-gradient(135deg,#ef4444,#dc2626);border:none;border-radius:14px;font-size:13px;font-weight:700;color:white;cursor:pointer;font-family:'Inter',sans-serif;box-shadow:0 4px 14px rgba(239,68,68,0.4)"
                        onmouseover="this.style.boxShadow='0 6px 20px rgba(239,68,68,0.55)';this.style.transform='translateY(-1px)'"
                        onmouseout="this.style.boxShadow='0 4px 14px rgba(239,68,68,0.4)';this.style.transform='translateY(0)'">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path></svg>
                    Ya, Hapus Sekarang
                </button>
            </div>
        </div>
    </div>

    {{-- ════ VANILLA JS MODAL CONTROLLER ════ --}}
    <script>
        function openDeleteModal(productId, productName) {
            // Set nama buku & form action
            document.getElementById('modal-product-name').textContent = productName;
            document.getElementById('deleteForm').action = '/products/' + productId;

            // Tampilkan backdrop & panel
            var backdrop = document.getElementById('modal-backdrop');
            var panel    = document.getElementById('modal-panel');
            var card     = document.getElementById('modal-card');

            backdrop.style.display = 'block';
            panel.style.display    = 'flex';
            document.body.style.overflow = 'hidden';

            // Animasi masuk
            requestAnimationFrame(function() {
                requestAnimationFrame(function() {
                    backdrop.style.opacity = '1';
                    card.style.opacity     = '1';
                    card.style.transform   = 'scale(1)';
                });
            });
        }

        function closeDeleteModal() {
            var backdrop = document.getElementById('modal-backdrop');
            var panel    = document.getElementById('modal-panel');
            var card     = document.getElementById('modal-card');

            backdrop.style.opacity = '0';
            card.style.opacity     = '0';
            card.style.transform   = 'scale(0.9)';

            setTimeout(function() {
                backdrop.style.display = 'none';
                panel.style.display    = 'none';
                document.body.style.overflow = '';
            }, 250);
        }

        // Tutup dengan tombol ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeDeleteModal();
        });
    </script>

</x-app-layout>
