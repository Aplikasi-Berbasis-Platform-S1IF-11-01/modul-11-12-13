<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk | Pak Cik & Aimar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .active-menu { background-color: #fdf2f7; color: #db2777; border-right: 4px solid #db2777; }
        /* x-cloak mencegah elemen Alpine muncul sebelum script siap */
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="antialiased" x-data="{ deleteModal: false, activeId: null, activeName: '' }">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-white border-r border-gray-100 fixed h-full flex flex-col z-50">
            <div class="p-6">
                <h1 class="text-2xl font-extrabold text-pink-600 tracking-tight"> Pak Cik <span class="text-gray-800"> & Aimar</span></h1>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Skincare Inventory System</p>
            </div>

            <nav class="mt-4 flex-1">
                <p class="px-6 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-4">Navigasi</p>
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-6 py-4 text-gray-500 hover:bg-pink-50 hover:text-pink-600 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span class="font-semibold text-sm">Dashboard</span>
                </a>
                <a href="{{ route('products.index') }}" class="active-menu flex items-center gap-3 px-6 py-4 transition-all group">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    <span class="font-bold text-sm">Daftar Produk</span>
                </a>
            </nav>
            
            <div class="p-4 border-t border-gray-50">
                <div class="bg-gray-50 rounded-2xl p-4 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center font-bold text-pink-600 text-xs">NV</div>
                    <div class="overflow-hidden">
                        <p class="text-xs font-bold text-gray-800 truncate">Admin Toko</p>
                        <p class="text-[10px] text-gray-500 truncate">admin@toko.com</p>
                    </div>
                </div>
            </div>
        </aside>

        <main class="flex-1 ml-64 bg-[#fcfdfe]">
            <header class="h-20 bg-white/80 backdrop-blur-md px-10 flex items-center justify-between border-b border-gray-100 sticky top-0 z-40">
                <div>
                    <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Manajemen Produk</h2>
                    <p class="text-[10px] text-gray-400 font-medium"> Pak Cik & Aimar Stock / Produk</p>
                </div>
                
                <div class="flex items-center gap-4">
                    <a href="{{ route('products.create') }}" class="bg-pink-600 hover:bg-pink-700 text-white px-5 py-2.5 rounded-xl text-xs font-bold transition-all shadow-lg shadow-pink-100 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        TAMBAH PRODUK
                    </a>
                </div>
            </header>

            <div class="p-10 max-w-[1400px] mx-auto">
                @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="mb-6 flex items-center p-4 bg-emerald-50 border border-emerald-100 rounded-2xl">
                    <div class="flex-shrink-0 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div class="ml-3 text-xs font-bold text-emerald-700">
                        {{ session('success') }}
                    </div>
                </div>
                @endif

                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="p-8 border-b border-gray-50">
                        <h3 class="text-xl font-bold text-gray-800">Daftar Produk Toko</h3>
                        <p class="text-xs text-gray-400 font-medium mt-1">Kelola data inventori skincare dengan mudah dan cepat.</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] bg-gray-50/50">
                                    <th class="px-8 py-5">No</th>
                                    <th class="px-8 py-5">Nama Produk</th>
                                    <th class="px-8 py-5">Deskripsi</th>
                                    <th class="px-8 py-5">Stok</th>
                                    <th class="px-8 py-5">Harga</th>
                                    <th class="px-8 py-5 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse ($products as $index => $product)
                                <tr class="hover:bg-gray-50/50 transition-all">
                                    <td class="px-8 py-6 text-xs font-bold text-gray-400">{{ $index + 1 }}</td>
                                    <td class="px-8 py-6 font-bold text-gray-700 text-sm">{{ $product->nama }}</td>
                                    <td class="px-8 py-6 text-xs text-gray-500 max-w-xs truncate">{{ $product->deskripsi }}</td>
                                    <td class="px-8 py-6">
                                        <span class="font-bold text-sm text-gray-600 underline decoration-pink-200 underline-offset-4">{{ $product->stok }} pcs</span>
                                    </td>
                                    <td class="px-8 py-6 font-bold text-gray-700 text-sm">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('products.edit', $product->id) }}" class="p-2 bg-amber-50 text-amber-500 rounded-lg hover:bg-amber-500 hover:text-white transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <button @click="deleteModal = true; activeId = '{{ $product->id }}'; activeName = '{{ addslashes($product->nama) }}'" 
                                                class="p-2 bg-rose-50 text-rose-500 rounded-lg hover:bg-rose-500 hover:text-white transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="p-20 text-center text-gray-300 font-bold uppercase tracking-widest">Belum ada produk</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div x-show="deleteModal" 
         x-cloak 
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
        
        <div @click.away="deleteModal = false" 
             class="bg-white w-full max-w-md rounded-3xl p-8 shadow-2xl animate-[fadeIn_0.2s_ease-out]">
            <div class="w-16 h-16 bg-rose-50 text-rose-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 text-center">Hapus Produk?</h3>
            <p class="text-sm text-gray-500 text-center mt-2">Apakah kamu yakin ingin menghapus <span class="text-gray-800 font-bold" x-text="activeName"></span>? Tindakan ini tidak bisa dibatalkan.</p>
            
            <div class="flex gap-3 mt-8">
                <button @click="deleteModal = false" class="flex-1 px-6 py-3 rounded-xl bg-gray-50 text-gray-500 text-xs font-bold hover:bg-gray-100 transition-all">BATAL</button>
                <form :action="'/products/' + activeId" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-6 py-3 rounded-xl bg-rose-500 text-white text-xs font-bold hover:bg-rose-600 transition-all shadow-lg shadow-rose-100">HAPUS SEKARANG</button>
                </form>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
    </style>

</body>
</html>