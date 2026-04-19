<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Pak Cik & Aimar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .active-menu { background-color: #fdf2f7; color: #db2777; border-right: 4px solid #db2777; }
    </style>
</head>
<body class="antialiased">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-white border-r border-gray-100 fixed h-full flex flex-col z-50">
            <div class="p-6">
                <h1 class="text-2xl font-extrabold text-pink-600 tracking-tight">Pak Cik <span class="text-gray-800">& Aimar</span></h1>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Skincare Inventory System</p>
            </div>

            <nav class="mt-4 flex-1">
                <p class="px-6 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-4">Navigasi</p>
                
                <a href="{{ route('dashboard') }}" class="active-menu flex items-center gap-3 px-6 py-4 transition-all group">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span class="font-bold text-sm">Dashboard</span>
                </a>

                <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-6 py-4 text-gray-500 hover:bg-pink-50 hover:text-pink-600 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    <span class="font-semibold text-sm">Daftar Produk</span>
                </a>
            </nav>

            <div class="p-4 border-t border-gray-50">
                <div class="bg-gray-50 rounded-2xl p-4 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center font-bold text-pink-600 text-xs">AM</div>
                    <div class="overflow-hidden">
                        <p class="text-xs font-bold text-gray-800 truncate">Admin Toko</p>
                        <p class="text-[10px] text-gray-500 truncate">aimar@toko.com</p>
                    </div>
                </div>
            </div>
        </aside>

        <main class="flex-1 ml-64 bg-[#fcfdfe]">
            <header class="h-20 bg-white/80 backdrop-blur-md px-10 flex items-center justify-between border-b border-gray-100 sticky top-0 z-40">
                <div>
                    <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Overview Stok Aimar</h2>
                    <p class="text-[10px] text-gray-400 font-medium">Pak Cik & Aimar / Dashboard</p>
                </div>

                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center gap-3 focus:outline-none">
                        <span class="text-xs font-bold text-gray-600">Halo, <span class="text-pink-600 uppercase">{{ Auth::user()->name ?? 'Mas Jakobi' }}</span></span>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-3 w-48 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50 overflow-hidden" style="display: none;">
                        <a href="{{ route('profile.edit') }}" class="block px-6 py-3 text-xs font-bold text-gray-600 hover:bg-pink-50 transition">Profil Saya</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-6 py-3 text-xs font-bold text-rose-500 hover:bg-rose-50 transition">Keluar Sistem</button>
                        </form>
                    </div>
                </div>
            </header>

            <div class="p-10 max-w-[1400px] mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Produk</p>
                            <h3 class="text-3xl font-extrabold text-gray-800">{{ $totalProduk }}</h3>
                        </div>
                        <div class="p-3 bg-indigo-50 rounded-xl text-indigo-500">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Stok (Pcs)</p>
                            <h3 class="text-3xl font-extrabold text-emerald-500">{{ $totalStok }}</h3>
                        </div>
                        <div class="p-3 bg-emerald-50 rounded-xl text-emerald-500">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9zM3 8a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"></path></svg>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Stok Rendah</p>
                            <h3 class="text-3xl font-extrabold text-amber-500">{{ $stokRendah }}</h3>
                        </div>
                        <div class="p-3 bg-amber-50 rounded-xl text-amber-500">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Stok Habis</p>
                            <h3 class="text-3xl font-extrabold text-rose-500">{{ $stokHabis }}</h3>
                        </div>
                        <div class="p-3 bg-rose-50 rounded-xl text-rose-500">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
                    <div class="p-8 flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Inventori Skincare Terbaru</h3>
                            <p class="text-xs text-gray-400 font-medium mt-1">Stok barang yang baru saja dimasukkan Mas Aimar.</p>
                        </div>
                        <a href="{{ route('products.index') }}" class="bg-pink-600 hover:bg-pink-700 text-white px-6 py-3 rounded-xl text-xs font-bold transition-all shadow-lg shadow-pink-100 uppercase tracking-widest">Kelola Semua Stok</a>
                    </div>

                    <div class="overflow-x-auto p-4">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] border-b border-gray-50">
                                    <th class="px-8 py-5">Nama Produk</th>
                                    <th class="px-8 py-5">Stok</th>
                                    <th class="px-8 py-5">Harga</th>
                                    <th class="px-8 py-5">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse ($produkTerbaru as $product)
                                <tr class="hover:bg-gray-50 transition-all duration-150">
                                    <td class="px-8 py-6 font-bold text-gray-700 text-sm">{{ $product->nama }}</td>
                                    <td class="px-8 py-6">
                                        <span class="font-bold text-sm text-gray-600 underline decoration-pink-200 underline-offset-4">{{ $product->stok }} pcs</span>
                                    </td>
                                    <td class="px-8 py-6 font-bold text-gray-700 text-sm">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                    <td class="px-8 py-6">
                                        @if($product->stok <= 0)
                                            <span class="flex items-center gap-2 text-[10px] font-bold text-rose-500"><span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span> Kosong</span>
                                        @elseif($product->stok <= 5)
                                            <span class="flex items-center gap-2 text-[10px] font-bold text-amber-500"><span class="w-2 h-2 rounded-full bg-amber-500"></span> Menipis</span>
                                        @else
                                            <span class="flex items-center gap-2 text-[10px] font-bold text-emerald-500"><span class="w-2 h-2 rounded-full bg-emerald-500"></span> Aman</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="p-20 text-center text-gray-300 font-bold uppercase tracking-widest">Belum ada stok barang</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>