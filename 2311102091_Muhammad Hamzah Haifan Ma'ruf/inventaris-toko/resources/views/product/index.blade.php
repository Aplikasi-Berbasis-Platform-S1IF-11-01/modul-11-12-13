<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="jarvis-subtitle">Inventory Control Center</p>
                <h2 class="mt-2 jarvis-title text-glow-cyan">
                    Inventaris Toko
                </h2>
                <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-400">
                    Kelola seluruh data produk toko dalam satu panel terpusat dengan tampilan modern, bersih, dan futuristik.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <div class="jarvis-badge-neutral">
                    Total Data: {{ $products->count() }}
                </div>

                <a href="{{ route('products.create') }}" class="jarvis-button">
                    + Tambah Produk
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        @if(session('success'))
            <div class="jarvis-alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- HERO PANEL -->
        <section class="jarvis-panel-strong relative overflow-hidden p-8 md:p-10">
            <div class="absolute inset-0 bg-jarvis-grid opacity-20"></div>
            <div class="absolute -top-10 right-0 h-40 w-40 rounded-full bg-cyan-400/10 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 h-32 w-32 rounded-full bg-sky-500/10 blur-3xl"></div>

            <div class="relative z-10 flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
                <div class="max-w-2xl">
                    <p class="jarvis-subtitle">Product Monitoring</p>
                    <h3 class="mt-2 text-3xl font-extrabold leading-tight text-white md:text-4xl">
                        Sistem Pengelolaan <span class="text-cyan-300 text-glow-cyan">Inventaris Produk</span>
                    </h3>
                    <p class="mt-4 text-sm leading-7 text-slate-300 md:text-base">
                        Pantau stok, kategori, harga, dan data produk secara efisien dalam satu tampilan profesional
                        yang memudahkan pengelolaan inventaris toko.
                    </p>

                    <div class="mt-6 flex flex-wrap items-center gap-3">
                        <a href="{{ route('products.create') }}" class="jarvis-button">
                            Tambah Data Baru
                        </a>
                    </div>
                </div>

                <div class="grid w-full max-w-xl grid-cols-1 gap-4 sm:grid-cols-3">
                    <div class="jarvis-card">
                        <p class="jarvis-stat-label">Total Produk</p>
                        <p class="mt-3 text-3xl font-bold text-white">{{ $products->count() }}</p>
                    </div>

                    <div class="jarvis-card">
                        <p class="jarvis-stat-label">Total Stok</p>
                        <p class="mt-3 text-3xl font-bold text-white">{{ $products->sum('stok') }}</p>
                    </div>

                    <div class="jarvis-card">
                        <p class="jarvis-stat-label">Kategori</p>
                        <p class="mt-3 text-3xl font-bold text-white">{{ $products->pluck('kategori')->unique()->count() }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- STATISTICS -->
        <section class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">
            <div class="jarvis-stat">
                <p class="jarvis-stat-label">Jumlah Produk</p>
                <p class="jarvis-stat-value">{{ $products->count() }}</p>
                <p class="mt-2 text-sm text-slate-400">Total seluruh produk yang tersimpan di dalam sistem.</p>
            </div>

            <div class="jarvis-stat">
                <p class="jarvis-stat-label">Total Stok</p>
                <p class="jarvis-stat-value">{{ $products->sum('stok') }}</p>
                <p class="mt-2 text-sm text-slate-400">Akumulasi stok dari semua produk inventaris toko.</p>
            </div>

            <div class="jarvis-stat">
                <p class="jarvis-stat-label">Total Kategori</p>
                <p class="jarvis-stat-value">{{ $products->pluck('kategori')->unique()->count() }}</p>
                <p class="mt-2 text-sm text-slate-400">Jumlah kategori unik yang digunakan dalam data produk.</p>
            </div>

            <div class="jarvis-stat">
                <p class="jarvis-stat-label">Stok Menipis</p>
                <p class="jarvis-stat-value">{{ $products->where('stok', '<=', 5)->count() }}</p>
                <p class="mt-2 text-sm text-slate-400">Produk yang perlu diperhatikan karena stok mulai menipis.</p>
            </div>
        </section>

        <!-- TABLE PANEL -->
        <section class="jarvis-panel overflow-hidden p-0">
            <div class="flex flex-col gap-4 border-b border-white/10 px-6 py-6 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="jarvis-subtitle">Inventory Table</p>
                    <h3 class="mt-2 text-xl font-bold text-white">Daftar Produk</h3>
                    <p class="mt-2 text-sm text-slate-400">
                        Seluruh data inventaris produk ditampilkan di bawah ini untuk memudahkan monitoring dan pengelolaan.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <span class="jarvis-badge">Live Data</span>
                    <span class="jarvis-badge-neutral">{{ now()->format('d M Y') }}</span>
                </div>
            </div>

            @if($products->count() > 0)
                <div class="overflow-x-auto">
                    <table class="jarvis-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Deskripsi</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($products as $item)
                                <tr>
                                    <td class="text-slate-400">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        <div class="font-semibold text-white">
                                            {{ $item->nama_produk }}
                                        </div>
                                    </td>

                                    <td>
                                        <span class="jarvis-badge-neutral">
                                            {{ $item->kategori }}
                                        </span>
                                    </td>

                                    <td class="font-medium text-slate-100">
                                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        @if($item->stok <= 5)
                                            <span class="jarvis-badge-danger">
                                                {{ $item->stok }} stok
                                            </span>
                                        @else
                                            <span class="jarvis-badge">
                                                {{ $item->stok }} stok
                                            </span>
                                        @endif
                                    </td>

                                    <td class="max-w-xs text-slate-400">
                                        <div class="line-clamp-2">
                                            {{ $item->deskripsi ?: '-' }}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('products.edit', $item->id) }}"
                                                class="jarvis-button-secondary px-4 py-2 text-xs">
                                                Edit
                                            </a>

                                            <form action="{{ route('products.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="jarvis-button-danger px-4 py-2 text-xs">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-8 md:p-10">
                    <div class="jarvis-empty">
                        <p class="jarvis-subtitle">No Data Detected</p>
                        <h3 class="mt-3 jarvis-empty-title">Belum ada data produk</h3>
                        <p class="jarvis-empty-text">
                            Tambahkan data produk pertama untuk mulai mengelola inventaris toko secara terstruktur.
                        </p>

                        <div class="mt-6">
                            <a href="{{ route('products.create') }}" class="jarvis-button">
                                + Tambah Produk
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </section>
    </div>
</x-app-layout>