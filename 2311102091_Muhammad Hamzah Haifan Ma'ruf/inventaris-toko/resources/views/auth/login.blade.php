<x-guest-layout>
    <div class="mb-6 text-center">
        <p class="jarvis-subtitle">Secure Access Portal</p>
        <h1 class="mt-2 text-3xl font-extrabold text-white text-glow-cyan">
            Login Sistem
        </h1>
        <p class="mt-3 text-sm leading-6 text-slate-400">
            Masuk ke sistem inventaris toko untuk mengakses dashboard, data produk, dan kontrol akun.
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-1 block w-full" type="email" name="email"
                :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Password')" />

                @if (Route::has('password.request'))
                    <a class="text-xs font-medium text-cyan-300 transition hover:text-cyan-200"
                        href="{{ route('password.request') }}">
                        {{ __('Lupa password?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="mt-1 block w-full"
                type="password"
                name="password"
                required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center gap-3">
            <input id="remember_me" type="checkbox"
                class="rounded border-white/10 bg-[#0b1220] text-cyan-400 shadow-sm focus:ring-cyan-400/30"
                name="remember">
            <label for="remember_me" class="text-sm text-slate-300">
                {{ __('Ingat saya') }}
            </label>
        </div>

        <div class="space-y-3">
            <x-primary-button class="w-full justify-center">
                {{ __('Login') }}
            </x-primary-button>

            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="jarvis-button-secondary flex w-full justify-center">
                    {{ __('Buat Akun Baru') }}
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>