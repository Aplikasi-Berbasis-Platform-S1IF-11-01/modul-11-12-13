@extends('layouts.app')

@section('title', 'Daftar Produk')
@section('page-title', 'Daftar Produk')
@section('breadcrumb', 'AiCik Stock / Produk')

@section('content')

{{-- ── Stat Cards ──────────────────────────────── --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="stat-icon purple"><i class="bi bi-box-seam-fill"></i></div>
            <div>
                <div class="stat-val">{{ $stats['total'] }}</div>
                <div class="stat-lbl">Total Produk</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="stat-icon green"><i class="bi bi-check-circle-fill"></i></div>
            <div>
                <div class="stat-val">{{ $stats['aktif'] }}</div>
                <div class="stat-lbl">Produk Aktif</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="stat-icon amber"><i class="bi bi-pause-circle-fill"></i></div>
            <div>
                <div class="stat-val">{{ $stats['nonaktif'] }}</div>
                <div class="stat-lbl">Nonaktif</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="stat-icon red"><i class="bi bi-exclamation-triangle-fill"></i></div>
            <div>
                <div class="stat-val">{{ $stats['habis'] }}</div>
                <div class="stat-lbl">Stok Habis</div>
            </div>
        </div>
    </div>
</div>

{{-- ── DataTable Card ───────────────────────────── --}}
<div class="card-custom">
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h5 class="mb-0" style="font-family:'Poppins',sans-serif;font-weight:600;">Data Inventari Produk</h5>
            <p style="font-size:.78rem;color:var(--muted);margin-top:.2rem;">Kelola stok produk toko Pak Cik &amp; Mas Aimar</p>
        </div>
        <a href="{{ route('produk.create') }}" class="btn-primary-custom text-decoration-none">
            <i class="bi bi-plus-lg me-1"></i> Tambah Produk
        </a>
    </div>

    <div class="table-responsive">
        <table id="produk-table" class="table align-middle w-100">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th style="min-width:130px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produks as $i => $produk)
                <tr>
                    <td style="color:var(--muted);font-size:.8rem;">{{ $i + 1 }}</td>
                    <td>
                        <span style="font-family:monospace;font-size:.82rem;color:#5b21b6;background:#ede9fe;padding:.15rem .5rem;border-radius:5px;">
                            {{ $produk->kode }}
                        </span>
                    </td>
                    <td>
                        <div style="font-weight:600;font-size:.88rem;">{{ $produk->nama }}</div>
                    </td>
                    <td><span class="badge-kategori">{{ $produk->kategori->nama ?? '-' }}</span></td>
                    <td style="font-weight:600;color:#d97706;">
                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </td>
                    <td>
                        @if($produk->stok == 0)
                            <span class="badge-stok-0"><i class="bi bi-x-circle"></i> Habis</span>
                        @elseif($produk->stok <= 10)
                            <span style="color:#c2410c;font-size:.85rem;font-weight:600;">⚠ {{ $produk->stok }} {{ $produk->satuan }}</span>
                        @else
                            <span style="font-size:.85rem;">{{ $produk->stok }} <span style="color:var(--muted);font-size:.75rem;">{{ $produk->satuan }}</span></span>
                        @endif
                    </td>
                    <td>
                        @if($produk->status === 'aktif')
                            <span class="badge-aktif"><i class="bi bi-circle-fill" style="font-size:.5rem;vertical-align:middle;margin-right:.3rem;"></i>Aktif</span>
                        @else
                            <span class="badge-nonaktif"><i class="bi bi-circle-fill" style="font-size:.5rem;vertical-align:middle;margin-right:.3rem;"></i>Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-1 flex-wrap">
                            <a href="{{ route('produk.show', $produk) }}" class="btn-view text-decoration-none" title="Detail">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a href="{{ route('produk.edit', $produk) }}" class="btn-edit text-decoration-none" title="Edit">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <button
                                class="btn-del"
                                title="Hapus"
                                onclick="confirmDelete({{ $produk->id }}, '{{ addslashes($produk->nama) }}')"
                            >
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-5" style="color:var(--muted);">
                        <i class="bi bi-inbox" style="font-size:2rem;display:block;margin-bottom:.5rem;"></i>
                        Belum ada produk. <a href="{{ route('produk.create') }}" style="color:#a78bfa;">Tambahkan sekarang</a>.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ── Modal Konfirmasi Hapus ───────────────────── --}}
<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title" id="modalHapusLabel" style="color:var(--text);font-family:'Poppins',sans-serif;">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="padding:1.5rem;">
                <div style="text-align:center;margin-bottom:1rem;">
                    <div style="width:72px;height:72px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto .75rem;">
                        <i class="bi bi-trash-fill" style="font-size:1.8rem;color:#dc2626;"></i>
                    </div>
                    <p style="color:var(--text);font-size:.95rem;margin-bottom:.5rem;">
                        Kamu yakin ingin menghapus produk:
                    </p>
                    <p id="modal-produk-nama" style="font-weight:700;font-size:1rem;color:#f87171;"></p>
                    <p style="font-size:.82rem;color:var(--muted);margin-top:.5rem;">
                        Tindakan ini <strong style="color:#f87171;">tidak dapat dibatalkan</strong> dan data akan dihapus permanen.
                    </p>
                </div>
            </div>
            <div class="modal-footer" style="justify-content:center;gap:.75rem;">
                <button type="button" class="btn" data-bs-dismiss="modal"
                    style="background:#f3f4f6;color:var(--text);border:1px solid var(--border);border-radius:9px;padding:.55rem 1.25rem;">
                    <i class="bi bi-x-lg me-1"></i> Batal
                </button>
                <form id="form-hapus" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn"
                        style="background:linear-gradient(135deg,#ef4444,#dc2626);color:#fff;border:none;border-radius:9px;padding:.55rem 1.25rem;font-weight:600;">
                        <i class="bi bi-trash-fill me-1"></i> Ya, Hapus!
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#produk-table').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/id.json',
        },
        pageLength: 10,
        order: [[0, 'asc']],
        columnDefs: [
            { orderable: false, targets: 7 }
        ],
        dom: '<"d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3"lf>t<"d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3"ip>',
    });
});

function confirmDelete(id, nama) {
    document.getElementById('modal-produk-nama').textContent = '"' + nama + '"';
    document.getElementById('form-hapus').action = '/produk/' + id;
    const modal = new bootstrap.Modal(document.getElementById('modalHapus'));
    modal.show();
}
</script>
@endpush
