<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="jarvis-subtitle">Product Update Module</p>
                <h2 class="mt-2 jarvis-title text-glow-cyan">
                    Edit Produk
                </h2>
                <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-400">
                    Perbarui data produk di dalam sistem inventaris toko dengan tampilan input yang rapi,
                    modern, dan konsisten.
                </p>
            </div>

            <a href="{{ route('products.index') }}" class="jarvis-button-secondary">
                Kembali ke Daftar Produk
            </a>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- HERO PANEL -->
        <section class="jarvis-panel-strong relative overflow-hidden p-8 md:p-10">
            <div class="absolute inset-0 bg-jarvis-grid opacity-20"></div>
            <div class="absolute -top-10 right-0 h-40 w-40 rounded-full bg-cyan-400/10 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 h-32 w-32 rounded-full bg-sky-500/10 blur-3xl"></div>

            <div class="relative z-10 flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
                <div class="max-w-2xl">
                    <p class="jarvis-subtitle">Inventory Update</p>
                    <h3 class="mt-2 text-3xl font-extrabold leading-tight text-white md:text-4xl">
                        Perbarui Data <span class="text-cyan-300 text-glow-cyan">Produk</span>
                    </h3>
                    <p class="mt-4 text-sm leading-7 text-slate-300 md:text-base">
                        Edit informasi produk agar data inventaris tetap akurat, terorganisir, dan selalu siap
                        digunakan untuk proses operasional toko.
                    </p>
                </div>

                <div class="grid w-full max-w-md grid-cols-1 gap-4">
                    <div class="jarvis-card">
                        <p class="jarvis-stat-label">Editing Status</p>
                        <div class="mt-3 flex items-center gap-3">
                            <span class="h-3 w-3 rounded-full bg-cyan-400 shadow-[0_0_15px_rgba(34,211,238,1)]"></span>
                            <span class="text-lg font-semibold text-white">Data Ready to Update</span>
                        </div>
                        <p class="mt-3 text-sm text-slate-400">
                            Form edit aktif dan siap digunakan untuk memperbarui data produk.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ERROR MESSAGE -->
        @if ($errors->any())
            <div class="jarvis-alert-danger">
                <div class="mb-2 font-semibold">Terjadi kesalahan pada input data:</div>
                <ul class="list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM PANEL -->
        <section class="jarvis-panel overflow-hidden p-0">
            <div class="border-b border-white/10 px-6 py-6">
                <p class="jarvis-subtitle">Update Form</p>
                <h3 class="mt-2 text-xl font-bold text-white">Form Edit Produk</h3>
                <p class="mt-2 text-sm text-slate-400">
                    Perbarui field yang diperlukan di bawah ini untuk menyimpan perubahan data produk.
                </p>
            </div>

            <div class="p-6 md:p-8">
                <form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <label for="nama_produk" class="jarvis-label">Nama Produk</label>
                            <input
                                type="text"
                                id="nama_produk"
                                name="nama_produk"
                                value="{{ old('nama_produk', $product->nama_produk) }}"
                                class="jarvis-input"
                                placeholder="Masukkan nama produk">
                        </div>

                        <div>
                            <label for="kategori" class="jarvis-label">Kategori</label>
                            <input
                                type="text"
                                id="kategori"
                                name="kategori"
                                value="{{ old('kategori', $product->kategori) }}"
                                class="jarvis-input"
                                placeholder="Masukkan kategori produk">
                        </div>

                        <div>
                            <label for="harga" class="jarvis-label">Harga</label>
                            <input
                                type="number"
                                id="harga"
                                name="harga"
                                value="{{ old('harga', $product->harga) }}"
                                class="jarvis-input"
                                placeholder="Masukkan harga produk">
                        </div>

                        <div>
                            <label for="stok" class="jarvis-label">Stok</label>
                            <input
                                type="number"
                                id="stok"
                                name="stok"
                                value="{{ old('stok', $product->stok) }}"
                                class="jarvis-input"
                                placeholder="Masukkan jumlah stok">
                        </div>

                        <div class="md:col-span-2">
                            <label for="deskripsi" class="jarvis-label">Deskripsi</label>
                            <textarea
                                id="deskripsi"
                                name="deskripsi"
                                rows="5"
                                class="jarvis-textarea"
                                placeholder="Masukkan deskripsi produk">{{ old('deskripsi', $product->deskripsi) }}</textarea>
                        </div>
                    </div>

                    <div class="jarvis-divider my-2"></div>

                    <div class="flex flex-wrap items-center gap-3 pt-2">
                        <button type="submit" class="jarvis-button">
                            Update Produk
                        </button>

                        <a href="{{ route('products.index') }}" class="jarvis-button-secondary">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </section>
    </div>
</x-app-layout>