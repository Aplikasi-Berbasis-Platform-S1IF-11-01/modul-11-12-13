<div>
    {{-- Toast --}}
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3500)"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="fixed top-4 right-4 z-50 flex items-center gap-2 bg-green-500 text-white px-5 py-3 rounded-xl shadow-lg text-sm font-medium">
            <x-heroicon-o-check-circle class="w-4 h-4 shrink-0" />
            {{ session('success') }}
        </div>
    @endif

    {{-- Modal konfirmasi delete --}}
    <div x-data="{ open: false, productId: null, productName: '' }"
         @open-delete-modal.window="open = true; productId = $event.detail.id; productName = $event.detail.name">

        <div x-show="open" x-transition class="fixed inset-0 z-40 bg-black/50 flex items-center justify-center p-4">
            <div @click.outside="open = false"
                 class="bg-white dark:bg-zinc-800 rounded-2xl p-6 max-w-md w-full shadow-xl">
                <div class="flex items-start gap-4 mb-4">
                    <div class="w-10 h-10 rounded-full bg-red-100 dark:bg-red-900/40 flex items-center justify-center shrink-0">
                        <x-heroicon-o-trash class="w-5 h-5 text-red-600 dark:text-red-400" />
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-zinc-800 dark:text-white">Hapus Produk?</h3>
                        <p class="text-sm text-zinc-500 mt-1">
                            Produk "<span class="font-medium text-zinc-700 dark:text-zinc-300" x-text="productName"></span>"
                            akan dipindahkan ke trash. Aksi ini dapat dibatalkan.
                        </p>
                    </div>
                </div>
                <div class="flex gap-3 justify-end">
                    <button @click="open = false"
                            class="px-4 py-2 text-sm text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition">
                        Batal
                    </button>
                    <button @click="$wire.deleteProduct(productId); open = false"
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm bg-red-600 hover:bg-red-700 text-white rounded-lg transition font-medium">
                        <x-heroicon-o-trash class="w-4 h-4" />
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>

        <div class="space-y-5">
            {{-- Header --}}
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Produk</h1>
                    <p class="text-sm text-zinc-500 mt-1">Kelola seluruh inventaris toko</p>
                </div>
                <a href="{{ route('products.create') }}" wire:navigate
                   class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    <x-heroicon-o-plus class="w-4 h-4" />
                    Tambah
                </a>
            </div>

            {{-- Filter & Search --}}
            <div class="bg-white dark:bg-zinc-800 rounded-2xl border border-zinc-200 dark:border-zinc-700 p-4">
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1">
                        <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-zinc-400">
                            <x-heroicon-o-magnifying-glass class="w-4 h-4" />
                        </span>
                        <input wire:model.live.debounce.300ms="search"
                               type="text"
                               placeholder="Cari nama produk atau kategori..."
                               class="w-full pl-9 pr-4 py-2 text-sm border border-zinc-200 dark:border-zinc-600 rounded-lg bg-zinc-50 dark:bg-zinc-900 text-zinc-800 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition" />
                    </div>
                    <select wire:model.live="categoryFilter"
                            class="px-3 py-2 text-sm border border-zinc-200 dark:border-zinc-600 rounded-lg bg-zinc-50 dark:bg-zinc-900 text-zinc-700 dark:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition min-w-[160px]">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Tabel --}}
            <div class="bg-white dark:bg-zinc-800 rounded-2xl border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                <div wire:loading.class="opacity-50 pointer-events-none" wire:target="search, sortBy, categoryFilter, perPage, deleteProduct">
                    <table class="w-full text-sm">
                        <thead class="bg-zinc-50 dark:bg-zinc-900/50 border-b border-zinc-200 dark:border-zinc-700">
                            <tr>
                                <th class="text-left px-6 py-3">
                                    <button wire:click="sortBy('name')" class="inline-flex items-center gap-1 text-zinc-500 hover:text-zinc-800 dark:hover:text-zinc-200 font-medium transition">
                                        Nama
                                        @if ($sortField === 'name')
                                            <x-heroicon-o-chevron-up class="w-3 h-3 {{ $sortDirection === 'desc' ? 'rotate-180' : '' }} transition-transform" />
                                        @else
                                            <x-heroicon-o-chevron-up-down class="w-3 h-3 text-zinc-300" />
                                        @endif
                                    </button>
                                </th>
                                <th class="text-left px-6 py-3">
                                    <button wire:click="sortBy('category')" class="inline-flex items-center gap-1 text-zinc-500 hover:text-zinc-800 dark:hover:text-zinc-200 font-medium transition">
                                        Kategori
                                        @if ($sortField === 'category')
                                            <x-heroicon-o-chevron-up class="w-3 h-3 {{ $sortDirection === 'desc' ? 'rotate-180' : '' }} transition-transform" />
                                        @else
                                            <x-heroicon-o-chevron-up-down class="w-3 h-3 text-zinc-300" />
                                        @endif
                                    </button>
                                </th>
                                <th class="text-right px-6 py-3">
                                    <button wire:click="sortBy('price')" class="inline-flex items-center gap-1 text-zinc-500 hover:text-zinc-800 dark:hover:text-zinc-200 font-medium transition ml-auto">
                                        Harga
                                        @if ($sortField === 'price')
                                            <x-heroicon-o-chevron-up class="w-3 h-3 {{ $sortDirection === 'desc' ? 'rotate-180' : '' }} transition-transform" />
                                        @else
                                            <x-heroicon-o-chevron-up-down class="w-3 h-3 text-zinc-300" />
                                        @endif
                                    </button>
                                </th>
                                <th class="text-right px-6 py-3">
                                    <button wire:click="sortBy('stock')" class="inline-flex items-center gap-1 text-zinc-500 hover:text-zinc-800 dark:hover:text-zinc-200 font-medium transition ml-auto">
                                        Stok
                                        @if ($sortField === 'stock')
                                            <x-heroicon-o-chevron-up class="w-3 h-3 {{ $sortDirection === 'desc' ? 'rotate-180' : '' }} transition-transform" />
                                        @else
                                            <x-heroicon-o-chevron-up-down class="w-3 h-3 text-zinc-300" />
                                        @endif
                                    </button>
                                </th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 dark:divide-zinc-700">
                            @forelse ($products as $product)
                                <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/30 transition">
                                    <td class="px-6 py-3">
                                        <div class="font-medium text-zinc-800 dark:text-zinc-200">{{ $product->name }}</div>
                                        @if ($product->description)
                                            <div class="text-xs text-zinc-400 truncate max-w-xs">{{ Str::limit($product->description, 60) }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-3">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300">
                                            {{ $product->category }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-3 text-right text-zinc-600 dark:text-zinc-400 font-mono text-xs">
                                        {{ $product->formatted_price }}
                                    </td>
                                    <td class="px-6 py-3 text-right">
                                        <span @class([
                                            'inline-flex items-center justify-center min-w-[2rem] px-2 py-0.5 rounded-full text-xs font-semibold',
                                            'bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-400'       => $product->stock === 0,
                                            'bg-orange-100 text-orange-700 dark:bg-orange-900/50 dark:text-orange-400' => $product->stock > 0 && $product->stock < 10,
                                            'bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-400' => $product->stock >= 10,
                                        ])>
                                            {{ $product->stock }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-3">
                                        <div class="flex items-center gap-1 justify-end">
                                            <a href="{{ route('products.edit', $product) }}" wire:navigate
                                               class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs text-indigo-600 dark:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-lg font-medium transition">
                                                <x-heroicon-o-pencil-square class="w-3.5 h-3.5" />
                                                Edit
                                            </a>
                                            <button
                                                @click="$dispatch('open-delete-modal', { id: {{ $product->id }}, name: '{{ addslashes($product->name) }}' })"
                                                class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 hover:text-red-700 rounded-lg font-medium transition">
                                                <x-heroicon-o-trash class="w-3.5 h-3.5" />
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center text-zinc-400 text-sm">
                                        <x-heroicon-o-inbox class="w-10 h-10 mx-auto mb-3 text-zinc-300 dark:text-zinc-600" />
                                        Tidak ada produk ditemukan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($products->hasPages())
                    <div class="px-6 py-3 border-t border-zinc-100 dark:border-zinc-700">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>

            {{-- Per-page & info --}}
            <div class="flex items-center justify-between text-sm text-zinc-500">
                <span>Menampilkan {{ $products->firstItem() }}–{{ $products->lastItem() }} dari {{ $products->total() }} produk</span>
                <select wire:model.live="perPage" class="px-2 py-1 text-xs border border-zinc-200 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800">
                    <option value="10">10 / hal</option>
                    <option value="25">25 / hal</option>
                    <option value="50">50 / hal</option>
                </select>
            </div>
        </div>
    </div>
</div>