<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya | Pak Cik & Aimar Stock</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .active-menu { background-color: #fdf2f7; color: #db2777; border-right: 4px solid #db2777; }
        /* Memastikan input tidak kebesaran */
        input { height: 42px !important; }
    </style>
</head>
<body class="antialiased">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-white border-r border-gray-100 fixed h-full flex flex-col z-50">
            <div class="p-6">
                 <h1 class="text-2xl font-extrabold text-pink-600 tracking-tight"> Pak Cik <span class="text-gray-800"> & Aimar</span></h1>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Skincare Inventory System</p>
            </div>
            <nav class="mt-4 flex-1">
                <p class="px-6 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-4">Navigasi</p>
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-6 py-4 text-gray-500 hover:bg-pink-50 hover:text-pink-600 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span class="font-semibold text-sm">Dashboard</span>
                </a>
                <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-6 py-4 text-gray-500 hover:bg-pink-50 hover:text-pink-600 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    <span class="font-semibold text-sm">Daftar Produk</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1 ml-64 bg-[#fcfdfe] p-8">
            <div class="max-w-2xl"> <header class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 tracking-tight">Pengaturan Profil</h2>
                    <p class="text-xs text-gray-400 font-medium">Kelola informasi akun Anda di sini.</p>
                </header>

                <div class="space-y-6">
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-pink-50 text-pink-600 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <h3 class="text-md font-bold text-gray-800">Informasi Profil</h3>
                        </div>
                        <div class="scale-95 origin-top-left"> @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-amber-50 text-amber-500 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                            </div>
                            <h3 class="text-md font-bold text-gray-800">Update Kata Sandi</h3>
                        </div>
                        <div class="scale-95 origin-top-left">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="bg-rose-50/30 rounded-2xl border border-rose-100 p-6">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 bg-rose-100 text-rose-500 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </div>
                            <h3 class="text-md font-bold text-rose-600">Hapus Akun</h3>
                        </div>
                        <p class="text-[11px] text-rose-400 font-medium mb-4">Data yang dihapus tidak dapat dipulihkan.</p>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>