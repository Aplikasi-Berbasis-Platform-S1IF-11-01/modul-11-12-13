<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Inventori Toko') — TokoCimar</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --navy:       #0f1f45;
            --navy-dark:  #081236;
            --navy-light: #1a3260;
            --pink:       #f72585;
            --pink-light: #ff6eb4;
            --pink-pale:  #fff0f7;
            --pink-soft:  #ffd6eb;
            --white:      #ffffff;
            --gray-100:   #f8f9fa;
            --gray-200:   #e9ecef;
            --text-muted: #6c757d;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f4f7ff;
            color: #1a1a2e;
            min-height: 100vh;
        }

        h1, h2, h3, h4, h5, h6, .fw-bold, .navbar-brand {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* ── NAVBAR ─────────────────────────────── */
        .navbar-main {
            background: var(--navy);
            padding: 0.85rem 0;
            box-shadow: 0 2px 20px rgba(15,31,69,.4);
        }

        .navbar-brand {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--white) !important;
            letter-spacing: -0.3px;
        }

        .navbar-brand .brand-dot {
            color: var(--pink);
        }

        .navbar-brand .brand-icon {
            background: var(--pink);
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            font-size: 0.9rem;
        }

        .nav-user-info {
            color: rgba(255,255,255,.75);
            font-size: 0.875rem;
        }

        .nav-user-info strong {
            color: var(--pink-light);
        }

        .btn-logout {
            background: rgba(247,37,133,.15);
            color: var(--pink-light);
            border: 1px solid rgba(247,37,133,.3);
            font-size: 0.8rem;
            padding: 0.35rem 0.9rem;
            border-radius: 8px;
            transition: all .2s;
        }

        .btn-logout:hover {
            background: var(--pink);
            color: white;
            border-color: var(--pink);
        }

        /* ── SIDEBAR / PAGE LAYOUT ───────────────── */
        .page-wrapper {
            display: flex;
            min-height: calc(100vh - 60px);
        }

        .sidebar {
            width: 230px;
            background: var(--navy-dark);
            flex-shrink: 0;
            padding: 1.5rem 1rem;
        }

        .sidebar .menu-label {
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,.3);
            padding: 0 0.5rem;
            margin-bottom: 0.5rem;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,.65);
            border-radius: 10px;
            padding: 0.6rem 0.75rem;
            font-size: 0.88rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            transition: all .2s;
            margin-bottom: 2px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(247,37,133,.15);
            color: var(--pink-light);
        }

        .sidebar .nav-link.active {
            background: rgba(247,37,133,.2);
            color: var(--pink);
            font-weight: 600;
        }

        .sidebar .nav-link i {
            font-size: 1rem;
            width: 20px;
            text-align: center;
        }

        /* ── MAIN CONTENT ────────────────────────── */
        .main-content {
            flex: 1;
            padding: 1.75rem 2rem;
            overflow-x: hidden;
        }

        /* ── CARDS ───────────────────────────────── */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 20px rgba(15,31,69,.08);
        }

        .card-header-custom {
            background: white;
            border-radius: 16px 16px 0 0;
            padding: 1.25rem 1.5rem;
            border-bottom: 2px solid var(--pink-pale);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .card-header-custom h5 {
            margin: 0;
            font-weight: 700;
            font-size: 1rem;
            color: var(--navy);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-header-custom h5 .icon-box {
            background: var(--pink-pale);
            color: var(--pink);
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* ── BUTTONS ─────────────────────────────── */
        .btn-pink {
            background: var(--pink);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 0.5rem 1.25rem;
            transition: all .2s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .btn-pink:hover {
            background: #d91a6f;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(247,37,133,.35);
        }

        .btn-navy {
            background: var(--navy);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 0.5rem 1.25rem;
            transition: all .2s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .btn-navy:hover {
            background: var(--navy-light);
            color: white;
            transform: translateY(-1px);
        }

        .btn-outline-pink {
            background: transparent;
            color: var(--pink);
            border: 1.5px solid var(--pink);
            border-radius: 8px;
            font-size: 0.8rem;
            padding: 0.3rem 0.75rem;
            transition: all .2s;
            font-weight: 500;
        }

        .btn-outline-pink:hover {
            background: var(--pink);
            color: white;
        }

        .btn-outline-danger-soft {
            background: transparent;
            color: #dc3545;
            border: 1.5px solid #dc3545;
            border-radius: 8px;
            font-size: 0.8rem;
            padding: 0.3rem 0.75rem;
            transition: all .2s;
            font-weight: 500;
        }

        .btn-outline-danger-soft:hover {
            background: #dc3545;
            color: white;
        }

        /* ── TABLE ───────────────────────────────── */
        .table-custom {
            background: white;
            border-radius: 0 0 16px 16px;
            overflow: hidden;
        }

        .table-custom thead th {
            background: var(--navy);
            color: rgba(255,255,255,.85);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0.9rem 1rem;
            border: none;
        }

        .table-custom tbody td {
            padding: 0.85rem 1rem;
            vertical-align: middle;
            font-size: 0.88rem;
            border-bottom: 1px solid var(--gray-200);
            color: #2d3748;
        }

        .table-custom tbody tr:last-child td {
            border-bottom: none;
        }

        .table-custom tbody tr:hover {
            background: var(--pink-pale);
            transition: background .15s;
        }

        /* ── BADGES ──────────────────────────────── */
        .badge-kategori {
            background: var(--pink-pale);
            color: var(--pink);
            border: 1px solid var(--pink-soft);
            font-size: 0.72rem;
            font-weight: 600;
            padding: 0.3rem 0.7rem;
            border-radius: 20px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .badge-stok {
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.3rem 0.7rem;
            border-radius: 6px;
        }

        .badge-stok.ok    { background: #dcfce7; color: #166534; }
        .badge-stok.low   { background: #fef9c3; color: #854d0e; }
        .badge-stok.empty { background: #fee2e2; color: #991b1b; }

        /* ── FORM ────────────────────────────────── */
        .form-label {
            font-weight: 600;
            font-size: 0.83rem;
            color: var(--navy);
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin-bottom: 0.4rem;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            padding: 0.55rem 0.9rem;
            font-size: 0.875rem;
            transition: all .2s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--pink);
            box-shadow: 0 0 0 3px rgba(247,37,133,.12);
        }

        .form-control.is-invalid, .form-select.is-invalid {
            border-color: #dc3545;
        }

        /* ── ALERTS ──────────────────────────────── */
        .alert-success-custom {
            background: #f0fdf4;
            border: 1px solid #86efac;
            color: #166534;
            border-radius: 12px;
            font-size: 0.875rem;
            padding: 0.8rem 1.1rem;
        }

        .alert-danger-custom {
            background: #fff1f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            border-radius: 12px;
            font-size: 0.875rem;
            padding: 0.8rem 1.1rem;
        }

        /* ── PAGE TITLE ──────────────────────────── */
        .page-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 0.25rem;
        }

        .page-subtitle {
            color: var(--text-muted);
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
        }

        /* ── STATS CARDS ─────────────────────────── */
        .stat-card {
            background: white;
            border-radius: 14px;
            padding: 1.25rem 1.5rem;
            box-shadow: 0 2px 12px rgba(15,31,69,.07);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .stat-icon.pink  { background: var(--pink-pale);  color: var(--pink); }
        .stat-icon.navy  { background: #e8edf8;           color: var(--navy); }
        .stat-icon.green { background: #f0fdf4;           color: #16a34a; }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--navy);
            font-family: 'Plus Jakarta Sans', sans-serif;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        /* ── MODAL ───────────────────────────────── */
        .modal-content {
            border: none;
            border-radius: 16px;
            overflow: hidden;
        }

        .modal-header {
            background: var(--navy);
            color: white;
            border: none;
            padding: 1rem 1.5rem;
        }

        .modal-header .btn-close {
            filter: invert(1);
            opacity: 0.7;
        }

        .modal-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 1rem;
        }

        .modal-footer {
            border-top: 1px solid var(--gray-200);
            padding: 1rem 1.5rem;
        }

        /* ── SEARCH ──────────────────────────────── */
        .search-box {
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .search-box input {
            padding-left: 2.2rem;
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            font-size: 0.875rem;
        }

        /* ── PAGINATION ──────────────────────────── */
        .pagination .page-link {
            border-radius: 8px;
            border: 1.5px solid #e2e8f0;
            color: var(--navy);
            font-size: 0.83rem;
            margin: 0 2px;
            padding: 0.35rem 0.75rem;
        }

        .pagination .page-item.active .page-link {
            background: var(--pink);
            border-color: var(--pink);
        }

        .pagination .page-link:hover {
            background: var(--pink-pale);
            border-color: var(--pink);
            color: var(--pink);
        }

        /* ── RESPONSIVE ──────────────────────────── */
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { padding: 1rem; }
        }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar-main">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between">
            <a class="navbar-brand" href="{{ route('products.index') }}">
                <span class="brand-icon"><i class="bi bi-shop"></i></span>
                TokoCimar<span class="brand-dot">.</span>
            </a>

            <div class="d-flex align-items-center gap-3">
                @if(session('user'))
                    <span class="nav-user-info d-none d-md-block">
                        Halo, <strong>{{ session('user.name') }}</strong> 👋
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-logout">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</nav>

<div class="page-wrapper">
    {{-- SIDEBAR --}}
    @if(session('user'))
    <aside class="sidebar">
        <div class="menu-label mb-3">Menu Utama</div>
        <nav>
            </a>
            <a href="{{ route('products.index') }}"
               class="nav-link {{ request()->routeIs('products.index') && !request()->is('products/create') ? 'active' : '' }}">
                 <i class="bi bi-box-seam"></i> Produk
            </a>
            <a href="{{ route('products.create') }}"
               class="nav-link {{ request()->routeIs('products.create') ? 'active' : '' }}">
                 <i class="bi bi-plus-square"></i> Tambah Produk
            </a>
        </nav>

        <div class="menu-label mt-4 mb-3">Info Toko</div>
        <div style="background:rgba(247,37,133,.1); border-radius:12px; padding:0.85rem; font-size:0.78rem; color:rgba(255,255,255,.6); line-height:1.6;">
            <div class="fw-bold" style="color:var(--pink-light); margin-bottom:4px;">
                <i class="bi bi-geo-alt"></i> Toko Pak Cik & Aimar
            </div>
            Pekalongan<br>
            📞 2311102158
        </div>
    </aside>
    @endif

    {{-- MAIN CONTENT --}}
    <main class="main-content">
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert-success-custom d-flex align-items-center gap-2 mb-3">
                <i class="bi bi-check-circle-fill text-success"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert-danger-custom d-flex align-items-center gap-2 mb-3">
                <i class="bi bi-exclamation-circle-fill text-danger"></i>
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@yield('scripts')
</body>
</html>
