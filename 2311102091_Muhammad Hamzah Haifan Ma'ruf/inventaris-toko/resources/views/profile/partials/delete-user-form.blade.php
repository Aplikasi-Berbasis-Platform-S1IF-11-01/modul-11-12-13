<section class="space-y-6">
    <header>
        <p class="jarvis-subtitle">Danger Zone</p>
        <h2 class="mt-2 text-lg font-bold text-white">
            {{ __('Hapus Akun') }}
        </h2>

        <p class="mt-2 text-sm leading-6 text-slate-400">
            {{ __('Setelah akun dihapus, semua data dan resource yang terkait dengan akun ini akan dihapus permanen. Sebelum menghapus akun, pastikan kamu sudah menyimpan data penting.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="jarvis-button-danger">
        {{ __('Hapus Akun') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 md:p-8">
            @csrf
            @method('delete')

            <p class="jarvis-subtitle">Permanent Action</p>
            <h2 class="mt-2 text-xl font-bold text-white">
                {{ __('Apakah kamu yakin ingin menghapus akun ini?') }}
            </h2>

            <p class="mt-4 text-sm leading-6 text-slate-400">
                {{ __('Setelah akun dihapus, semua data akan hilang secara permanen. Masukkan password untuk mengonfirmasi penghapusan akun.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full"
                    placeholder="{{ __('Masukkan password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex flex-wrap justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="jarvis-button-secondary">
                    {{ __('Batal') }}
                </button>

                <x-danger-button>
                    {{ __('Hapus Akun') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>