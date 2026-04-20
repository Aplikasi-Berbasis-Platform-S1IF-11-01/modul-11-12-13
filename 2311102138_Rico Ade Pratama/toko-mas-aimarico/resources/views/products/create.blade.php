@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-50 overflow-hidden">
    
    <aside class="w-64 sidebar-bg text-white flex flex-col shadow-xl z-20">
        <div class="p-6 border-b border-gray-700">
            <h2 class="text-xl font-bold tracking-wide flex items-start gap-2">
                <i class="fas fa-futbol text-emerald-500 mt-1"></i> 
                <span>Toko<br>Inventaris</span>
            </h2>
            <p class="text-[10px] text-gray-400 mt-2 uppercase tracking-wider font-semibold">Rico Ade Pratama - 2311102138</p>
        </div>
        
        <div class="flex-1 py-4">
            <div class="px-4 text-xs font-semibold text-gray-500 mb-2">MENU</div>
            <a href="{{ route('products.index') }}" class="flex items-center px-6 py-3 text-gray-400 hover:text-white hover:bg-gray-800 font-medium transition-all">
                <i class="fas fa-box w-5"></i> Produk
            </a>
            <a href="{{ route('products.create') }}" class="flex items-center px-6 py-3 bg-[#e43f5a] text-white font-medium border-l-4 border-white transition-all">
                <i class="fas fa-plus-circle w-5"></i> Tambah Produk
            </a>
        </div>

        <div class="p-4 bg-gray-900 border-t border-gray-800 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-red-500 flex items-center justify-center font-bold text-sm">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-bold truncate w-24">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-gray-400">Administrator</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-gray-400 hover:text-white transition-colors" title="Logout"><i class="fas fa-sign-out-alt"></i></button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <div class="p-8">
            <div class="mb-8 border-b pb-4 flex justify-between items-end">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Tambah Produk Baru</h1>
                    <p class="text-sm text-gray-500 mt-1">Manajemen Produk <i class="fas fa-chevron-right text-[10px] mx-1"></i> Tambah Data</p>
                </div>
                <a href="{{ route('products.index') }}" class="text-sm font-medium text-gray-500 hover:text-[#e43f5a] transition-colors flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 max-w-4xl">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-50">
                    <div class="w-10 h-10 bg-[#e43f5a] rounded-lg flex items-center justify-center text-white shadow-sm">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">Formulir Tambah Produk</h2>
                        <p class="text-xs text-gray-500">Masukkan detail data inventaris peralatan sepak bola dengan benar.</p>
                    </div>
                </div>

                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 gap-6 mb-5">
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Produk <span class="text-red-500">*</span></label>
                            <input type="text" name="name" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-[#e43f5a] focus:ring-1 focus:ring-[#e43f5a] transition-colors" placeholder="Contoh: Sepatu Bola Specs Lightspeed" required>
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                            <input type="text" name="category" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-[#e43f5a] focus:ring-1 focus:ring-[#e43f5a] transition-colors" placeholder="Contoh: Sepatu, Jersey, Bola" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mb-5">
                        <div class="col-span-2 md:col-span-1 relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Harga <span class="text-red-500">*</span></label>
                            <div class="absolute inset-y-0 left-0 top-7 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 font-medium text-sm">Rp</span>
                            </div>
                            <input type="number" name="price" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2.5 focus:outline-none focus:border-[#e43f5a] focus:ring-1 focus:ring-[#e43f5a] transition-colors" placeholder="0" required>
                        </div>
                        <div class="col-span-2 md:col-span-1 relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Stok Awal <span class="text-red-500">*</span></label>
                            <div class="absolute inset-y-0 right-0 top-7 pr-4 flex items-center pointer-events-none">
                                <span class="text-gray-500 font-medium text-sm">Unit</span>
                            </div>
                            <input type="number" name="stock" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-[#e43f5a] focus:ring-1 focus:ring-[#e43f5a] transition-colors" placeholder="0" required>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Produk (Opsional)</label>
                        <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-[#e43f5a] focus:ring-1 focus:ring-[#e43f5a] transition-colors resize-none" placeholder="Tuliskan spesifikasi produk di sini..."></textarea>
                    </div>

                    <div class="flex justify-end gap-3 pt-5 border-t border-gray-100">
                        <a href="{{ route('products.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-5 py-2.5 rounded-lg transition-colors">Batal</a>
                        <button type="submit" class="bg-[#e43f5a] hover:bg-rose-600 text-white font-semibold px-6 py-2.5 rounded-lg transition-colors shadow-md flex items-center gap-2">
                            <i class="fas fa-save"></i> Simpan Data
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="mt-8 text-xs text-gray-400">
                &copy; {{ date('Y') }} Toko Mas Aimarico. All rights reserved.
            </div>
        </div>
    </main>
</div>
@endsection