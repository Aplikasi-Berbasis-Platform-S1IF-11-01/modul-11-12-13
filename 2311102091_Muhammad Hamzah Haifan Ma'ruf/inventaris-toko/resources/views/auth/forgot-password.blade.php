<x-guest-layout>
    <div class="mb-6 text-center">
        <p class="jarvis-subtitle">Recovery Module</p>
        <h1 class="mt-2 text-3xl font-extrabold text-white text-glow-cyan">
            Lupa Password
        </h1>
        <p class="mt-3 text-sm leading-6 text-slate-400">
            Masukkan email akun kamu dan kami akan mengirimkan link untuk reset password.
        </p>
    </div>

    <div class="mb-4 text-sm leading-6 text-slate-400">
        {{ __('Lupa password? Tidak masalah. Masukkan alamat email akun kamu, lalu kami akan mengirim link reset password.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-1 block w-full" type="email" name="email"
                :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-primary-button class="w-full justify-center">
            {{ __('Kirim Link Reset Password') }}
        </x-primary-button>
    </form>
</x-guest-layout>