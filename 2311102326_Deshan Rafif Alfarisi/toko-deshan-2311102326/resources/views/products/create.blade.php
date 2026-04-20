@extends('layouts.app')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')
@section('page-subtitle', 'Masukkan data produk baru ke inventaris')

@section('content')
    <div class="max-w-2xl">
        {{-- Back Link --}}
        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-700 mb-6 group transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
            Kembali ke Daftar Produk
        </a>

        {{-- Form Card --}}
        <div class="bg-white/70 backdrop-blur-xl rounded-2xl border border-gray-200/50 shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-blue-50/50 to-indigo-50/50">
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 shadow-lg shadow-blue-500/20">
                        <i data-lucide="plus" class="w-5 h-5 text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Produk Baru</h3>
                        <p class="text-xs text-gray-500">Isi semua field yang tersedia</p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('products.store') }}" class="p-8 space-y-6" id="create-product-form">
                @csrf

                {{-- Nama Produk --}}
                <div>
                    <label for="nama_produk" class="block text-sm font-semibold text-gray-700 mb-2">Nama Produk</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                            <i data-lucide="package" class="w-5 h-5"></i>
                        </div>
                        <input
                            type="text"
                            id="nama_produk"
                            name="nama_produk"
                            value="{{ old('nama_produk') }}"
                            placeholder="Contoh: Indomie Goreng"
                            required
                            class="w-full pl-12 pr-4 py-3.5 rounded-2xl bg-gray-50/80 border border-gray-200 text-sm font-medium text-gray-900 placeholder-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 focus:bg-white transition-all duration-200
                                   @error('nama_produk') border-red-300 ring-2 ring-red-500/20 @enderror"
                        >
                    </div>
                    @error('nama_produk')
                        <p class="mt-2 text-xs font-medium text-red-500 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-3 h-3"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div>
                    <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                            <i data-lucide="tag" class="w-5 h-5"></i>
                        </div>
                        <select
                            id="kategori"
                            name="kategori"
                            required
                            class="w-full pl-12 pr-4 py-3.5 rounded-2xl bg-gray-50/80 border border-gray-200 text-sm font-medium text-gray-900
                                   focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 focus:bg-white transition-all duration-200
                                   appearance-none cursor-pointer
                                   @error('kategori') border-red-300 ring-2 ring-red-500/20 @enderror"
                        >
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat }}" {{ old('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('kategori')
                        <p class="mt-2 text-xs font-medium text-red-500 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-3 h-3"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Harga & Stok Row --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- Harga --}}
                    <div>
                        <label for="harga" class="block text-sm font-semibold text-gray-700 mb-2">Harga (Rp)</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                <span class="text-sm font-bold">Rp</span>
                            </div>
                            <input
                                type="number"
                                id="harga"
                                name="harga"
                                value="{{ old('harga') }}"
                                placeholder="0"
                                min="0"
                                required
                                class="w-full pl-12 pr-4 py-3.5 rounded-2xl bg-gray-50/80 border border-gray-200 text-sm font-medium text-gray-900 placeholder-gray-400
                                       focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 focus:bg-white transition-all duration-200
                                       @error('harga') border-red-300 ring-2 ring-red-500/20 @enderror"
                            >
                        </div>
                        @error('harga')
                            <p class="mt-2 text-xs font-medium text-red-500 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3 h-3"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Stok --}}
                    <div>
                        <label for="stok" class="block text-sm font-semibold text-gray-700 mb-2">Stok</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                <i data-lucide="hash" class="w-5 h-5"></i>
                            </div>
                            <input
                                type="number"
                                id="stok"
                                name="stok"
                                value="{{ old('stok') }}"
                                placeholder="0"
                                min="0"
                                required
                                class="w-full pl-12 pr-4 py-3.5 rounded-2xl bg-gray-50/80 border border-gray-200 text-sm font-medium text-gray-900 placeholder-gray-400
                                       focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 focus:bg-white transition-all duration-200
                                       @error('stok') border-red-300 ring-2 ring-red-500/20 @enderror"
                            >
                        </div>
                        @error('stok')
                            <p class="mt-2 text-xs font-medium text-red-500 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3 h-3"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                    <button type="submit" id="btn-simpan-produk"
                        class="px-8 py-3.5 rounded-2xl bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-sm font-semibold
                               shadow-lg shadow-blue-500/25 hover:shadow-xl hover:shadow-blue-500/35
                               hover:from-blue-600 hover:to-indigo-700
                               active:scale-[0.97] transition-all duration-200 flex items-center gap-2">
                        <i data-lucide="save" class="w-5 h-5"></i>
                        Simpan Produk
                    </button>
                    <a href="{{ route('products.index') }}"
                       class="px-6 py-3.5 rounded-2xl bg-gray-100 text-gray-600 text-sm font-semibold
                              hover:bg-gray-200 active:scale-[0.97] transition-all duration-200">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
