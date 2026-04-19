<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-black text-2xl text-slate-800 tracking-tight uppercase">
                    📦 Sistem <span class="text-emerald-600">Inventori Bayu Kuncoro Adi (2311102031)</span>
                </h2>
                <p class="text-sm text-slate-500 font-medium tracking-wide">Tugas Praktikum ABP - Toko Mas Aimar</p>
            </div>
            <div class="bg-slate-800 px-4 py-2 rounded-xl shadow-inner border border-slate-700">
                <span class="text-emerald-400 font-mono text-sm font-bold tracking-widest">USER: KING NASIR</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-8 flex items-center p-4 text-sm text-emerald-900 border-l-4 border-emerald-500 bg-emerald-50 rounded-r-xl shadow-md" role="alert">
                    <svg class="flex-shrink-0 inline w-6 h-6 me-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div><span class="font-extrabold uppercase tracking-wider text-xs bg-emerald-200 px-2 py-1 rounded-md mr-2">BERHASIL</span> {{ session('success') }}</div>
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-slate-200 overflow-hidden">
                
                <div class="bg-slate-900 p-6 sm:px-10 flex flex-col sm:flex-row justify-between items-center gap-4 border-b border-slate-800">
                    <div>
                        <h3 class="text-xl font-bold text-white tracking-wide">Data Produk Gudang</h3>
                        <p class="text-xs text-slate-400 mt-1 font-mono">Total item terpantau secara real-time</p>
                    </div>
                    <a href="{{ route('products.create') }}" class="group relative inline-flex items-center justify-center px-6 py-2.5 text-sm font-bold text-slate-900 transition-all duration-200 bg-emerald-400 border border-transparent rounded-full hover:bg-emerald-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 focus:ring-offset-slate-900 shadow-[0_0_15px_rgba(52,211,153,0.4)]">
                        <svg class="w-5 h-5 mr-2 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Data Baru
                    </a>
                </div>

                <div class="overflow-x-auto p-4 sm:p-6">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-slate-400 text-[11px] uppercase tracking-widest border-b-2 border-slate-100">
                                <th class="px-4 py-4 font-bold">No</th>
                                <th class="px-4 py-4 font-bold">Informasi Barang</th>
                                <th class="px-4 py-4 font-bold text-center">Status Gudang</th>
                                <th class="px-4 py-4 font-bold">Harga Satuan</th>
                                <th class="px-4 py-4 font-bold text-right">Manajemen</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($products as $index => $item)
                            <tr class="hover:bg-slate-50 transition-colors duration-300 group">
                                <td class="px-4 py-5 text-sm font-semibold text-slate-700">
                                    {{ $products->firstItem() + $index }}
                                </td>
                                <td class="px-4 py-5">
                                    <div class="text-sm font-extrabold text-slate-800 group-hover:text-emerald-600 transition-colors">{{ $item->nama_produk }}</div>
                                    <div class="text-xs text-slate-400 mt-1 truncate max-w-xs">{{ $item->deskripsi }}</div>
                                </td>
                                <td class="px-4 py-5 text-center">
                                    @if($item->stok < 20)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-white text-rose-600 border border-rose-200 shadow-sm">
                                            <span class="w-2 h-2 rounded-full bg-rose-500 mr-2 animate-pulse"></span>
                                            Kritis ({{ $item->stok }})
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-white text-emerald-600 border border-emerald-200 shadow-sm">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2"></span>
                                            Aman ({{ $item->stok }})
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-5 text-sm font-black text-slate-700">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-5 text-right space-x-2">
                                    <a href="{{ route('products.edit', $item->id) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-bold text-amber-600 bg-white border border-amber-300 rounded-lg hover:bg-amber-50 focus:ring-2 focus:ring-amber-500 transition-all">
                                        Edit
                                    </a>
                                    <button onclick="openModal({{ $item->id }}, '{{ $item->nama_produk }}')" class="inline-flex items-center px-3 py-1.5 text-xs font-bold text-rose-600 bg-white border border-rose-300 rounded-lg hover:bg-rose-50 focus:ring-2 focus:ring-rose-500 transition-all">
                                        Hapus
                                    </button>
                                    <form id="delete-form-{{ $item->id }}" action="{{ route('products.destroy', $item->id) }}" method="POST" class="hidden">
                                        @csrf @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-8 py-5 bg-slate-50 border-t border-slate-100 rounded-b-3xl">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-slate-900/80 backdrop-blur-sm" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-3xl shadow-2xl border border-slate-100 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-8">
                <div class="sm:flex sm:items-start">
                    <div class="flex items-center justify-center flex-shrink-0 w-14 h-14 mx-auto bg-rose-100 rounded-full sm:mx-0">
                        <svg class="w-8 h-8 text-rose-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="mt-4 text-center sm:mt-0 sm:ml-6 sm:text-left">
                        <h3 class="text-xl font-black leading-6 text-slate-900" id="modal-title">Konfirmasi Penghapusan</h3>
                        <div class="mt-3">
                            <p class="text-sm text-slate-500 leading-relaxed">
                                Tindakan ini tidak dapat dibatalkan. Apakah Anda yakin ingin menghapus data <br>
                                <strong id="modalProductName" class="text-rose-600 bg-rose-50 px-2 py-0.5 rounded border border-rose-100 mt-2 inline-block"></strong>?
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-8 sm:flex sm:flex-row-reverse gap-3">
                    <button type="button" id="confirmDeleteBtn" class="inline-flex justify-center w-full px-6 py-3 text-sm font-bold text-white transition-all bg-rose-600 border border-transparent rounded-xl shadow-lg shadow-rose-500/30 hover:bg-rose-700 sm:w-auto">
                        Ya, Hapus Permanen
                    </button>
                    <button type="button" onclick="closeModal()" class="inline-flex justify-center w-full px-6 py-3 mt-3 text-sm font-bold text-slate-700 transition-all bg-white border-2 border-slate-200 rounded-xl hover:bg-slate-50 hover:border-slate-300 sm:mt-0 sm:w-auto">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(id, name) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('modalProductName').innerText = name;
            document.getElementById('confirmDeleteBtn').onclick = function() {
                document.getElementById('delete-form-' + id).submit();
            };
        }
        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</x-app-layout>