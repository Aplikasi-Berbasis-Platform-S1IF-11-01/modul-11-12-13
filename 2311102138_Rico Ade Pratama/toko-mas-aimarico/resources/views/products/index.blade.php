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
            <a href="{{ route('products.index') }}" class="flex items-center px-6 py-3 bg-[#e43f5a] text-white font-medium border-l-4 border-white transition-all">
                <i class="fas fa-box w-5"></i> Produk
            </a>
            <a href="{{ route('products.create') }}" class="flex items-center px-6 py-3 text-gray-400 hover:text-white hover:bg-gray-800 font-medium transition-all">
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
            <div class="mb-8 border-b pb-4">
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Produk</h1>
                <p class="text-sm text-gray-500">Tugas Modul 11_12_13 Rico Ade Pratama (2311102138)</p>
            </div>

            <div class="grid grid-cols-4 gap-4 mb-8">
                <div class="bg-slate-800 text-white rounded-xl p-5 shadow-sm relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 opacity-10"><i class="fas fa-box text-6xl"></i></div>
                    <i class="fas fa-box text-orange-300 text-xl mb-2"></i>
                    <h3 class="text-3xl font-bold">{{ $totalProduk }}</h3>
                    <p class="text-xs text-slate-300">Total Produk</p>
                </div>
                <div class="bg-[#1e619d] text-white rounded-xl p-5 shadow-sm relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 opacity-10"><i class="fas fa-layer-group text-6xl"></i></div>
                    <i class="fas fa-layer-group text-blue-200 text-xl mb-2"></i>
                    <h3 class="text-3xl font-bold">{{ number_format($totalStok, 0, ',', '.') }}</h3>
                    <p class="text-xs text-blue-100">Total Stok</p>
                </div>
                <div class="bg-[#e43f5a] text-white rounded-xl p-5 shadow-sm relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 opacity-10"><i class="fas fa-exclamation-triangle text-6xl"></i></div>
                    <i class="fas fa-exclamation-triangle text-red-200 text-xl mb-2"></i>
                    <h3 class="text-3xl font-bold">{{ $stokMenipis }}</h3>
                    <p class="text-xs text-red-100">Stok Menipis</p>
                </div>
                <div class="bg-[#1e8f54] text-white rounded-xl p-5 shadow-sm relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 opacity-10"><i class="fas fa-tags text-6xl"></i></div>
                    <i class="fas fa-tags text-green-200 text-xl mb-2"></i>
                    <h3 class="text-3xl font-bold">{{ $kategori }}</h3>
                    <p class="text-xs text-green-100">Kategori</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">Daftar Produk</h2>
                        <p class="text-xs text-gray-500 mt-1">Klik header kolom untuk mengurutkan data</p>
                    </div>
                    <a href="{{ route('products.create') }}" class="bg-[#e43f5a] hover:bg-rose-600 text-white text-sm font-semibold py-2 px-4 rounded-lg transition-colors shadow-sm">
                        <i class="fas fa-plus mr-1"></i> Tambah Produk
                    </a>
                </div>

                <form action="{{ route('products.index') }}" method="GET" class="flex justify-between items-center mb-4 text-sm w-full bg-gray-50 p-3 rounded-lg border border-gray-100">
                    <div class="flex items-center gap-2">
                        <span class="text-gray-600 font-medium">Tampilkan</span>
                        <select name="per_page" class="border border-gray-300 rounded p-1.5 bg-white focus:outline-none focus:border-emerald-500" onchange="this.form.submit()">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                        <span class="text-gray-600 font-medium">data</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-gray-600 font-medium">Cari:</span>
                        <div class="relative flex items-center">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..." class="border border-gray-300 rounded-l px-3 py-1.5 w-64 focus:outline-none focus:border-emerald-500">
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1.5 rounded-r transition-colors border border-emerald-600">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b-2 border-gray-100 text-xs text-gray-500 uppercase tracking-wider bg-gray-50">
                                <th class="py-3 px-4 font-semibold w-10">#</th>
                                <th class="py-3 px-4 font-semibold">NAMA PRODUK</th>
                                <th class="py-3 px-4 font-semibold text-center">KATEGORI</th>
                                <th class="py-3 px-4 font-semibold">HARGA</th>
                                <th class="py-3 px-4 font-semibold text-center">STOK</th>
                                <th class="py-3 px-4 font-semibold text-center">STATUS</th>
                                <th class="py-3 px-4 font-semibold text-center w-28">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700 divide-y divide-gray-50">
                            @forelse($products as $index => $p)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-3 px-4 text-gray-500">{{ $products->firstItem() + $index }}</td>
                                <td class="py-3 px-4">
                                    <div class="font-semibold text-gray-800">{{ $p->name }}</div>
                                    <div class="text-[10px] text-gray-400 truncate w-48">{{ $p->description }}</div>
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <span class="bg-gray-100 text-gray-600 border border-gray-200 px-2 py-1 rounded text-xs">{{ $p->category }}</span>
                                </td>
                                <td class="py-3 px-4 font-medium text-emerald-700">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                                <td class="py-3 px-4 text-center font-bold">{{ $p->stock }} <span class="text-xs font-normal text-gray-400">unit</span></td>
                                <td class="py-3 px-4 text-center">
                                    @if($p->stock == 0)
                                        <span class="px-3 py-1 text-[11px] font-bold text-rose-600 bg-rose-50 border border-rose-200 rounded-full">Habis</span>
                                    @elseif($p->stock <= 10)
                                        <span class="px-3 py-1 text-[11px] font-bold text-amber-600 bg-amber-50 border border-amber-200 rounded-full">Menipis</span>
                                    @else
                                        <span class="px-3 py-1 text-[11px] font-bold text-emerald-600 bg-emerald-50 border border-emerald-200 rounded-full">Tersedia</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('products.edit', $p->id) }}" class="text-yellow-500 border border-yellow-300 hover:bg-yellow-50 p-1.5 rounded transition-colors" title="Edit">
                                            <i class="fas fa-edit w-4"></i>
                                        </a>
                                        <form action="{{ route('products.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus produk?');" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-rose-500 border border-rose-200 hover:bg-rose-50 p-1.5 rounded transition-colors" title="Hapus">
                                                <i class="fas fa-trash-alt w-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7" class="py-8 text-center text-gray-500">Produk tidak ditemukan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 flex justify-between items-center text-xs text-gray-500">
                    <div>Menampilkan {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} dari {{ $products->total() }} produk</div>
                    <div>{{ $products->appends(request()->query())->links('pagination::tailwind') }}</div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection