<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Inventari Toko') — Toko Pak Cik & Mas Aimar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #1a56db;
            --primary-dark: #1e429f;
            --sidebar-bg: #0f172a;
            --sidebar-width: 260px;
            --accent: #f59e0b;
        }

        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: #f1f5f9; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand { padding: 1.5rem 1.25rem; border-bottom: 1px solid rgba(255,255,255,.08); }
        .sidebar-brand .brand-title { font-size: 1rem; font-weight: 800; color: #fff; line-height: 1.2; }
        .sidebar-brand .brand-subtitle { font-size: .72rem; color: #94a3b8; font-weight: 500; }
        .sidebar-brand .brand-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; margin-bottom: .5rem;
        }

        .sidebar-nav { padding: 1rem 0; flex: 1; }
        .nav-section-label {
            font-size: .65rem; font-weight: 700; color: #475569;
            letter-spacing: .12em; text-transform: uppercase;
            padding: .75rem 1.25rem .25rem;
        }

        .sidebar-link {
            display: flex; align-items: center; gap: .75rem;
            padding: .6rem 1.25rem; color: #94a3b8;
            text-decoration: none; font-size: .875rem; font-weight: 500;
            margin: .1rem .75rem; border-radius: 8px; transition: all .2s;
        }
        .sidebar-link:hover, .sidebar-link.active { background: rgba(26,86,219,.15); color: #60a5fa; }
        .sidebar-link.active { color: #93c5fd; font-weight: 600; }
        .sidebar-link i { font-size: 1rem; width: 20px; text-align: center; }

        .sidebar-footer { padding: 1rem 1.25rem; border-top: 1px solid rgba(255,255,255,.08); }
        .user-card { display: flex; align-items: center; gap: .75rem; }
        .user-avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-weight: 700; color: #fff; font-size: .85rem; flex-shrink: 0;
        }
        .user-name { font-size: .825rem; font-weight: 600; color: #e2e8f0; }
        .user-role { font-size: .7rem; color: #64748b; }

        /* MAIN CONTENT */
        .main-content { margin-left: var(--sidebar-width); min-height: 100vh; display: flex; flex-direction: column; }

        .topbar {
            background: #fff; border-bottom: 1px solid #e2e8f0;
            padding: .875rem 1.75rem;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 100;
        }
        .page-title { font-size: 1.1rem; font-weight: 700; color: #0f172a; margin: 0; }
        .page-container { padding: 1.75rem; flex: 1; }

        /* CARDS */
        .stat-card {
            background: #fff; border-radius: 14px;
            padding: 1.25rem; border: 1px solid #e2e8f0;
            transition: transform .2s, box-shadow .2s;
        }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,0,0,.08); }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; }
        .stat-value { font-size: 1.75rem; font-weight: 800; color: #0f172a; }
        .stat-label { font-size: .8rem; color: #64748b; font-weight: 500; }

        /* TABLE */
        .table-card { background: #fff; border-radius: 14px; border: 1px solid #e2e8f0; overflow: hidden; }
        .table-header {
            padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9;
            display: flex; align-items: center; justify-content: space-between;
        }
        .table > thead > tr > th {
            background: #f8fafc; color: #475569; font-size: .75rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: .06em;
            border-bottom: 2px solid #e2e8f0; padding: .875rem 1rem;
        }
        .table > tbody > tr > td {
            padding: .875rem 1rem; vertical-align: middle;
            color: #334155; font-size: .875rem; border-bottom: 1px solid #f1f5f9;
        }
        .table > tbody > tr:last-child > td { border-bottom: none; }
        .table > tbody > tr:hover > td { background: #f8fafc; }

        /* BADGES */
        .badge-category { background: #eff6ff; color: #1d4ed8; padding: .3rem .75rem; border-radius: 20px; font-size: .72rem; font-weight: 600; }

        /* BUTTONS */
        .btn-primary-custom {
            background: var(--primary); color: #fff; border: none;
            border-radius: 8px; padding: .5rem 1.1rem;
            font-weight: 600; font-size: .85rem; transition: all .2s;
        }
        .btn-primary-custom:hover { background: var(--primary-dark); color: #fff; transform: translateY(-1px); }

        /* FORMS */
        .form-card { background: #fff; border-radius: 14px; border: 1px solid #e2e8f0; padding: 2rem; }
        .form-label { font-weight: 600; font-size: .85rem; color: #374151; }
        .form-control, .form-select {
            border-radius: 8px; border: 1.5px solid #e2e8f0;
            font-size: .875rem; padding: .55rem .9rem; transition: all .2s;
        }
        .form-control:focus, .form-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(26,86,219,.1); }
        .form-control.is-invalid { border-color: #ef4444; }

        /* ALERTS */
        .alert { border-radius: 10px; font-size: .875rem; border: none; }
        .alert-success { background: #f0fdf4; color: #15803d; }
        .alert-danger { background: #fef2f2; color: #b91c1c; }

        /* DATATABLE */
        div.dataTables_wrapper div.dataTables_filter input {
            border-radius: 8px; border: 1.5px solid #e2e8f0; padding: .4rem .8rem; font-size: .85rem;
        }
        div.dataTables_wrapper div.dataTables_length select { border-radius: 8px; border: 1.5px solid #e2e8f0; }
        .page-link { color: var(--primary); }
        .page-item.active .page-link { background: var(--primary); border-color: var(--primary); }

        /* MODAL */
        .modal-content { border-radius: 16px; border: none; }
        .modal-header { border-bottom: 1px solid #f1f5f9; padding: 1.25rem 1.5rem; }
        .modal-footer { border-top: 1px solid #f1f5f9; }
    </style>
    @stack('styles')
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">🏪</div>
        <div class="brand-title">Inventari Toko</div>
        <div class="brand-subtitle">Pak Cik & Mas Aimar</div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Menu Utama</div>
        <a href="{{ route('products.index') }}" class="sidebar-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Manajemen Produk
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-card">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div>
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">Administrator</div>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-sm w-100 text-start px-2"
                style="background:rgba(239,68,68,.1); color:#f87171; border-radius:8px; font-size:.8rem; font-weight:600;">
                <i class="bi bi-box-arrow-left me-1"></i> Logout
            </button>
        </form>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="topbar">
        <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
        <div class="d-flex align-items-center gap-2">
            <span class="badge" style="background:#eff6ff; color:#1d4ed8; font-size:.75rem; padding:.4rem .8rem; border-radius:20px;">
                <i class="bi bi-calendar3 me-1"></i>{{ now()->locale('id')->isoFormat('D MMMM Y') }}
            </span>
        </div>
    </div>

    <!-- FLASH MESSAGE -->
    <div class="px-4 pt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <div class="page-container">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
@stack('scripts')
</body>
</html>