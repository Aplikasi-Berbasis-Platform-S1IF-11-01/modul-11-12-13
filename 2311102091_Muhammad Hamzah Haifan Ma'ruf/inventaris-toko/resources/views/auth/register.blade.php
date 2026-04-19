<x-guest-layout>
    <div class="mb-6 text-center">
        <p class="jarvis-subtitle">User Registration Module</p>
        <h1 class="mt-2 text-3xl font-extrabold text-white text-glow-cyan">
            Registrasi Akun
        </h1>
        <p class="mt-3 text-sm leading-6 text-slate-400">
            Buat akun baru untuk mengakses sistem inventaris toko dan seluruh modul pengelolaan data.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" class="mt-1 block w-full" type="text" name="name"
                :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-1 block w-full" type="email" name="email"
                :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mt-1 block w-full"
                type="password"
                name="password"
                required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
            <x-text-input id="password_confirmation" class="mt-1 block w-full"
                type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="space-y-3">
            <x-primary-button class="w-full justify-center">
                {{ __('Daftar') }}
            </x-primary-button>

            <a href="{{ route('login') }}"
                class="jarvis-button-secondary flex w-full justify-center">
                {{ __('Sudah punya akun? Login') }}
            </a>
        </div>
    </form>
</x-guest-layout>