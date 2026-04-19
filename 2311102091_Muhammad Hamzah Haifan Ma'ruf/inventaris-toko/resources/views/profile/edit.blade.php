<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="jarvis-subtitle">User Control Module</p>
                <h2 class="mt-2 jarvis-title text-glow-cyan">
                    {{ __('Profile') }}
                </h2>
                <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-400">
                    Kelola informasi akun, keamanan password, dan pengaturan akun pengguna
                    dalam satu pusat kontrol yang modern dan futuristik.
                </p>
            </div>

            <div class="jarvis-badge-neutral">
                Account Center
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- HERO PANEL -->
        <section class="jarvis-panel-strong relative overflow-hidden p-8 md:p-10">
            <div class="absolute inset-0 bg-jarvis-grid opacity-20"></div>
            <div class="absolute -top-10 right-0 h-40 w-40 rounded-full bg-cyan-400/10 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 h-32 w-32 rounded-full bg-sky-500/10 blur-3xl"></div>

            <div class="relative z-10 flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
                <div class="max-w-2xl">
                    <p class="jarvis-subtitle">Profile Management</p>
                    <h3 class="mt-2 text-3xl font-extrabold leading-tight text-white md:text-4xl">
                        Pengaturan <span class="text-cyan-300 text-glow-cyan">Akun Pengguna</span>
                    </h3>
                    <p class="mt-4 text-sm leading-7 text-slate-300 md:text-base">
                        Perbarui data profil, ubah password, dan kelola akun secara aman melalui
                        tampilan pengaturan yang lebih profesional, rapi, dan konsisten.
                    </p>
                </div>

                <div class="grid w-full max-w-md grid-cols-1 gap-4">
                    <div class="jarvis-card">
                        <p class="jarvis-stat-label">User Status</p>
                        <div class="mt-3 flex items-center gap-3">
                            <span class="h-3 w-3 rounded-full bg-cyan-400 shadow-[0_0_15px_rgba(34,211,238,1)]"></span>
                            <span class="text-lg font-semibold text-white">Authenticated</span>
                        </div>
                        <p class="mt-3 text-sm text-slate-400">
                            Akun aktif dan memiliki akses ke modul sistem inventaris.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CONTENT -->
        <section class="grid grid-cols-1 gap-6 xl:grid-cols-3">
            <!-- LEFT SIDEBAR -->
            <div class="space-y-6">
                <div class="jarvis-panel p-6">
                    <p class="jarvis-subtitle">User Info</p>
                    <h3 class="mt-2 text-xl font-bold text-white">Informasi Akun</h3>

                    <div class="jarvis-divider my-5"></div>

                    <div class="space-y-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Nama</p>
                            <p class="mt-1 text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Email</p>
                            <p class="mt-1 text-sm font-medium text-white">{{ Auth::user()->email }}</p>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Status</p>
                            <div class="mt-2">
                                <span class="jarvis-badge">Secure Access</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="jarvis-panel p-6">
                    <p class="jarvis-subtitle">System Notes</p>
                    <h3 class="mt-2 text-xl font-bold text-white">Panduan Singkat</h3>

                    <div class="jarvis-divider my-5"></div>

                    <ul class="space-y-3 text-sm leading-7 text-slate-400">
                        <li>• Pastikan nama dan email akun selalu benar.</li>
                        <li>• Gunakan password yang kuat untuk keamanan akun.</li>
                        <li>• Hapus akun hanya jika benar-benar diperlukan.</li>
                    </ul>
                </div>
            </div>

            <!-- RIGHT CONTENT -->
            <div class="space-y-6 xl:col-span-2">
                <div class="jarvis-panel overflow-hidden p-0">
                    <div class="border-b border-white/10 px-6 py-6">
                        <p class="jarvis-subtitle">Profile Update</p>
                        <h3 class="mt-2 text-xl font-bold text-white">Informasi Profil</h3>
                        <p class="mt-2 text-sm text-slate-400">
                            Perbarui nama dan email akun yang digunakan pada sistem.
                        </p>
                    </div>

                    <div class="p-6 md:p-8">
                        <div class="max-w-2xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <div class="jarvis-panel overflow-hidden p-0">
                    <div class="border-b border-white/10 px-6 py-6">
                        <p class="jarvis-subtitle">Security Module</p>
                        <h3 class="mt-2 text-xl font-bold text-white">Ubah Password</h3>
                        <p class="mt-2 text-sm text-slate-400">
                            Ganti password akun untuk meningkatkan keamanan akses pengguna.
                        </p>
                    </div>

                    <div class="p-6 md:p-8">
                        <div class="max-w-2xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <div class="jarvis-panel overflow-hidden border border-red-400/10 p-0">
                    <div class="border-b border-red-400/10 px-6 py-6">
                        <p class="jarvis-subtitle">Danger Zone</p>
                        <h3 class="mt-2 text-xl font-bold text-white">Hapus Akun</h3>
                        <p class="mt-2 text-sm text-slate-400">
                            Tindakan ini permanen. Pastikan kamu sudah yakin sebelum menghapus akun.
                        </p>
                    </div>

                    <div class="p-6 md:p-8">
                        <div class="max-w-2xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>