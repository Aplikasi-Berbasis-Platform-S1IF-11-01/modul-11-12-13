<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="jarvis-title text-glow-cyan">
                {{ __('Dashboard') }}
            </h2>
            <p class="mt-2 text-sm text-slate-400">
                Pusat kendali sistem inventaris toko dengan tampilan modern, ringkas, dan futuristik.
            </p>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- HERO PANEL -->
        <section class="jarvis-panel-strong relative overflow-hidden p-8 md:p-10">
            <div class="absolute inset-0 bg-jarvis-grid opacity-20"></div>
            <div class="absolute -top-16 right-0 h-40 w-40 rounded-full bg-cyan-400/10 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 h-36 w-36 rounded-full bg-sky-500/10 blur-3xl"></div>

            <div class="relative z-10 flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
                <div class="max-w-2xl">
                    <p class="jarvis-subtitle">Inventory Monitoring System</p>
                    <h1 class="mt-3 text-3xl font-extrabold leading-tight text-white md:text-4xl">
                        Selamat datang, <span class="text-cyan-300 text-glow-cyan">{{ Auth::user()->name }}</span>
                    </h1>
                    <p class="mt-4 text-sm leading-7 text-slate-300 md:text-base">
                        Dashboard ini membantu kamu memantau data inventaris, mengelola produk, dan menjaga alur operasional toko
                        tetap efisien dalam satu sistem terpusat.
                    </p>

                    <div class="mt-6 flex flex-wrap items-center gap-3">
                        <a href="{{ route('products.index') }}" class="jarvis-button">
                            Kelola Produk
                        </a>

                        <a href="{{ route('profile.edit') }}" class="jarvis-button-secondary">
                            Edit Profil
                        </a>
                    </div>
                </div>

                <div class="grid w-full max-w-md grid-cols-1 gap-4">
                    <div class="jarvis-card">
                        <p class="jarvis-stat-label">System Status</p>
                        <div class="mt-3 flex items-center gap-3">
                            <span class="h-3 w-3 rounded-full bg-cyan-400 shadow-[0_0_15px_rgba(34,211,238,1)]"></span>
                            <span class="text-lg font-semibold text-white">Online & Stable</span>
                        </div>
                        <p class="mt-3 text-sm text-slate-400">
                            Semua modul utama sistem siap digunakan.
                        </p>
                    </div>

                    <div class="jarvis-card">
                        <p class="jarvis-stat-label">Access Level</p>
                        <p class="mt-3 text-2xl font-bold text-white tracking-wide">Authorized User</p>
                        <p class="mt-2 text-sm text-slate-400">
                            Akses dashboard terverifikasi untuk pengelolaan inventaris.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- STAT CARDS -->
        <section class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">
            <div class="jarvis-stat">
                <p class="jarvis-stat-label">Total Produk</p>
                <p class="jarvis-stat-value">--</p>
                <p class="mt-2 text-sm text-slate-400">Jumlah keseluruhan data produk dalam sistem.</p>
            </div>

            <div class="jarvis-stat">
                <p class="jarvis-stat-label">Kategori</p>
                <p class="jarvis-stat-value">--</p>
                <p class="mt-2 text-sm text-slate-400">Jumlah kategori produk yang telah terdaftar.</p>
            </div>

            <div class="jarvis-stat">
                <p class="jarvis-stat-label">Stok Aman</p>
                <p class="jarvis-stat-value">--</p>
                <p class="mt-2 text-sm text-slate-400">Produk yang masih berada pada kondisi stok aman.</p>
            </div>

            <div class="jarvis-stat">
                <p class="jarvis-stat-label">Update Terakhir</p>
                <p class="jarvis-stat-value text-xl md:text-2xl">{{ now()->format('d M Y') }}</p>
                <p class="mt-2 text-sm text-slate-400">Waktu akses dashboard saat ini.</p>
            </div>
        </section>

        <!-- MAIN CONTENT -->
        <section class="grid grid-cols-1 gap-6 xl:grid-cols-3">
            <!-- LEFT -->
            <div class="xl:col-span-2 space-y-6">
                <div class="jarvis-panel p-6 md:p-8">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="jarvis-subtitle">Overview</p>
                            <h3 class="mt-2 text-xl font-bold text-white">Ringkasan Sistem</h3>
                        </div>
                        <span class="jarvis-badge">Live Monitor</span>
                    </div>

                    <div class="jarvis-divider my-6"></div>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div class="jarvis-card">
                            <h4 class="text-lg font-semibold text-white">Manajemen Produk</h4>
                            <p class="mt-3 text-sm leading-7 text-slate-400">
                                Kelola data inventaris produk dengan lebih rapi melalui fitur tambah, edit, dan hapus data.
                            </p>
                        </div>

                        <div class="jarvis-card">
                            <h4 class="text-lg font-semibold text-white">Monitoring Sistem</h4>
                            <p class="mt-3 text-sm leading-7 text-slate-400">
                                Pantau aktivitas dashboard dan kesiapan sistem dari satu tampilan utama yang terintegrasi.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="jarvis-panel p-6 md:p-8">
                    <p class="jarvis-subtitle">Control Center</p>
                    <h3 class="mt-2 text-xl font-bold text-white">Navigasi Cepat</h3>

                    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <a href="{{ route('products.index') }}"
                            class="jarvis-card block hover:border-cyan-400/20">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h4 class="text-lg font-semibold text-white">Data Produk</h4>
                                    <p class="mt-2 text-sm text-slate-400">
                                        Lihat seluruh daftar inventaris produk.
                                    </p>
                                </div>
                                <span class="jarvis-badge">Open</span>
                            </div>
                        </a>

                        <a href="{{ route('profile.edit') }}"
                            class="jarvis-card block hover:border-cyan-400/20">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h4 class="text-lg font-semibold text-white">Profil Pengguna</h4>
                                    <p class="mt-2 text-sm text-slate-400">
                                        Ubah data akun dan pengaturan profil pengguna.
                                    </p>
                                </div>
                                <span class="jarvis-badge-neutral">User</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="space-y-6">
                <div class="jarvis-panel p-6">
                    <p class="jarvis-subtitle">User Info</p>
                    <h3 class="mt-2 text-xl font-bold text-white">Identitas Pengguna</h3>

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
                                <span class="jarvis-badge">Authenticated</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="jarvis-panel p-6">
                    <p class="jarvis-subtitle">System Notes</p>
                    <h3 class="mt-2 text-xl font-bold text-white">Catatan Dashboard</h3>

                    <div class="jarvis-divider my-5"></div>

                    <ul class="space-y-3 text-sm text-slate-400 leading-7">
                        <li>• Gunakan menu <span class="text-cyan-300">Produk</span> untuk mengelola inventaris.</li>
                        <li>• Pastikan data produk selalu diperbarui secara berkala.</li>
                        <li>• Gunakan dashboard ini sebagai pusat kontrol utama sistem toko.</li>
                    </ul>
                </div>

                <div class="jarvis-panel-strong p-6">
                    <p class="jarvis-subtitle">Realtime Access</p>
                    <h3 class="mt-2 text-xl font-bold text-white">Session Active</h3>
                    <p class="mt-3 text-sm text-slate-300">
                        Kamu sedang masuk ke sistem dan dapat mengakses modul inventaris sesuai hak akses akun.
                    </p>

                    <div class="mt-5 flex items-center gap-3">
                        <span class="h-3 w-3 rounded-full bg-cyan-400 shadow-[0_0_15px_rgba(34,211,238,1)]"></span>
                        <span class="text-sm font-semibold uppercase tracking-[0.20em] text-cyan-200">
                            Secure Connection
                        </span>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>