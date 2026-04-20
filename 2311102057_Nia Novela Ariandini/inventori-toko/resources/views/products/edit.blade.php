<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk | Novela Stock</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .active-menu { background-color: #fdf2f7; color: #db2777; border-right: 4px solid #db2777; }
        input:focus, textarea:focus { border-color: #db2777 !important; outline: none; box-shadow: 0 0 0 4px #fdf2f7; }
    </style>
</head>
<body class="antialiased">

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
        </aside>

        <main class="flex-1 ml-64 bg-[#fcfdfe]">
            <header class="h-20 bg-white/80 backdrop-blur-md px-10 flex items-center justify-between border-b border-gray-100 sticky top-0 z-40">
                <div>
                    <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Perbarui Produk</h2>
                    <p class="text-[10px] text-gray-400 font-medium">Pak Cik & Aimar Stock / Produk / Edit / {{ $product->nama }}</p>
                </div>
                
                <a href="{{ route('products.index') }}" class="text-xs font-bold text-gray-500 hover:text-pink-600 flex items-center gap-2 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    KEMBALI KE DAFTAR
                </a>
            </header>

            <div class="p-10 max-w-[900px]">
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="p-8 border-b border-gray-50 bg-gray-50/30 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Edit Data Inventori</h3>
                            <p class="text-xs text-gray-400 font-medium mt-1">Ubah informasi produk skincare yang sudah terdaftar.</p>
                        </div>
                        <span class="px-4 py-2 bg-pink-50 text-pink-600 text-[10px] font-bold rounded-full uppercase tracking-widest border border-pink-100">Mode Edit</span>
                    </div>

                    <form action="{{ route('products.update', $product->id) }}" method="POST" class="p-8 space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2 md:col-span-2">
                                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Nama Produk</label>
                                <input type="text" name="nama" value="{{ old('nama', $product->nama) }}" 
                                    class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-medium transition-all" required>
                            </div>

                            <div class="space-y-2 md:col-span-2">
                                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Deskripsi</label>
                                <textarea name="deskripsi" rows="4" 
                                    class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-medium transition-all">{{ old('deskripsi', $product->deskripsi) }}</textarea>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Stok Tersedia</label>
                                <div class="relative">
                                    <input type="number" name="stok" value="{{ old('stok', $product->stok) }}" 
                                        class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-medium transition-all" required>
                                    <span class="absolute right-5 top-1/2 -translate-y-1/2 text-[10px] font-bold text-gray-400 uppercase">PCS</span>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Harga Satuan</label>
                                <div class="relative">
                                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-xs font-bold text-gray-400">Rp</span>
                                    <input type="number" name="harga" value="{{ old('harga', $product->harga) }}" 
                                        class="w-full pl-12 pr-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-medium transition-all" required>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 flex gap-3">
                            <button type="submit" class="flex-1 bg-pink-600 hover:bg-pink-700 text-white px-8 py-4 rounded-2xl text-xs font-bold transition-all shadow-lg shadow-pink-100 uppercase tracking-widest flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('products.index') }}" class="px-8 py-4 bg-gray-100 hover:bg-gray-200 text-gray-500 rounded-2xl text-xs font-bold transition-all uppercase tracking-widest">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

</body>
</html>