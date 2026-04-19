<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pak Cik & Aimar | Skincare Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fcfdfe; }
        .text-gradient { background: linear-gradient(to right, #db2777, #f472b6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        /* Konten pas satu layar */
        .full-screen { height: 100vh; display: flex; flex-direction: column; }
    </style>
</head>
<body class="antialiased overflow-hidden">

    <div class="full-screen p-6">
        <nav class="max-w-6xl mx-auto w-full flex items-center justify-between px-2 mb-4">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-pink-600 rounded-lg flex items-center justify-center shadow-lg shadow-pink-100">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <span class="text-lg font-bold tracking-tighter">Pak Cik & Aimar | <span class="text-pink-600"> Skincare Inventory</span></span>
            </div>
            
            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-xs font-bold text-gray-500 hover:text-pink-600 transition uppercase tracking-widest">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-xs font-bold text-gray-400 hover:text-pink-600 transition uppercase tracking-widest">Login</a>
                        <a href="{{ route('register') }}" class="bg-pink-600 text-white px-5 py-2 rounded-xl text-[10px] font-bold shadow-lg shadow-pink-100 uppercase tracking-widest">Daftar</a>
                    @endauth
                @endif
            </div>
        </nav>

        <main class="flex-1 flex flex-col items-center justify-center text-center max-w-4xl mx-auto">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-pink-50 border border-pink-100 rounded-full mb-4">
                <span class="w-1.5 h-1.5 bg-pink-500 rounded-full animate-pulse"></span>
                <span class="text-[9px] font-bold text-pink-600 uppercase tracking-[0.2em]">Mas Aimar Glow Inventory</span>
            </div>

            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-gray-900 leading-[1.15] mb-4">
                Inventori Pak Cik <br> <span class="text-gradient">Kelola Stok Mas Aimar.</span>
            </h1>

            <p class="text-gray-400 text-sm md:text-base max-w-xl mx-auto mb-8 font-medium leading-relaxed">
                Mas Jakobi mau belanja? Cek dulu stok skincare-nya di sini. Platform inventori cerdas yang bikin bisnis Mas Aimar makin rapi.
            </p>

            <div class="flex items-center justify-center gap-3 mb-10">
                <a href="{{ route('login') }}" class="bg-gray-900 text-white px-8 py-3.5 rounded-2xl text-xs font-bold hover:bg-pink-600 transition-all shadow-xl shadow-gray-100 uppercase tracking-widest flex items-center gap-2">
                    Mulai Sekarang
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </a>
</div>
        </main>

        <footer class="text-center py-4">
            <p class="text-[9px] font-bold text-gray-300 uppercase tracking-[0.6em]">
                Pak Cik & Aimar &copy; 2026 — Purwokerto
            </p>
        </footer>
    </div>

</body>
</html>