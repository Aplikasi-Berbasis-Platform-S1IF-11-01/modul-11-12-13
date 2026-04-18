<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Buat Akun Baru</h2>
        <p class="text-sm font-medium text-gray-500 mt-1">Daftar untuk mengelola inventori buku.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div class="space-y-2">
            <label for="name" class="block text-sm font-semibold text-gray-700">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="block w-full px-4 py-3 rounded-xl border-gray-200 bg-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/20 transition-all duration-200 placeholder-gray-400 {{ $errors->has('name') ? 'border-red-500' : '' }}" 
                placeholder="Masukkan nama lengkap">
            @error('name')
                <p class="text-sm text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="space-y-2">
            <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="block w-full px-4 py-3 rounded-xl border-gray-200 bg-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/20 transition-all duration-200 placeholder-gray-400 {{ $errors->has('email') ? 'border-red-500' : '' }}" 
                placeholder="contoh@email.com">
            @error('email')
                <p class="text-sm text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="block w-full px-4 py-3 rounded-xl border-gray-200 bg-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/20 transition-all duration-200 placeholder-gray-400 {{ $errors->has('password') ? 'border-red-500' : '' }}" 
                placeholder="Minimal 8 karakter">
            @error('password')
                <p class="text-sm text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2">
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="block w-full px-4 py-3 rounded-xl border-gray-200 bg-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/20 transition-all duration-200 placeholder-gray-400 {{ $errors->has('password_confirmation') ? 'border-red-500' : '' }}" 
                placeholder="Ketik ulang password">
            @error('password_confirmation')
                <p class="text-sm text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="relative w-full flex justify-center items-center py-3.5 px-4 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-md shadow-blue-500/30 transform transition-all duration-200 hover:-translate-y-0.5 mt-4">
            Daftar Sekarang
        </button>
    </form>

    <div class="mt-8 text-center border-t border-gray-100 pt-6">
        <p class="text-sm font-medium text-gray-500">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-800 hover:underline transition-all">Masuk di sini</a>
        </p>
    </div>
</x-guest-layout>
