<div>
    {{-- Toast --}}
    @if (session()->has('success'))
        <div x-data="{ show: true }"
             x-show="show"
             x-init="setTimeout(() => show = false, 3500)"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="fixed top-4 right-4 z-50 flex items-center gap-2 bg-green-500 text-white px-5 py-3 rounded-xl shadow-lg text-sm font-medium">
            <x-heroicon-o-check-circle class="w-4 h-4 shrink-0" />
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Dashboard</h1>
                <p class="text-sm text-zinc-500 mt-1">Selamat datang, {{ auth()->user()->name }}</p>
            </div>
            <a href="{{ route('products.create') }}"
               wire:navigate
               class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                <x-heroicon-o-plus class="w-4 h-4" />
                Tambah Produk
            </a>
        </div>

        {{-- Widget Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <x-stat-card
                label="Total Produk"
                :value="number_format($totalProducts)"
                icon="cube"
                color="indigo" />

            <x-stat-card
                label="Nilai Aset"
                :value="'Rp ' . number_format($totalAssetValue, 0, ',', '.')"
                icon="banknotes"
                color="green" />

            <x-stat-card
                label="Kategori"
                :value="$totalCategories"
                icon="tag"
                color="blue" />

            <x-stat-card
                label="Stok Kritis"
                :value="$lowStockProducts->count()"
                icon="exclamation-triangle"
                :color="$lowStockProducts->count() > 0 ? 'red' : 'green'" />
        </div>

        {{-- Tabel Stok Kritis --}}
        @if ($lowStockProducts->isNotEmpty())
            <div class="bg-white dark:bg-zinc-800 rounded-2xl border border-zinc-200 dark:border-zinc-700 overflow-hidden">

                {{-- Table Header --}}
                <div class="flex items-center gap-2 px-6 py-4 border-b border-zinc-200 dark:border-zinc-700">
                    <x-heroicon-o-exclamation-triangle class="w-4 h-4 text-red-500 shrink-0" />
                    <h2 class="font-semibold text-zinc-800 dark:text-zinc-200">Produk Stok Kritis</h2>
                    <span class="ml-auto text-xs bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-400 px-2 py-0.5 rounded-full">
                        Stok &lt; 10
                    </span>
                </div>

                {{-- Table --}}
                <table class="w-full text-sm">
                    <thead class="bg-zinc-50 dark:bg-zinc-900/50">
                        <tr>
                            <th class="text-left px-6 py-3 text-zinc-500 font-medium">Nama Produk</th>
                            <th class="text-left px-6 py-3 text-zinc-500 font-medium">Kategori</th>
                            <th class="text-right px-6 py-3 text-zinc-500 font-medium">Stok</th>
                            <th class="text-right px-6 py-3 text-zinc-500 font-medium">Harga</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-700">
                        @foreach ($lowStockProducts as $product)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/30 transition">
                                <td class="px-6 py-3 font-medium text-zinc-800 dark:text-zinc-200">
                                    {{ $product->name }}
                                </td>
                                <td class="px-6 py-3 text-zinc-500">
                                    {{ $product->category }}
                                </td>
                                <td class="px-6 py-3 text-right">
                                    <span @class([
                                        'inline-flex items-center justify-center w-8 h-8 rounded-full text-xs font-bold',
                                        'bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-400'       => $product->stock === 0,
                                        'bg-orange-100 text-orange-700 dark:bg-orange-900/50 dark:text-orange-400' => $product->stock > 0,
                                    ])>
                                        {{ $product->stock }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-right text-zinc-600 dark:text-zinc-400">
                                    {{ $product->formatted_price }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        @endif

    </div>
</div>