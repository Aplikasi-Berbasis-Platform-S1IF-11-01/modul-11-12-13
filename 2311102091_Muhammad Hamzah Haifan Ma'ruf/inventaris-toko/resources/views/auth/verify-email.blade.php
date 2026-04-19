<x-guest-layout>
    <div class="mb-6 text-center">
        <p class="jarvis-subtitle">Email Verification Module</p>
        <h1 class="mt-2 text-3xl font-extrabold text-white text-glow-cyan">
            Verifikasi Email
        </h1>
        <p class="mt-3 text-sm leading-6 text-slate-400">
            Verifikasi alamat email kamu agar akses akun aktif sepenuhnya.
        </p>
    </div>

    <div class="mb-4 text-sm leading-6 text-slate-400">
        {{ __('Terima kasih telah mendaftar. Sebelum mulai, silakan verifikasi alamat email kamu dengan mengklik link yang telah kami kirim. Jika belum menerima email, kami bisa mengirim ulang.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 jarvis-alert-success">
            {{ __('Link verifikasi baru telah dikirim ke alamat email yang kamu gunakan saat mendaftar.') }}
        </div>
    @endif

    <div class="mt-6 flex flex-col gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <x-primary-button class="w-full justify-center">
                {{ __('Kirim Ulang Email Verifikasi') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="jarvis-button-secondary flex w-full justify-center">
                {{ __('Keluar') }}
            </button>
        </form>
    </div>
</x-guest-layout>