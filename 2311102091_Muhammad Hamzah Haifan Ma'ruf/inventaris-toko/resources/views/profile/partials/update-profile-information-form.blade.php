<section>
    <header>
        <p class="jarvis-subtitle">Profile Information</p>
        <h2 class="mt-2 text-lg font-bold text-white">
            {{ __('Perbarui Informasi Profil') }}
        </h2>

        <p class="mt-2 text-sm leading-6 text-slate-400">
            {{ __("Ubah nama dan alamat email akun yang digunakan untuk mengakses sistem inventaris.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 rounded-2xl border border-amber-400/20 bg-amber-400/10 px-4 py-4 text-sm text-amber-200">
                    <p>
                        {{ __('Alamat email kamu belum diverifikasi.') }}

                        <button form="send-verification"
                            class="ml-1 font-semibold text-amber-300 underline underline-offset-4 transition hover:text-amber-200">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-3 font-medium text-emerald-300">
                            {{ __('Link verifikasi baru sudah dikirim ke email kamu.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <x-primary-button>
                {{ __('Simpan') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-medium text-cyan-300">
                    {{ __('Tersimpan.') }}
                </p>
            @endif
        </div>
    </form>
</section>