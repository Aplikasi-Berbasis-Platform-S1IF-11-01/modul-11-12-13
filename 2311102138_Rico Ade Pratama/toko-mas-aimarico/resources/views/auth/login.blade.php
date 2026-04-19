@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4" style="background-color: #f0f2f5;">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
        
        <div class="bg-[#1f2128] py-8 text-center text-white border-b-4 border-emerald-600">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-emerald-600 rounded-full mb-3">
                <i class="fas fa-futbol text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold tracking-wide">Toko Mas Aimarico</h1>
            <p class="text-sm text-gray-400 mt-1">Sport Inventory Management</p>
        </div>

        <div class="p-8">
            <h2 class="text-center text-lg font-semibold text-gray-800 mb-6">Masuk ke Akun Anda</h2>

            @if($errors->any())
                <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg relative mb-6 text-sm flex items-center gap-2">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="mb-5">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full pl-10 pr-4 py-3 rounded-lg bg-blue-50 border border-blue-100 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors text-sm"
                            placeholder="nama@email.com">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" name="password" required
                            class="w-full pl-10 pr-4 py-3 rounded-lg bg-blue-50 border border-blue-100 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors text-sm"
                            placeholder="••••••••">
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#1e8f54] hover:bg-emerald-700 text-white font-bold py-3 px-4 rounded-lg transition-colors flex items-center justify-center gap-2 shadow-md">
                    <i class="fas fa-sign-in-alt"></i> Masuk Sistem
                </button>
            </form>

            <div class="mt-8 bg-[#fff9db] border border-yellow-200 rounded-lg p-4 text-sm text-gray-700 shadow-sm">
                <div class="flex items-center gap-2 font-bold mb-3 text-yellow-800">
                    <i class="fas fa-info-circle"></i> Akun Demo Asisten:
                </div>
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="bg-[#1f2128] text-white text-[10px] px-2 py-0.5 rounded font-bold tracking-wider">Admin</span>
                        <span class="text-gray-600">aimarico@toko.com / aimarico123</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="bg-[#1f2128] text-white text-[10px] px-2 py-0.5 rounded font-bold tracking-wider">Admin</span>
                        <span class="text-gray-600">pakcik@toko.com / pakcik123</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="bg-emerald-600 text-white text-[10px] px-2 py-0.5 rounded font-bold tracking-wider">Customer</span>
                        <span class="text-gray-600">jakobi@gmail.com / jakobi123</span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection