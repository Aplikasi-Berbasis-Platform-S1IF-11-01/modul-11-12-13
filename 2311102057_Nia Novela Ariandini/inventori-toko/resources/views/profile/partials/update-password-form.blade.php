<section>
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="space-y-2">
            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Sandi Saat Ini</label>
            <input type="password" name="current_password" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-medium transition-all focus:border-pink-600 focus:ring-0 text-gray-800" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Sandi Baru</label>
            <input type="password" name="password" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-medium transition-all focus:border-pink-600 focus:ring-0 text-gray-800" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Konfirmasi Sandi Baru</label>
            <input type="password" name="password_confirmation" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-medium transition-all focus:border-pink-600 focus:ring-0 text-gray-800" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white px-8 py-4 rounded-2xl text-xs font-bold transition-all shadow-lg shadow-pink-100 uppercase tracking-widest">
                Perbarui Kata Sandi
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-xs font-bold text-emerald-500 uppercase tracking-widest">Sandi Diperbarui.</p>
            @endif
        </div>
    </form>
</section>