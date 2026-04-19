@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 pb-12">
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-emerald-600 rounded-lg flex items-center justify-center text-white shadow-sm">
                        <i class="fas fa-futbol text-xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Toko Mas <span class="text-emerald-600">Aimarico</span></h1>
                </div>

                <div class="flex items-center gap-6">
                    <div class="hidden md:block text-right">
                        <p class="text-xs text-gray-500 uppercase font-bold tracking-widest">Selamat Datang</p>
                        <p class="text-sm font-bold text-gray-800">Halo, Mas Jakobi!</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-rose-500 hover:bg-rose-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all shadow-md flex items-center gap-2">
                            <i class="fas fa-sign-out-alt"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="bg-emerald-700 py-12 mb-10 shadow-inner">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-2">Cari Perlengkapan Sepak Bola Terbaik</h2>
        
        <p class="text-emerald-100 text-lg font-medium mb-8 italic opacity-90">
            Tugas Modul 11_12_13 Rico Ade Pratama (2311102138)
        </p>
        
        <form action="{{ route('shop.index') }}" method="GET" class="max-w-2xl mx-auto flex flex-col md:flex-row gap-3">
            <div class="relative flex-1">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Jersey, Sepatu, atau Bola..." 
                    class="w-full pl-12 pr-4 py-4 rounded-2xl border-none focus:ring-4 focus:ring-emerald-500/50 shadow-lg text-gray-700">
            </div>
            <button type="submit" class="bg-gray-900 hover:bg-black text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-lg">
                Cari Sekarang
            </button>
        </form>
    </div>
</div>

    <div class="max-w-7xl mx-auto px-4">
        @if(session('success'))
            <div class="mb-8 p-4 bg-emerald-100 border-l-8 border-emerald-500 text-emerald-800 rounded-xl shadow-md flex items-center gap-4 animate-bounce">
                <i class="fas fa-check-circle text-2xl"></i>
                <p class="font-bold">{{ session('success') }}</p>
            </div>
        @endif

        <div class="flex justify-between items-end mb-8 border-b border-gray-200 pb-4">
            <h3 class="text-2xl font-bold text-gray-800">Katalog Produk Terbaru</h3>
            <p class="text-sm font-medium text-emerald-600 bg-emerald-50 px-3 py-1 rounded-lg">Total: {{ $products->total() }} Produk</p>
        </div>

        @if($products->isEmpty())
            <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-dashed border-gray-300">
                <p class="text-gray-500">Produk tidak ditemukan.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($products as $p)
                <div class="group bg-white rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 flex flex-col h-full">
                    <div class="h-52 bg-gradient-to-br from-gray-50 to-gray-100 relative flex items-center justify-center">
                        @php
                            $icon = match($p->category) {
                                'Jersey & Apparel' => 'fa-tshirt',
                                'Sepatu Bola & Futsal' => 'fa-running',
                                'Peralatan Latihan' => 'fa-dumbbell',
                                'Aksesoris Suporter' => 'fa-flag',
                                default => 'fa-box'
                            };
                        @endphp
                        <i class="fas {{ $icon }} text-8xl text-gray-200 group-hover:text-emerald-100 transition-colors"></i>
                        <span class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-lg text-[10px] font-bold text-emerald-600 border border-emerald-100">{{ $p->category }}</span>
                    </div>

                    <div class="p-6 flex flex-col flex-1">
                        <h4 class="font-bold text-gray-800 text-lg mb-1 line-clamp-1">{{ $p->name }}</h4>
                        <p class="text-gray-500 text-xs mb-4 line-clamp-2 h-8 leading-relaxed">{{ $p->description }}</p>
                        
                        <div class="mt-auto">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-2xl font-black text-rose-500">Rp{{ number_format($p->price, 0, ',', '.') }}</span>
                                <span class="text-[10px] font-bold bg-gray-100 text-gray-500 px-2 py-1 rounded">Sisa: {{ $p->stock }}</span>
                            </div>
                            
                            <form action="{{ route('shop.buy', $p->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 rounded-2xl flex items-center justify-center gap-2 transition-all shadow-lg">
                                    <i class="fas fa-shopping-cart"></i> Beli Instan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
        <div class="mt-12">{{ $products->appends(request()->query())->links() }}</div>
    </div>
</div>
@endsection