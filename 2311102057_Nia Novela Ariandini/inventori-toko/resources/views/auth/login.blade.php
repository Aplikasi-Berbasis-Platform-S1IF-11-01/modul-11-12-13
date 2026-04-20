<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | Pak Cik & Aimar Skincare Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .pink-gradient {
            background: radial-gradient(circle at top right, #fdf2f7 0%, #ffffff 100%);
        }
        input:focus { border-color: #db2777 !important; outline: none; box-shadow: 0 0 0 4px #fdf2f7; }
    </style>
</head>
<body class="pink-gradient min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-[450px]">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-pink-600 tracking-tight"> Pak Cik & Aimar <span class="text-gray-800">Stock</span></h1>
            <p class="text-[11px] text-gray-400 font-bold uppercase tracking-[0.3em] mt-2">Management System</p>
        </div>

        <div class="bg-white rounded-[32px] shadow-2xl shadow-pink-100/50 border border-gray-100 overflow-hidden">
            <div class="p-10">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800">Selamat Datang</h2>
                    <p class="text-sm text-gray-400 mt-1 font-medium">Silakan masuk untuk mengelola inventori.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-rose-50 border border-rose-100 rounded-2xl">
                        <ul class="list-disc list-inside text-xs font-bold text-rose-500">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div class="space-y-2">
                        <label for="email" class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Email Admin</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                            placeholder="admin@toko.com"
                            class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-medium transition-all">
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center ml-1">
                            <label for="password" class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Kata Sandi</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-[10px] font-bold text-pink-500 hover:underline">Lupa Sandi?</a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password" required 
                            placeholder="••••••••"
                            class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-medium transition-all">
                    </div>

                    <div class="flex items-center ml-1">
                        <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-pink-600 border-gray-200 rounded focus:ring-pink-500">
                        <label for="remember_me" class="ml-2 text-xs font-bold text-gray-500 uppercase tracking-wider">Ingat Sesi Saya</label>
                    </div>

                    <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white px-8 py-4 rounded-2xl text-xs font-bold transition-all shadow-lg shadow-pink-200 uppercase tracking-widest mt-4">
                        Masuk Ke Dashboard
                    </button>
                </form>
            </div>
            
            <div class="p-6 bg-gray-50/50 border-t border-gray-50 text-center">
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">
                    Pak Cik & Aimar Skincare Inventory &copy; 2026
                </p>
            </div>
        </div>

        <div class="text-center mt-8">
            <a href="/" class="text-xs font-bold text-gray-400 hover:text-pink-500 transition-all flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                KEMBALI KE BERANDA
            </a>
        </div>
    </div>

</body>
</html>