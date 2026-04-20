<div>
    <div class="max-w-2xl mx-auto space-y-6">
        {{-- Header --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('products.index') }}" wire:navigate
               class="text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300 transition">
                <x-heroicon-o-arrow-left class="w-5 h-5" />
            </a>
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">
                    {{ $isEditing ? 'Edit Produk' : 'Tambah Produk' }}
                </h1>
                <p class="text-sm text-zinc-500 mt-0.5">
                    {{ $isEditing ? 'Perbarui informasi produk' : 'Isi form untuk menambahkan produk baru' }}
                </p>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="bg-white dark:bg-zinc-800 rounded-2xl border border-zinc-200 dark:border-zinc-700 p-6">
            <form wire:submit="save" class="space-y-5">

                {{-- Nama Produk --}}
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Nama Produk <span class="text-red-500">*</span>
                    </label>
                    <input wire:model.blur="name"
                           type="text"
                           placeholder="Contoh: Beras Premium 5kg"
                           class="w-full px-4 py-2.5 text-sm border rounded-lg bg-zinc-50 dark:bg-zinc-900 text-zinc-800 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition
                           {{ $errors->has('name') ? 'border-red-400 focus:ring-red-400' : 'border-zinc-200 dark:border-zinc-600' }}" />
                    @error('name')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <input wire:model.blur="category"
                           type="text"
                           placeholder="Contoh: Makanan & Minuman"
                           list="category-suggestions"
                           class="w-full px-4 py-2.5 text-sm border rounded-lg bg-zinc-50 dark:bg-zinc-900 text-zinc-800 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition
                           {{ $errors->has('category') ? 'border-red-400 focus:ring-red-400' : 'border-zinc-200 dark:border-zinc-600' }}" />
                    <datalist id="category-suggestions">
                        @foreach (\App\Models\Product::distinct()->pluck('category') as $cat)
                            <option value="{{ $cat }}">
                        @endforeach
                    </datalist>
                    @error('category')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Harga & Stok --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">
                            Harga (Rp) <span class="text-red-500">*</span>
                        </label>
                        <input wire:model.blur="price"
                               type="number"
                               min="0"
                               step="0.01"
                               placeholder="0"
                               class="w-full px-4 py-2.5 text-sm border rounded-lg bg-zinc-50 dark:bg-zinc-900 text-zinc-800 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition
                               {{ $errors->has('price') ? 'border-red-400 focus:ring-red-400' : 'border-zinc-200 dark:border-zinc-600' }}" />
                        @error('price')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">
                            Stok <span class="text-red-500">*</span>
                        </label>
                        <input wire:model.blur="stock"
                               type="number"
                               min="0"
                               placeholder="0"
                               class="w-full px-4 py-2.5 text-sm border rounded-lg bg-zinc-50 dark:bg-zinc-900 text-zinc-800 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition
                               {{ $errors->has('stock') ? 'border-red-400 focus:ring-red-400' : 'border-zinc-200 dark:border-zinc-600' }}" />
                        @error('stock')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Deskripsi
                    </label>
                    <textarea wire:model.blur="description"
                              rows="3"
                              placeholder="Deskripsi singkat produk (opsional)..."
                              class="w-full px-4 py-2.5 text-sm border border-zinc-200 dark:border-zinc-600 rounded-lg bg-zinc-50 dark:bg-zinc-900 text-zinc-800 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition resize-none"></textarea>
                    @error('description')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                            wire:loading.attr="disabled"
                            wire:target="save"
                            class="flex-1 sm:flex-none px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 disabled:opacity-60 text-white text-sm font-medium rounded-lg transition">
                        <span wire:loading.remove wire:target="save">
                            {{ $isEditing ? 'Simpan Perubahan' : 'Tambah Produk' }}
                        </span>
                        <span wire:loading wire:target="save" class="inline-flex items-center gap-2">
                            <x-heroicon-o-arrow-path class="w-4 h-4 animate-spin" />
                            Menyimpan...
                        </span>
                    </button>

                    <a href="{{ route('products.index') }}" wire:navigate
                       class="px-6 py-2.5 text-sm text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition font-medium">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>