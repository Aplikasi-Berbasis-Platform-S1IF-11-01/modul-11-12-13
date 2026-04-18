<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-5" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                class="block w-full px-4 py-3 rounded-xl border-gray-200 bg-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/20 transition-all duration-200 placeholder-gray-400 {{ $errors->has('email') ? 'border-red-500 ring-red-500/20' : '' }}" 
                placeholder="Masukkan alamat email">
            @error('email')
                <p class="text-sm text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="block w-full px-4 py-3 rounded-xl border-gray-200 bg-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/20 transition-all duration-200 placeholder-gray-400 {{ $errors->has('password') ? 'border-red-500 ring-red-500/20' : '' }}"
                placeholder="Masukkan password">
            @error('password')
                <p class="text-sm text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember" class="w-5 h-5 rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 focus:ring-offset-0 transition duration-200 cursor-pointer">
            <label for="remember_me" class="ml-3 block text-sm font-medium text-gray-600 cursor-pointer">Ingat saya</label>
        </div>

        <button type="submit" class="relative w-full flex justify-center items-center py-3.5 px-4 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-md shadow-blue-500/30 transform transition-all duration-200 hover:-translate-y-0.5 mt-2">
            Masuk ke Sistem
        </button>
    </form>

    <div class="mt-8 text-center">
        <p class="text-sm font-medium text-gray-500">
            Belum memiliki akun?
            <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-800 hover:underline transition-all">Daftar sekarang</a>
        </p>
    </div>
</x-guest-layout>
