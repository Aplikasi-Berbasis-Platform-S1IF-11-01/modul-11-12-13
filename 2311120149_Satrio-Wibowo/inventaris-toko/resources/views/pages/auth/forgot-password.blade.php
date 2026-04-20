<x-layouts::auth :title="__('Lupa Kata Sandi')">
    <div class="flex flex-col gap-6">
        <x-auth-header 
            :title="__('Pemulihan Akses')" 
            :description="__('Masukkan email terdaftar untuk menerima tautan reset kata sandi')" 
        />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-6">
            @csrf

            <flux:input
                name="email"
                :label="__('Email Terdaftar')"
                type="email"
                required
                autofocus
                placeholder="admin@toko.com"
            />

            <flux:button variant="primary" type="submit" class="w-full" data-test="email-password-reset-link-button">
                {{ __('Kirim Tautan Pemulihan') }}
            </flux:button>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-400">
            <span>{{ __('Kembali ke') }}</span>
            <flux:link :href="route('login')" wire:navigate>{{ __('halaman masuk') }}</flux:link>
        </div>
    </div>
</x-layouts::auth>