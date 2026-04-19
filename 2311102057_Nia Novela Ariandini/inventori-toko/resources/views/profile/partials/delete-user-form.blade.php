<section class="space-y-6">
    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="bg-rose-500 hover:bg-rose-600 text-white px-8 py-4 rounded-2xl text-xs font-bold transition-all shadow-lg shadow-rose-100 uppercase tracking-widest">
        Hapus Akun Permanen
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-10 bg-white rounded-[32px]">
            @csrf
            @method('delete')

            <h2 class="text-xl font-bold text-gray-800">
                Apakah Anda yakin ingin menghapus akun?
            </h2>

            <p class="mt-2 text-sm text-gray-400 font-medium">
                Semua data akan dihapus secara permanen. Silakan masukkan kata sandi Anda untuk mengonfirmasi.
            </p>

            <div class="mt-6 space-y-2">
                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Kata Sandi</label>
                <input type="password" name="password" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-medium transition-all focus:border-pink-600 focus:ring-0 text-gray-800" placeholder="••••••••" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-8 flex gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="flex-1 px-8 py-4 bg-gray-100 hover:bg-gray-200 text-gray-500 rounded-2xl text-xs font-bold transition-all uppercase tracking-widest">
                    Batal
                </button>
                <button type="submit" class="flex-1 bg-rose-600 hover:bg-rose-700 text-white px-8 py-4 rounded-2xl text-xs font-bold transition-all shadow-lg shadow-rose-100 uppercase tracking-widest">
                    Ya, Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>