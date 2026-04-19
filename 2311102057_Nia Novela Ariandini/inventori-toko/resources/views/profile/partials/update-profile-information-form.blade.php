<section>
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="space-y-2">
            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Nama Admin</label>
            <input type="text" name="name" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-medium transition-all focus:border-pink-600 focus:ring-0 text-gray-800" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="space-y-2">
            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Email</label>
            <input type="email" name="email" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-medium transition-all focus:border-pink-600 focus:ring-0 text-gray-800" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white px-8 py-4 rounded-2xl text-xs font-bold transition-all shadow-lg shadow-pink-100 uppercase tracking-widest">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-xs font-bold text-emerald-500 uppercase tracking-widest">Berhasil Tersimpan.</p>
            @endif
        </div>
    </form>
</section>