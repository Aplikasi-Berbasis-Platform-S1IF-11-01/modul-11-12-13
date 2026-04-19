<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | Pak Cik & Aimar Skincare Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: radial-gradient(circle at top right, #fdf2f7 0%, #ffffff 100%); }
        input:focus { border-color: #db2777 !important; outline: none; box-shadow: 0 0 0 4px #fdf2f7; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-[480px]">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-pink-600 tracking-tight">Pak Cik & Aimar <span class="text-gray-800">Stock</span></h1>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.3em] mt-2">Create New Account</p>
        </div>

        <div class="bg-white rounded-[32px] shadow-2xl shadow-pink-100/50 border border-gray-100 p-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Daftar Akun</h2>
            <p class="text-sm text-gray-400 mb-8 font-medium">Mulai kelola inventori skincare kamu sekarang.</p>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                <div class="space-y-1">
                    <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Masukkan nama"
                        class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-medium transition-all">
                </div>
                <div class="space-y-1">
                    <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="admin@toko.com"
                        class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-medium transition-all">
                </div>
                <div class="space-y-1">
                    <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Kata Sandi</label>
                    <input type="password" name="password" required placeholder="••••••••"
                        class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-medium transition-all">
                </div>
                <div class="space-y-1">
                    <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Konfirmasi Sandi</label>
                    <input type="password" name="password_confirmation" required placeholder="••••••••"
                        class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-medium transition-all">
                </div>

                <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white px-8 py-4 rounded-2xl text-xs font-bold transition-all shadow-lg shadow-pink-200 uppercase tracking-widest mt-4">
                    Daftar Sekarang
                </button>
            </form>

            <p class="text-center mt-8 text-xs font-bold text-gray-400 uppercase tracking-wider">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-pink-600 hover:underline">Masuk Saja</a>
            </p>
        </div>
    </div>
</body>
</html>