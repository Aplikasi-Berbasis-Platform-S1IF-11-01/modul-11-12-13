<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Inventaris') — Toko Pak Cik & Mas Aimar</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary:    #2563eb;
            --primary-dk: #1d4ed8;
            --success:    #16a34a;
            --danger:     #dc2626;
            --warning:    #d97706;
            --sidebar-w:  260px;
            --topbar-h:   64px;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f1f5f9;
            margin: 0;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-w);
            height: 100vh;
            background: #fff;
            border-right: 1px solid #e2e8f0;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 1040;
        }

        .sidebar-brand {
            padding: 20px 20px 16px;
            border-bottom: 1px solid #f1f5f9;
        }
        .brand-icon {
            width: 40px; height: 40px;
            background: var(--primary);
            border-radius: 10px;
            display: grid; place-items: center;
            color: #fff; font-size: 20px;
            flex-shrink: 0;
        }
        .brand-text .brand-name {
            font-weight: 800;
            font-size: 15px;
            color: #0f172a;
            line-height: 1.2;
        }
        .brand-text .brand-sub {
            font-size: 11px;
            color: #94a3b8;
        }

        .sidebar-nav { flex: 1; padding: 12px 12px; overflow-y: auto; }

        .nav-section-title {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #94a3b8;
            padding: 12px 12px 6px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 8px;
            color: #475569;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all .15s;
        }
        .sidebar-link:hover { background: #f8fafc; color: #0f172a; }
        .sidebar-link.active { background: #eff6ff; color: var(--primary); font-weight: 600; }
        .sidebar-link i { font-size: 18px; flex-shrink: 0; }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid #f1f5f9;
        }
        .user-card {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            background: #f8fafc;
        }
        .user-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: var(--primary);
            color: #fff;
            display: grid; place-items: center;
            font-size: 14px; font-weight: 700;
            flex-shrink: 0;
        }
        .user-name { font-size: 13px; font-weight: 600; color: #0f172a; }
        .user-role { font-size: 11px; color: #94a3b8; }

        /* ── Topbar ── */
        .topbar {
            height: var(--topbar-h);
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            position: fixed;
            top: 0;
            left: var(--sidebar-w);
            right: 0;
            z-index: 1030;
            display: flex;
            align-items: center;
            padding: 0 24px;
            justify-content: space-between;
        }
        .page-title { font-size: 18px; font-weight: 700; color: #0f172a; }
        .page-breadcrumb { font-size: 13px; color: #94a3b8; }

        /* ── Main Content ── */
        .main-content {
            margin-left: var(--sidebar-w);
            margin-top: var(--topbar-h);
            padding: 28px;
            min-height: calc(100vh - var(--topbar-h));
        }

        /* ── Cards ── */
        .card {
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 1px 3px rgba(0,0,0,.06);
        }
        .card-header {
            background: #fff;
            border-bottom: 1px solid #f1f5f9;
            border-radius: 14px 14px 0 0 !important;
            padding: 16px 20px;
        }

        /* ── Stats Cards ── */
        .stat-card {
            border-radius: 14px;
            padding: 20px;
            border: 1px solid #e2e8f0;
            background: #fff;
        }
        .stat-icon {
            width: 44px; height: 44px;
            border-radius: 10px;
            display: grid; place-items: center;
            font-size: 20px;
        }

        /* ── Table ── */
        .table thead th {
            background: #f8fafc;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #64748b;
            border-bottom: 1px solid #e2e8f0;
            padding: 12px 16px;
        }
        .table tbody td {
            padding: 13px 16px;
            vertical-align: middle;
            font-size: 14px;
            color: #334155;
            border-color: #f1f5f9;
        }
        .table tbody tr:hover { background: #fafbff; }

        /* ── Badges ── */
        .badge-category {
            background: #eff6ff;
            color: var(--primary);
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
        }
        .stock-ok    { color: var(--success); font-weight: 600; }
        .stock-low   { color: var(--warning); font-weight: 600; }
        .stock-empty { color: var(--danger);  font-weight: 600; }

        /* ── Buttons ── */
        .btn-primary { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: var(--primary-dk); border-color: var(--primary-dk); }
        .btn { border-radius: 8px; font-weight: 500; font-size: 14px; }
        .btn-sm { font-size: 13px; }

        /* ── Form Controls ── */
        .form-control, .form-select {
            border-radius: 8px;
            border-color: #e2e8f0;
            font-size: 14px;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37,99,235,.1);
        }
        .form-label { font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 5px; }

        /* ── Alert ── */
        .alert { border-radius: 10px; font-size: 14px; border: none; }
        .alert-success { background: #f0fdf4; color: var(--success); }
        .alert-danger  { background: #fef2f2; color: var(--danger); }

        /* ── Pagination ── */
        .page-link { color: var(--primary); border-radius: 8px !important; margin: 0 2px; font-size: 13px; }
        .page-item.active .page-link { background: var(--primary); border-color: var(--primary); }

        /* ── Empty State ── */
        .empty-state { text-align: center; padding: 60px 20px; color: #94a3b8; }
        .empty-state i { font-size: 56px; margin-bottom: 16px; display: block; }

        /* ── Mobile responsive ── */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: transform .3s; }
            .sidebar.open { transform: translateX(0); }
            .topbar { left: 0; }
            .main-content { margin-left: 0; padding: 16px; }
            .overlay { display: block; }
        }

        .overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,.4);
            z-index: 1039;
        }
    </style>

    @stack('styles')
</head>
<body>

{{-- Sidebar --}}
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand d-flex align-items-center gap-2">
        <div class="brand-icon"><i class="bi bi-shop"></i></div>
        <div class="brand-text">
            <div class="brand-name">Toko Pak Cik</div>
            <div class="brand-sub">& Mas Aimar</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-title">Menu</div>
        <a href="{{ route('products.index') }}" class="sidebar-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i>
            Inventaris Produk
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-card">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div class="flex-grow-1 overflow-hidden">
                <div class="user-name text-truncate">{{ Auth::user()->name }}</div>
                <div class="user-role">{{ Auth::user()->email }}</div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger border-0 p-1" title="Logout">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
</aside>

{{-- Overlay mobile --}}
<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

{{-- Topbar --}}
<header class="topbar">
    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-sm d-md-none" onclick="toggleSidebar()">
            <i class="bi bi-list fs-5"></i>
        </button>
        <div>
            <div class="page-title">@yield('page-title', 'Dashboard')</div>
        </div>
    </div>
    <div class="d-flex align-items-center gap-2">
        <span class="d-none d-md-inline text-muted" style="font-size:13px">
            Halo, <strong>{{ Auth::user()->name }}</strong> 👋
        </span>
    </div>
</header>

{{-- Main Content --}}
<main class="main-content">

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2 mb-4" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger d-flex align-items-center gap-2 mb-4" role="alert">
            <i class="bi bi-exclamation-circle-fill"></i>
            {{ session('error') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</main>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('overlay').style.display = 'block';
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('overlay').style.display = 'none';
    }

    // Auto dismiss alert after 5s
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => {
            const bsAlert = bootstrap.Alert.getOrCreateInstance(el);
            bsAlert.close();
        });
    }, 5000);
</script>

@stack('scripts')
</body>
</html>
