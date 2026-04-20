<x-guest-layout>
    <div class="mb-6 text-center">
        <p class="jarvis-subtitle">Secure Confirmation</p>
        <h1 class="mt-2 text-3xl font-extrabold text-white text-glow-cyan">
            Konfirmasi Password
        </h1>
        <p class="mt-3 text-sm leading-6 text-slate-400">
            Untuk melanjutkan, masukkan password akun kamu terlebih dahulu.
        </p>
    </div>

    <div class="mb-4 text-sm leading-6 text-slate-400">
        {{ __('Ini adalah area aman dari aplikasi. Silakan konfirmasi password kamu sebelum melanjutkan.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mt-1 block w-full"
                type="password"
                name="password"
                required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <x-primary-button class="w-full justify-center">
            {{ __('Konfirmasi') }}
        </x-primary-button>
    </form>
</x-guest-layout>