<div class="bg-white rounded-[32px] shadow-2xl shadow-pink-100/50 border border-gray-100 p-10 text-center">
    <div class="w-16 h-16 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
    </div>
    <h2 class="text-2xl font-bold text-gray-800">Verifikasi Email</h2>
    <p class="text-sm text-gray-400 mt-4 mb-8 font-medium px-4">Terima kasih telah bergabung! Silakan cek email kamu dan klik tautan verifikasi yang kami kirimkan.</p>

    <div class="flex flex-col gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white px-8 py-4 rounded-2xl text-xs font-bold transition-all uppercase tracking-widest">
                Kirim Ulang Email
            </button>
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-[10px] font-bold text-gray-400 uppercase tracking-widest hover:text-rose-500 transition">Keluar Sesi</button>
        </form>
    </div>
</div>