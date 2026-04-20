<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login ke Toko Inventaris Deshan">
    <title>Login — Toko Deshan</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen font-sans antialiased relative overflow-hidden">

    {{-- Animated Background --}}
    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-indigo-50 to-pink-50">
        <div class="absolute top-[-20%] left-[-10%] w-[600px] h-[600px] rounded-full bg-gradient-to-br from-blue-200/40 to-indigo-300/30 blur-3xl animate-float-slow"></div>
        <div class="absolute bottom-[-20%] right-[-10%] w-[500px] h-[500px] rounded-full bg-gradient-to-br from-pink-200/40 to-rose-300/30 blur-3xl animate-float-slower"></div>
        <div class="absolute top-[40%] left-[60%] w-[300px] h-[300px] rounded-full bg-gradient-to-br from-violet-200/30 to-purple-300/20 blur-3xl animate-float-medium"></div>
    </div>

    {{-- Login Card --}}
    <div class="relative z-10 flex items-center justify-center min-h-screen px-4 py-12">
        <div class="w-full max-w-md">
            {{-- Logo Section --}}
            <div class="text-center mb-8 animate-fade-in">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-gradient-to-br from-blue-500 to-indigo-600 shadow-2xl shadow-blue-500/30 mb-5">
                    <i data-lucide="store" class="w-10 h-10 text-white"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900" style="font-family: 'Poppins', sans-serif;">Toko Deshan</h1>
                <p class="text-gray-500 mt-1 text-sm font-medium">Inventaris — 2311102326</p>
            </div>

            {{-- Glass Card --}}
            <div class="bg-white/60 backdrop-blur-2xl rounded-3xl border border-white/50 shadow-2xl shadow-gray-200/40 p-8 animate-slide-up">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Selamat Datang! 👋</h2>
                    <p class="text-sm text-gray-500 mt-1">Masuk untuk mengelola inventaris toko.</p>
                </div>

                @if($errors->any())
                    <div class="mb-5 flex items-center gap-3 px-4 py-3 rounded-2xl bg-red-50/80 border border-red-200/60">
                        <div class="flex items-center justify-center w-8 h-8 rounded-xl bg-red-500 shadow-md">
                            <i data-lucide="alert-circle" class="w-4 h-4 text-white"></i>
                        </div>
                        <p class="text-sm font-medium text-red-700">{{ $errors->first() }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5" id="login-form">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                <i data-lucide="mail" class="w-5 h-5"></i>
                            </div>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="admin@toko.com"
                                required
                                autofocus
                                class="w-full pl-12 pr-4 py-3.5 rounded-2xl bg-white/70 border border-gray-200 text-gray-900 placeholder-gray-400 text-sm font-medium
                                       focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition-all duration-200
                                       hover:border-gray-300"
                            >
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                <i data-lucide="lock" class="w-5 h-5"></i>
                            </div>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                required
                                class="w-full pl-12 pr-4 py-3.5 rounded-2xl bg-white/70 border border-gray-200 text-gray-900 placeholder-gray-400 text-sm font-medium
                                       focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition-all duration-200
                                       hover:border-gray-300"
                            >
                        </div>
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500/30">
                            <span class="text-sm text-gray-600 font-medium">Ingat saya</span>
                        </label>
                    </div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        id="login-button"
                        class="w-full py-3.5 px-6 rounded-2xl bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold text-sm
                               shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40
                               hover:from-blue-600 hover:to-indigo-700
                               active:scale-[0.98] transition-all duration-200
                               flex items-center justify-center gap-2"
                    >
                        <i data-lucide="log-in" class="w-5 h-5"></i>
                        <span>Masuk ke Dashboard</span>
                    </button>
                </form>
            </div>

            {{-- Footer --}}
            <p class="text-center text-xs text-gray-400 mt-6 font-medium">
                © 2024 Toko Deshan — Dibuat dengan ❤️ oleh Deshan
            </p>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
