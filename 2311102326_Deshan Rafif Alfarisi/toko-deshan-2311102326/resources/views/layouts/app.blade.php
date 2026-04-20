<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Toko Inventaris Deshan — Sistem manajemen stok barang digital">
    <title>@yield('title', 'Dashboard') — Toko Deshan</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">

    {{-- Lucide Icons CDN --}}
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen font-sans antialiased">

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-72 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
            <div class="flex flex-col h-full bg-white/80 backdrop-blur-xl border-r border-gray-200/50 shadow-xl">
                {{-- Logo --}}
                <div class="flex items-center gap-3 px-6 py-6 border-b border-gray-100">
                    <div class="flex items-center justify-center w-11 h-11 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 shadow-lg shadow-blue-500/25">
                        <i data-lucide="store" class="w-6 h-6 text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-gray-900 leading-tight" style="font-family: 'Poppins', sans-serif;">Toko Deshan</h1>
                        <p class="text-xs text-gray-400 font-medium">2311102326</p>
                    </div>
                </div>

                {{-- Navigation --}}
                <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
                    <p class="px-3 mb-3 text-[10px] font-bold tracking-widest text-gray-400 uppercase">Menu Utama</p>

                    <a href="{{ route('products.index') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200
                              {{ request()->routeIs('products.index') ? 'bg-gradient-to-r from-blue-500/10 to-indigo-500/10 text-blue-700 shadow-sm' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                        <i data-lucide="package" class="w-5 h-5"></i>
                        <span>Daftar Produk</span>
                        @if(request()->routeIs('products.index'))
                            <span class="ml-auto w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                        @endif
                    </a>

                    <a href="{{ route('products.create') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200
                              {{ request()->routeIs('products.create') ? 'bg-gradient-to-r from-blue-500/10 to-indigo-500/10 text-blue-700 shadow-sm' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                        <i data-lucide="plus-circle" class="w-5 h-5"></i>
                        <span>Tambah Produk</span>
                    </a>
                </nav>

                {{-- User Section --}}
                <div class="px-4 py-4 border-t border-gray-100">
                    <div class="flex items-center gap-3 px-3 py-3 rounded-xl bg-gray-50/80">
                        <div class="flex items-center justify-center w-9 h-9 rounded-xl bg-gradient-to-br from-pink-400 to-rose-500 shadow-md shadow-pink-500/20">
                            <i data-lucide="user" class="w-4 h-4 text-white"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all duration-200" title="Logout">
                                <i data-lucide="log-out" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        {{-- Mobile Overlay --}}
        <div id="sidebar-overlay" class="fixed inset-0 z-30 bg-black/40 backdrop-blur-sm hidden lg:hidden" onclick="toggleSidebar()"></div>

        {{-- Main Content --}}
        <main class="flex-1 lg:ml-72 min-h-screen">
            {{-- Top Bar --}}
            <header class="sticky top-0 z-20 bg-white/70 backdrop-blur-xl border-b border-gray-200/50">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center gap-4">
                        <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-xl text-gray-500 hover:bg-gray-100 transition-colors">
                            <i data-lucide="menu" class="w-5 h-5"></i>
                        </button>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900" style="font-family: 'Poppins', sans-serif;">@yield('page-title', 'Dashboard')</h2>
                            <p class="text-sm text-gray-400">@yield('page-subtitle', 'Selamat datang di Toko Deshan')</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="hidden sm:flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200/50">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span class="text-xs font-semibold text-emerald-700">Online</span>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Flash Messages --}}
            @if(session('success'))
                <div id="flash-message" class="mx-6 mt-4 flex items-center gap-3 px-5 py-4 rounded-2xl bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200/60 shadow-sm animate-slide-in">
                    <div class="flex items-center justify-center w-8 h-8 rounded-xl bg-emerald-500 shadow-md shadow-emerald-500/20">
                        <i data-lucide="check" class="w-4 h-4 text-white"></i>
                    </div>
                    <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                    <button onclick="this.parentElement.remove()" class="ml-auto p-1 rounded-lg text-emerald-400 hover:text-emerald-600 hover:bg-emerald-100 transition-colors">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            @endif

            {{-- Page Content --}}
            <div class="p-6">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Sidebar Toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // Auto-hide flash messages
        setTimeout(() => {
            const flash = document.getElementById('flash-message');
            if (flash) {
                flash.style.opacity = '0';
                flash.style.transform = 'translateY(-10px)';
                flash.style.transition = 'all 0.4s ease';
                setTimeout(() => flash.remove(), 400);
            }
        }, 4000);
    </script>

    @stack('scripts')
</body>
</html>
