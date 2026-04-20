@extends('layouts.app')

@section('title', 'Daftar Produk')
@section('page-title', 'Daftar Produk')
@section('page-subtitle', 'Kelola semua produk inventaris toko')

@section('content')
    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white/70 backdrop-blur-xl rounded-2xl border border-gray-200/50 p-5 shadow-sm hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-400 to-blue-600 shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform duration-300">
                    <i data-lucide="package" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Product::count() }}</p>
                    <p class="text-xs font-medium text-gray-400">Total Produk</p>
                </div>
            </div>
        </div>

        <div class="bg-white/70 backdrop-blur-xl rounded-2xl border border-gray-200/50 p-5 shadow-sm hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 shadow-lg shadow-emerald-500/20 group-hover:scale-110 transition-transform duration-300">
                    <i data-lucide="trending-up" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format(\App\Models\Product::sum('stok')) }}</p>
                    <p class="text-xs font-medium text-gray-400">Total Stok</p>
                </div>
            </div>
        </div>

        <div class="bg-white/70 backdrop-blur-xl rounded-2xl border border-gray-200/50 p-5 shadow-sm hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 rounded-2xl bg-gradient-to-br from-violet-400 to-violet-600 shadow-lg shadow-violet-500/20 group-hover:scale-110 transition-transform duration-300">
                    <i data-lucide="layers" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Product::distinct('kategori')->count('kategori') }}</p>
                    <p class="text-xs font-medium text-gray-400">Kategori</p>
                </div>
            </div>
        </div>

        <div class="bg-white/70 backdrop-blur-xl rounded-2xl border border-gray-200/50 p-5 shadow-sm hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 rounded-2xl bg-gradient-to-br from-pink-400 to-rose-500 shadow-lg shadow-pink-500/20 group-hover:scale-110 transition-transform duration-300">
                    <i data-lucide="alert-triangle" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Product::where('stok', '<', 10)->count() }}</p>
                    <p class="text-xs font-medium text-gray-400">Stok Rendah</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Search & Filter Bar --}}
    <div class="bg-white/70 backdrop-blur-xl rounded-2xl border border-gray-200/50 shadow-sm p-5 mb-6">
        <form method="GET" action="{{ route('products.index') }}" class="flex flex-col sm:flex-row gap-3">
            {{-- Search Input --}}
            <div class="relative flex-1 group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                    <i data-lucide="search" class="w-5 h-5"></i>
                </div>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari produk..."
                    id="search-input"
                    class="w-full pl-12 pr-4 py-3 rounded-xl bg-gray-50/80 border border-gray-200 text-sm font-medium text-gray-900 placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 focus:bg-white transition-all duration-200"
                >
            </div>

            {{-- Filter Kategori --}}
            <select
                name="kategori"
                id="filter-kategori"
                class="px-4 py-3 rounded-xl bg-gray-50/80 border border-gray-200 text-sm font-medium text-gray-700
                       focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 transition-all duration-200
                       appearance-none cursor-pointer min-w-[160px]"
            >
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $kat)
                    <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                @endforeach
            </select>

            {{-- Action Buttons --}}
            <div class="flex gap-2">
                <button type="submit" id="btn-search"
                    class="px-5 py-3 rounded-xl bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-sm font-semibold
                           shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/30
                           active:scale-[0.97] transition-all duration-200 flex items-center gap-2">
                    <i data-lucide="search" class="w-4 h-4"></i>
                    <span class="hidden sm:inline">Cari</span>
                </button>

                @if(request('search') || request('kategori'))
                    <a href="{{ route('products.index') }}" id="btn-reset"
                       class="px-5 py-3 rounded-xl bg-gray-100 text-gray-600 text-sm font-semibold
                              hover:bg-gray-200 active:scale-[0.97] transition-all duration-200 flex items-center gap-2">
                        <i data-lucide="x" class="w-4 h-4"></i>
                        <span class="hidden sm:inline">Reset</span>
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Products Table --}}
    <div class="bg-white/70 backdrop-blur-xl rounded-2xl border border-gray-200/50 shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <div class="flex items-center gap-2">
                <i data-lucide="list" class="w-5 h-5 text-gray-400"></i>
                <h3 class="text-sm font-bold text-gray-700">Data Produk</h3>
                <span class="px-2.5 py-1 rounded-lg bg-blue-50 text-blue-600 text-xs font-bold">{{ $products->total() }} item</span>
            </div>
            <a href="{{ route('products.create') }}" id="btn-tambah-produk"
               class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-sm font-semibold
                      shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/30
                      active:scale-[0.97] transition-all duration-200 flex items-center gap-2">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Produk
            </a>
        </div>

        @if($products->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full" id="products-table">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/50">
                            <th class="px-6 py-3.5 text-left text-[11px] font-bold text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3.5 text-left text-[11px] font-bold text-gray-500 uppercase tracking-wider">Nama Produk</th>
                            <th class="px-6 py-3.5 text-left text-[11px] font-bold text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3.5 text-left text-[11px] font-bold text-gray-500 uppercase tracking-wider">Harga</th>
                            <th class="px-6 py-3.5 text-left text-[11px] font-bold text-gray-500 uppercase tracking-wider">Stok</th>
                            <th class="px-6 py-3.5 text-center text-[11px] font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100/70">
                        @foreach($products as $index => $product)
                            <tr class="hover:bg-blue-50/30 transition-colors duration-200 group" id="product-row-{{ $product->id }}">
                                <td class="px-6 py-4">
                                    <span class="text-sm font-semibold text-gray-400">{{ $products->firstItem() + $index }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center justify-center w-10 h-10 rounded-xl
                                            @if($product->kategori === 'Makanan') bg-amber-100 text-amber-600
                                            @elseif($product->kategori === 'Minuman') bg-sky-100 text-sky-600
                                            @elseif($product->kategori === 'Snack') bg-purple-100 text-purple-600
                                            @else bg-emerald-100 text-emerald-600
                                            @endif
                                            group-hover:scale-110 transition-transform duration-200">
                                            @if($product->kategori === 'Makanan')
                                                <i data-lucide="utensils" class="w-5 h-5"></i>
                                            @elseif($product->kategori === 'Minuman')
                                                <i data-lucide="cup-soda" class="w-5 h-5"></i>
                                            @elseif($product->kategori === 'Snack')
                                                <i data-lucide="cookie" class="w-5 h-5"></i>
                                            @else
                                                <i data-lucide="wrench" class="w-5 h-5"></i>
                                            @endif
                                        </div>
                                        <span class="text-sm font-semibold text-gray-900">{{ $product->nama_produk }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1.5 rounded-lg text-xs font-bold
                                        @if($product->kategori === 'Makanan') bg-amber-50 text-amber-700 border border-amber-200/50
                                        @elseif($product->kategori === 'Minuman') bg-sky-50 text-sky-700 border border-sky-200/50
                                        @elseif($product->kategori === 'Snack') bg-purple-50 text-purple-700 border border-purple-200/50
                                        @else bg-emerald-50 text-emerald-700 border border-emerald-200/50
                                        @endif">
                                        {{ $product->kategori }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-bold text-gray-900">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($product->stok < 10)
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 text-red-700 border border-red-200/50 text-xs font-bold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                                            {{ $product->stok }}
                                        </span>
                                    @elseif($product->stok < 30)
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-amber-50 text-amber-700 border border-amber-200/50 text-xs font-bold">
                                            {{ $product->stok }}
                                        </span>
                                    @else
                                        <span class="inline-flex px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-200/50 text-xs font-bold">
                                            {{ $product->stok }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('products.edit', $product) }}"
                                           class="p-2.5 rounded-xl text-blue-500 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 active:scale-90"
                                           title="Edit">
                                            <i data-lucide="pencil" class="w-4 h-4"></i>
                                        </a>
                                        <button
                                            onclick="openDeleteModal({{ $product->id }}, '{{ $product->nama_produk }}')"
                                            class="p-2.5 rounded-xl text-red-400 hover:bg-red-50 hover:text-red-600 transition-all duration-200 active:scale-90"
                                            title="Hapus">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($products->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            @endif
        @else
            <div class="flex flex-col items-center justify-center py-16 px-6">
                <div class="flex items-center justify-center w-20 h-20 rounded-3xl bg-gray-100 mb-5">
                    <i data-lucide="package-x" class="w-10 h-10 text-gray-300"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-700 mb-1">Tidak Ada Produk</h3>
                <p class="text-sm text-gray-400 mb-6">Belum ada produk yang sesuai dengan pencarian Anda.</p>
                <a href="{{ route('products.create') }}"
                   class="px-5 py-3 rounded-xl bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-sm font-semibold
                          shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-200 flex items-center gap-2">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Tambah Produk Baru
                </a>
            </div>
        @endif
    </div>

    {{-- Delete Confirmation Modal --}}
    <div id="delete-modal" class="fixed inset-0 z-50 hidden">
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeDeleteModal()"></div>

        {{-- Modal Card --}}
        <div class="relative flex items-center justify-center min-h-screen p-4">
            <div class="relative w-full max-w-sm bg-white/80 backdrop-blur-2xl rounded-3xl border border-white/50 shadow-2xl p-8 transform scale-95 opacity-0 transition-all duration-300" id="delete-modal-card">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-red-100 mb-5">
                        <i data-lucide="trash-2" class="w-8 h-8 text-red-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Produk?</h3>
                    <p class="text-sm text-gray-500 mb-1">Anda yakin ingin menghapus</p>
                    <p class="text-sm font-bold text-gray-700 mb-6" id="delete-product-name"></p>

                    <div class="flex gap-3">
                        <button onclick="closeDeleteModal()"
                            class="flex-1 py-3 px-4 rounded-2xl bg-gray-100 text-gray-700 text-sm font-semibold
                                   hover:bg-gray-200 active:scale-[0.97] transition-all duration-200">
                            Batal
                        </button>
                        <form id="delete-form" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="btn-confirm-delete"
                                class="w-full py-3 px-4 rounded-2xl bg-gradient-to-r from-red-500 to-rose-600 text-white text-sm font-semibold
                                       shadow-md shadow-red-500/20 hover:shadow-lg hover:shadow-red-500/30
                                       active:scale-[0.97] transition-all duration-200">
                                Ya, Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function openDeleteModal(id, name) {
        const modal = document.getElementById('delete-modal');
        const card = document.getElementById('delete-modal-card');
        const form = document.getElementById('delete-form');
        const productName = document.getElementById('delete-product-name');

        form.action = `/products/${id}`;
        productName.textContent = `"${name}"?`;

        modal.classList.remove('hidden');
        requestAnimationFrame(() => {
            card.classList.remove('scale-95', 'opacity-0');
            card.classList.add('scale-100', 'opacity-100');
        });
    }

    function closeDeleteModal() {
        const modal = document.getElementById('delete-modal');
        const card = document.getElementById('delete-modal-card');

        card.classList.remove('scale-100', 'opacity-100');
        card.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Close modal on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeDeleteModal();
    });
</script>
@endpush
