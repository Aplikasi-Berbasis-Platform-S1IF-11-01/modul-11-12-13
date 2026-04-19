<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AiCik Stock - Sistem Inventari Toko Pak Cik & Mas Aimar">
    <title>@yield('title', 'AiCik Stock') | Inventari Toko</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- DataTables Bootstrap 5 -->
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary:    #7c3aed;
            --primary-dk: #5b21b6;
            --primary-lt: #ede9fe;
            --accent:     #f59e0b;
            --success:    #10b981;
            --danger:     #ef4444;
            --bg:         #f5f6fa;
            --bg-card:    #ffffff;
            --bg-sidebar: #ffffff;
            --border:     #e5e7eb;
            --text:       #1e1b2e;
            --muted:      #6b7280;
            --radius:     14px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: 260px;
            height: 100vh;
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: transform .3s ease;
            box-shadow: 2px 0 12px rgba(0,0,0,.06);
        }
        .sidebar-logo {
            padding: 1.5rem 1.5rem 1rem;
            border-bottom: 1px solid var(--border);
        }
        .sidebar-logo .brand {
            font-family: 'Poppins', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(90deg, #7c3aed, #9333ea);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .sidebar-logo .sub {
            font-size: .72rem;
            color: var(--muted);
            margin-top: .15rem;
        }
        .sidebar-nav { flex: 1; padding: 1rem 0; }
        .nav-label {
            font-size: .65rem;
            font-weight: 700;
            color: var(--muted);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: .5rem 1.5rem .25rem;
        }
        .nav-item a {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .65rem 1.5rem;
            color: var(--muted);
            text-decoration: none;
            font-size: .88rem;
            border-radius: 0;
            transition: background .2s, color .2s;
        }
        .nav-item a:hover,
        .nav-item a.active {
            background: #f3f0ff;
            color: #7c3aed;
        }
        .nav-item a.active { border-left: 3px solid var(--primary); }
        .nav-item a i { font-size: 1.1rem; }
        .sidebar-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border);
        }
        .user-card {
            display: flex; align-items: center; gap: .75rem;
            padding: .65rem; border-radius: 10px;
            background: #f9fafb;
        }
        .user-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), #a78bfa);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: .9rem; color: #fff;
            flex-shrink: 0;
        }
        .user-name { font-size: .82rem; font-weight: 600; color: var(--text); }
        .user-role { font-size: .7rem; color: var(--muted); }
        .btn-logout {
            display: flex; align-items: center; gap: .4rem;
            padding: .5rem .75rem;
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
            border-radius: 8px;
            font-size: .78rem;
            cursor: pointer;
            transition: background .2s;
            text-decoration: none;
            margin-top: .75rem;
            width: 100%;
            justify-content: center;
        }
        .btn-logout:hover { background: #fee2e2; color: #b91c1c; }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .topbar {
            background: #ffffff;
            border-bottom: 1px solid var(--border);
            box-shadow: 0 1px 6px rgba(0,0,0,.05);
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky; top: 0; z-index: 90;
        }
        .topbar-title { font-family: 'Poppins', sans-serif; font-size: 1.1rem; font-weight: 600; }
        .topbar-breadcrumb { font-size: .78rem; color: var(--muted); margin-top: .1rem; }
        .content-area { padding: 2rem; flex: 1; }

        /* Cards */
        .card-custom {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.5rem;
            box-shadow: 0 1px 6px rgba(0,0,0,.05);
        }
        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.25rem 1.5rem;
            display: flex; align-items: center; gap: 1rem;
            box-shadow: 0 1px 6px rgba(0,0,0,.05);
        }
        .stat-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
        }
        .stat-icon.purple { background: #ede9fe; color: #7c3aed; }
        .stat-icon.green  { background: #d1fae5; color: #059669; }
        .stat-icon.amber  { background: #fef3c7; color: #d97706; }
        .stat-icon.red    { background: #fee2e2; color: #dc2626; }
        .stat-val { font-family: 'Poppins', sans-serif; font-size: 1.6rem; font-weight: 700; color: var(--text); }
        .stat-lbl { font-size: .78rem; color: var(--muted); }

        /* DataTable override */
        .dataTables_wrapper { color: var(--text); }
        table.dataTable thead th {
            background: #f9fafb !important;
            color: var(--muted) !important;
            border-color: var(--border) !important;
            font-size: .78rem; font-weight: 600;
            text-transform: uppercase; letter-spacing: .5px;
        }
        table.dataTable tbody tr,
        table.dataTable tbody tr.odd,
        table.dataTable tbody tr.even { background: #ffffff !important; }
        table.dataTable tbody tr *,
        table.dataTable tbody tr:hover *,
        table.dataTable tbody tr.odd:hover *,
        table.dataTable tbody tr.even:hover * {
            background-color: #ffffff !important;
            --bs-table-bg-state: #ffffff !important;
            --bs-table-accent-bg: #ffffff !important;
            --bs-table-striped-bg: #ffffff !important;
            --bs-table-hover-bg: #ffffff !important;
            cursor: default !important;
        }
        table.dataTable tbody td { border-color: var(--border) !important; font-size: .88rem; color: var(--text); }
        .dataTables_filter input,
        .dataTables_length select {
            background: #f9fafb !important;
            border: 1px solid var(--border) !important;
            color: var(--text) !important;
            border-radius: 8px !important;
            padding: .35rem .65rem !important;
        }
        .dataTables_info, .dataTables_paginate { color: var(--muted) !important; font-size: .82rem; }
        .paginate_button { color: var(--muted) !important; border-radius: 6px !important; }
        .paginate_button.current { background: var(--primary) !important; border-color: var(--primary) !important; color: #fff !important; }
        .paginate_button:hover:not(.current) { background: #ede9fe !important; color: #7c3aed !important; border-color: transparent !important; }

        /* Badges */
        .badge-aktif    { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; border-radius: 99px; padding: .2rem .7rem; font-size: .75rem; font-weight: 600; }
        .badge-nonaktif { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; border-radius: 99px; padding: .2rem .7rem; font-size: .75rem; font-weight: 600; }
        .badge-kategori { background: #ede9fe; color: #5b21b6; border: 1px solid #ddd6fe; border-radius: 99px; padding: .2rem .7rem; font-size: .75rem; font-weight: 600; }
        .badge-stok-0   { background: #fee2e2; color: #991b1b; border-radius: 6px; padding: .15rem .5rem; font-size: .82rem; }

        /* Buttons */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary), #9333ea);
            border: none; color: #fff;
            border-radius: 10px; padding: .6rem 1.4rem;
            font-size: .88rem; font-weight: 600;
            transition: transform .2s, box-shadow .2s;
            cursor: pointer;
        }
        .btn-primary-custom:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(124,58,237,.4); }
        .btn-edit   { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; border-radius: 7px; padding: .3rem .7rem; font-size: .8rem; }
        .btn-edit:hover { background: #fde68a; color: #78350f; }
        .btn-del    { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; border-radius: 7px; padding: .3rem .7rem; font-size: .8rem; }
        .btn-del:hover  { background: #fecaca; color: #7f1d1d; }
        .btn-view   { background: #dbeafe; color: #1e40af; border: 1px solid #bfdbfe; border-radius: 7px; padding: .3rem .7rem; font-size: .8rem; }
        .btn-view:hover { background: #bfdbfe; color: #1d4ed8; }

        /* Forms */
        .form-control-dark {
            background: #f9fafb !important;
            border: 1px solid var(--border) !important;
            color: var(--text) !important;
            border-radius: 10px !important;
        }
        .form-control-dark:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 3px rgba(124,58,237,.15) !important;
        }
        .form-label-dark { font-size: .83rem; font-weight: 500; color: #374151; margin-bottom: .4rem; }
        .form-select-dark {
            background-color: #f9fafb !important;
            border: 1px solid var(--border) !important;
            color: var(--text) !important;
            border-radius: 10px !important;
        }
        .form-select-dark:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 3px rgba(124,58,237,.15) !important;
        }
        .invalid-feedback { font-size: .78rem; }

        /* Modal */
        .modal-content {
            background: #ffffff !important;
            border: 1px solid var(--border) !important;
            border-radius: var(--radius) !important;
            box-shadow: 0 20px 60px rgba(0,0,0,.15) !important;
        }
        .modal-header { border-color: var(--border) !important; }
        .modal-footer { border-color: var(--border) !important; }

        /* Alert */
        .alert-custom {
            border-radius: 10px; padding: .85rem 1.25rem;
            font-size: .88rem; display: flex; align-items: center; gap: .6rem;
        }
        .alert-success-custom { background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; }
        .alert-error-custom   { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }

        /*Responsive */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
        /* Bootstrap Pagination Override */
        .page-link { color: #7c3aed !important; border-color: var(--border) !important; background: #ffffff !important; border-radius: 6px !important; font-size: .83rem; }
        .page-link:hover { background: #ede9fe !important; color: #5b21b6 !important; border-color: #ddd6fe !important; }
        .page-item.active .page-link { background: #7c3aed !important; border-color: #7c3aed !important; color: #ffffff !important; }
        .page-item.disabled .page-link { background: #f9fafb !important; color: #9ca3af !important; border-color: var(--border) !important; }
        .btn-close { filter: none !important; }
    </style>

    @stack('styles')
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <div class="brand">AiCik Stock</div>
        <div class="sub">Toko Pak Cik &amp; Mas Aimar</div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-label">Navigasi</div>
        <div class="nav-item">
            <a href="{{ route('produk.index') }}" class="{{ request()->routeIs('produk.index') ? 'active' : '' }}">
                <i class="bi bi-box-seam-fill"></i> Daftar Produk
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('produk.create') }}" class="{{ request()->routeIs('produk.create') ? 'active' : '' }}">
                <i class="bi bi-plus-circle-fill"></i> Tambah Produk
            </a>
        </div>
    </nav>


    <div class="sidebar-footer">
        @auth
        <div class="user-card">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div>
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">{{ Auth::user()->email }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
        @endauth
    </div>
</aside>

<!-- Main Content -->
<div class="main-content">
    <div class="topbar">
        <div>
            <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
            <div class="topbar-breadcrumb">@yield('breadcrumb', 'AiCik Stock / Dashboard')</div>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span style="font-size:.82rem; color:var(--primary); font-weight: 600; padding-right: 15px; border-right: 1px solid var(--border);">Qonita Rahayu Atmi &bull; 2311102128</span>
            @auth
            <span style="font-size:.82rem; color:var(--muted)">Halo, <strong style="color:var(--text)">{{ Auth::user()->name }}</strong></span>
            @endauth
        </div>
    </div>

    <div class="content-area">

        {{-- Flash messages --}}
        @if(session('success'))
        <div class="alert-custom alert-success-custom mb-4" id="flash-msg">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert-custom alert-error-custom mb-4">
            <i class="bi bi-x-circle-fill"></i> {{ session('error') }}
        </div>
        @endif

        @yield('content')
    </div>

    <footer style="text-align:center; padding:1.5rem; border-top:1px solid var(--border); color:var(--muted); font-size:.78rem;">
        AiCik Stock &mdash; Sistem Inventari Toko Pak Cik &amp; Mas Aimar &bull; Dibuat oleh Qonita Rahayu Atmi &bull; 2311102128
    </footer>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script>
// Auto-hide flash message
const flashMsg = document.getElementById('flash-msg');
if (flashMsg) {
    setTimeout(() => {
        flashMsg.style.opacity = '0';
        flashMsg.style.transition = 'opacity .5s';
        setTimeout(() => flashMsg.remove(), 500);
    }, 4000);
}
</script>

@stack('scripts')
</body>
</html>
