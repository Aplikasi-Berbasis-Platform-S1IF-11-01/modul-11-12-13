<x-layouts::auth :title="__('Masuk Sistem Inventaris')">
    <div class="flex flex-col gap-6">
        <x-auth-header 
            :title="__('Manajemen Inventaris')" 
            :description="__('Silakan masuk untuk mengelola stok dan barang')" 
        />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <flux:input
                name="email"
                :label="__('Email Pengguna')"
                :value="old('email')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="admin@toko.com"
            />

            <div class="relative">
                <flux:input
                    name="password"
                    :label="__('Kata Sandi')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Masukkan kata sandi')"
                    viewable
                />

                @if (Route::has('password.request'))
                    <flux:link class="absolute top-0 text-sm end-0" :href="route('password.request')" wire:navigate>
                        {{ __('Lupa sandi?') }}
                    </flux:link>
                @endif
            </div>

            <flux:checkbox name="remember" :label="__('Ingat perangkat ini')" :checked="old('remember')" />

            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full" data-test="login-button">
                    {{ __('Masuk ke Dashboard') }}
                </flux:button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
                <span>{{ __('Staf baru?') }}</span>
                <flux:link :href="route('register')" wire:navigate>{{ __('Daftar Akun') }}</flux:link>
            </div>
        @endif
    </div>
</x-layouts::auth>