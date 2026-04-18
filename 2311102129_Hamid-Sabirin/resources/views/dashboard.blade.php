<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    @php
        $totalProduk = \App\Models\Product::count();
        $totalStok   = \App\Models\Product::sum('stock');
        $outOfStock  = \App\Models\Product::where('stock', 0)->count();
    @endphp

    {{-- ═══════════════════════════════════════════════════════
         STAT CARDS
    ═══════════════════════════════════════════════════════ --}}
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-bottom:28px">

        {{-- Card 1: Total Produk --}}
        <div style="background:white;border-radius:16px;border:1px solid #e2e8f0;box-shadow:0 1px 6px rgba(0,0,0,0.06);padding:24px;position:relative;overflow:hidden;transition:all 0.2s ease"
             onmouseover="this.style.boxShadow='0 8px 24px rgba(59,130,246,0.12)';this.style.transform='translateY(-2px)'"
             onmouseout="this.style.boxShadow='0 1px 6px rgba(0,0,0,0.06)';this.style.transform='translateY(0)'">
            {{-- Decorative bg --}}
            <div style="position:absolute;right:-20px;top:-20px;width:100px;height:100px;background:radial-gradient(circle,rgba(59,130,246,0.08),transparent 70%);border-radius:50%"></div>
            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:20px">
                <div>
                    <p style="font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.08em;margin:0 0 10px">Total Produk</p>
                    <p style="font-size:38px;font-weight:900;color:#1e293b;margin:0;line-height:1;letter-spacing:-1px">{{ $totalProduk }}</p>
                </div>
                <div style="width:48px;height:48px;background:linear-gradient(135deg,#dbeafe,#bfdbfe);border-radius:14px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                </div>
            </div>
            <div style="padding-top:16px;border-top:1px solid #f1f5f9">
                <span style="display:inline-flex;align-items:center;gap:6px;font-size:12px;font-weight:600;color:#2563eb;background:#eff6ff;padding:5px 12px;border-radius:20px">
                    <span style="width:6px;height:6px;background:#3b82f6;border-radius:50%"></span>
                    Buku terdaftar di sistem
                </span>
            </div>
        </div>

        {{-- Card 2: Total Stok --}}
        <div style="background:white;border-radius:16px;border:1px solid #e2e8f0;box-shadow:0 1px 6px rgba(0,0,0,0.06);padding:24px;position:relative;overflow:hidden;transition:all 0.2s ease"
             onmouseover="this.style.boxShadow='0 8px 24px rgba(99,102,241,0.12)';this.style.transform='translateY(-2px)'"
             onmouseout="this.style.boxShadow='0 1px 6px rgba(0,0,0,0.06)';this.style.transform='translateY(0)'">
            <div style="position:absolute;right:-20px;top:-20px;width:100px;height:100px;background:radial-gradient(circle,rgba(99,102,241,0.08),transparent 70%);border-radius:50%"></div>
            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:20px">
                <div>
                    <p style="font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.08em;margin:0 0 10px">Total Stok Gudang</p>
                    <p style="font-size:38px;font-weight:900;color:#1e293b;margin:0;line-height:1;letter-spacing:-1px">{{ number_format($totalStok, 0, ',', '.') }}</p>
                </div>
                <div style="width:48px;height:48px;background:linear-gradient(135deg,#e0e7ff,#c7d2fe);border-radius:14px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#4f46e5" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                </div>
            </div>
            <div style="padding-top:16px;border-top:1px solid #f1f5f9">
                <span style="display:inline-flex;align-items:center;gap:6px;font-size:12px;font-weight:600;color:#4f46e5;background:#eef2ff;padding:5px 12px;border-radius:20px">
                    <span style="width:6px;height:6px;background:#6366f1;border-radius:50%"></span>
                    Unit fisik tersedia
                </span>
            </div>
        </div>

        {{-- Card 3: Perlu Restock --}}
        <div style="background:white;border-radius:16px;border:1px solid {{ $outOfStock > 0 ? '#fecaca' : '#e2e8f0' }};box-shadow:0 1px 6px rgba(0,0,0,0.06);padding:24px;position:relative;overflow:hidden;transition:all 0.2s ease"
             onmouseover="this.style.boxShadow='0 8px 24px rgba(239,68,68,0.1)';this.style.transform='translateY(-2px)'"
             onmouseout="this.style.boxShadow='0 1px 6px rgba(0,0,0,0.06)';this.style.transform='translateY(0)'">
            <div style="position:absolute;right:-20px;top:-20px;width:100px;height:100px;background:radial-gradient(circle,rgba(239,68,68,0.07),transparent 70%);border-radius:50%"></div>
            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:20px">
                <div>
                    <p style="font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.08em;margin:0 0 10px">Perlu Restock</p>
                    <p style="font-size:38px;font-weight:900;color:{{ $outOfStock > 0 ? '#ef4444' : '#1e293b' }};margin:0;line-height:1;letter-spacing:-1px">{{ $outOfStock }}</p>
                </div>
                <div style="width:48px;height:48px;background:{{ $outOfStock > 0 ? 'linear-gradient(135deg,#fee2e2,#fecaca)' : 'linear-gradient(135deg,#f1f5f9,#e2e8f0)' }};border-radius:14px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="{{ $outOfStock > 0 ? '#ef4444' : '#94a3b8' }}" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                </div>
            </div>
            <div style="padding-top:16px;border-top:1px solid #f1f5f9">
                @if($outOfStock > 0)
                    <span style="display:inline-flex;align-items:center;gap:6px;font-size:12px;font-weight:600;color:#dc2626;background:#fef2f2;padding:5px 12px;border-radius:20px">
                        <span style="width:6px;height:6px;background:#ef4444;border-radius:50%"></span>
                        Segera Restok
                    </span>
                @else
                    <span style="display:inline-flex;align-items:center;gap:6px;font-size:12px;font-weight:600;color:#16a34a;background:#f0fdf4;padding:5px 12px;border-radius:20px">
                        <span style="width:6px;height:6px;background:#22c55e;border-radius:50%"></span>
                        Semua stok tersedia
                    </span>
                @endif
            </div>
        </div>

    </div>

    {{-- ═══════════════════════════════════════════════════════
         RECENT PRODUCTS TABLE
    ═══════════════════════════════════════════════════════ --}}
    <div style="background:white;border-radius:16px;border:1px solid #e2e8f0;box-shadow:0 1px 6px rgba(0,0,0,0.06);overflow:hidden">

        {{-- Table Header --}}
        <div style="padding:20px 28px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;gap:16px">
            <div>
                <h3 style="font-size:15px;font-weight:700;color:#1e293b;margin:0">5 Penambahan Terakhir</h3>
                <p style="font-size:13px;color:#94a3b8;font-weight:500;margin:4px 0 0">Buku terbaru yang masuk ke inventori</p>
            </div>
            <a href="{{ route('products.index') }}"
               style="display:inline-flex;align-items:center;gap:6px;font-size:13px;font-weight:600;color:#2563eb;background:#eff6ff;border:1px solid #bfdbfe;padding:8px 16px;border-radius:10px;text-decoration:none;transition:all 0.15s"
               onmouseover="this.style.background='#dbeafe'" onmouseout="this.style.background='#eff6ff'">
                Lihat Semua
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </a>
        </div>

        {{-- Table --}}
        <div style="overflow-x:auto">
            <table style="width:100%;border-collapse:collapse;font-size:13px">
                <thead>
                    <tr style="background:#f8fafc;border-bottom:1px solid #e2e8f0">
                        <th style="padding:12px 28px;text-align:left;font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.07em">Nama Buku</th>
                        <th style="padding:12px 20px;text-align:left;font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.07em">Harga</th>
                        <th style="padding:12px 20px;text-align:center;font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.07em">Stok</th>
                        <th style="padding:12px 28px 12px 20px;text-align:center;font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.07em">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\App\Models\Product::latest()->take(5)->get() as $product)
                    <tr style="border-bottom:1px solid #f1f5f9;transition:background 0.12s"
                        onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">

                        <td style="padding:16px 28px">
                            <p style="font-weight:700;color:#1e293b;margin:0">{{ $product->name }}</p>
                            <p style="font-size:12px;color:#94a3b8;margin:3px 0 0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:300px">
                                {{ $product->description ?? '—' }}
                            </p>
                        </td>

                        <td style="padding:16px 20px;white-space:nowrap">
                            <span style="font-weight:800;color:#1e293b">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </td>

                        <td style="padding:16px 20px;text-align:center">
                            <span style="font-weight:900;color:#1e293b;font-size:16px">{{ $product->stock }}</span>
                        </td>

                        <td style="padding:16px 28px 16px 20px;text-align:center">
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
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="padding:64px 28px;text-align:center">
                            <div style="display:flex;flex-direction:column;align-items:center;gap:14px">
                                <div style="width:64px;height:64px;background:#f1f5f9;border:2px dashed #cbd5e1;border-radius:16px;display:flex;align-items:center;justify-content:center">
                                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p style="font-size:15px;font-weight:700;color:#475569;margin:0">Belum Ada Data</p>
                                    <p style="font-size:13px;color:#94a3b8;margin:6px 0 0">Belum ada buku yang ditambahkan</p>
                                </div>
                                <a href="{{ route('products.create') }}"
                                   style="display:inline-flex;align-items:center;gap:7px;padding:10px 20px;background:linear-gradient(135deg,#3b82f6,#6366f1);color:white;border-radius:10px;font-size:13px;font-weight:700;text-decoration:none">
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
    </div>

</x-app-layout>
