<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Inventori Toko - Kelola stok dan produk toko Anda dengan mudah">
    <title>@yield('title', 'Dashboard') — Inventori Toko</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --blue-900: #001a6e;
            --blue-800: #00237a;
            --blue-700: #003092;
            --blue-600: #0047ba;
            --blue-500: #1a5fc8;
            --blue-100: #dbeafe;
            --red-600:  #dc2626;
            --red-500:  #ef4444;
            --red-400:  #f87171;
            --red-100:  #fee2e2;
            --gray-50:  #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --white:    #ffffff;
            --success:  #16a34a;
            --warning:  #d97706;
            --sidebar-w: 260px;
            --header-h: 64px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--gray-100);
            color: var(--gray-800);
            min-height: 100vh;
            display: flex;
        }

        /* ═══════════ SIDEBAR ═══════════ */
        .sidebar {
            width: var(--sidebar-w);
            background: linear-gradient(180deg, var(--blue-900) 0%, var(--blue-800) 40%, #001560 100%);
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            box-shadow: 4px 0 20px rgba(0,0,0,0.25);
        }

        .sidebar-brand {
            padding: 0 20px;
            height: var(--header-h);
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-decoration: none;
        }

        .brand-icon {
            width: 38px; height: 38px;
            background: var(--red-600);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(220,38,38,0.5);
        }

        .brand-text { color: white; }
        .brand-text .brand-name { font-size: 15px; font-weight: 700; line-height: 1.2; }
        .brand-text .brand-sub  { font-size: 11px; opacity: 0.6; font-weight: 400; }

        .sidebar-nav { padding: 16px 12px; flex: 1; }

        .nav-section-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.1em;
            color: rgba(255,255,255,0.35);
            text-transform: uppercase;
            padding: 8px 10px 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 10px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: 2px;
        }

        .nav-item:hover {
            background: rgba(255,255,255,0.1);
            color: white;
        }

        .nav-item.active {
            background: var(--red-600);
            color: white;
            box-shadow: 0 4px 15px rgba(220,38,38,0.4);
        }

        .nav-item .nav-icon {
            width: 20px;
            text-align: center;
            font-size: 15px;
        }

        .nav-badge {
            margin-left: auto;
            background: rgba(255,255,255,0.2);
            color: white;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 20px;
        }

        .nav-item.active .nav-badge {
            background: rgba(255,255,255,0.3);
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            background: rgba(255,255,255,0.07);
            margin-bottom: 8px;
        }

        .user-avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--red-600), var(--blue-500));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .user-detail .user-name  { font-size: 13px; font-weight: 600; color: white; }
        .user-detail .user-email { font-size: 11px; color: rgba(255,255,255,0.5); }

        .btn-logout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 9px;
            background: rgba(220,38,38,0.15);
            border: 1px solid rgba(220,38,38,0.3);
            color: var(--red-400);
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-logout:hover {
            background: var(--red-600);
            color: white;
            border-color: var(--red-600);
        }

        /* ═══════════ MAIN ═══════════ */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            height: var(--header-h);
            background: white;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 1px 8px rgba(0,0,0,0.06);
        }

        .page-breadcrumb { display: flex; flex-direction: column; gap: 2px; }
        .page-title { font-size: 17px; font-weight: 700; color: var(--gray-800); }
        .breadcrumb-path { font-size: 12px; color: var(--gray-400); }

        .topbar-right { display: flex; align-items: center; gap: 12px; }

        .topbar-time {
            font-size: 12px;
            color: var(--gray-400);
            font-weight: 500;
        }

        .main-content { padding: 28px; flex: 1; }

        /* ═══════════ ALERTS ═══════════ */
        .alert {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .alert-success { background: #dcfce7; color: #166534; border: 1px solid #86efac; }
        .alert-error   { background: var(--red-100); color: #991b1b; border: 1px solid var(--red-400); }
        .alert-warning { background: #fef3c7; color: #92400e; border: 1px solid #fcd34d; }
        .alert-close { margin-left: auto; background: none; border: none; cursor: pointer; opacity: 0.6; font-size: 16px; }
        .alert-close:hover { opacity: 1; }

        /* ═══════════ CARDS ═══════════ */
        .card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--gray-200);
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        }

        .card-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .card-title { font-size: 15px; font-weight: 700; color: var(--gray-800); }
        .card-body  { padding: 24px; }

        /* ═══════════ STAT CARDS ═══════════ */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            border: 1px solid var(--gray-200);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.08); }

        .stat-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .stat-icon.blue   { background: var(--blue-100); color: var(--blue-600); }
        .stat-icon.green  { background: #dcfce7; color: #16a34a; }
        .stat-icon.yellow { background: #fef3c7; color: #d97706; }
        .stat-icon.red    { background: var(--red-100); color: var(--red-600); }

        .stat-value { font-size: 28px; font-weight: 800; color: var(--gray-900); line-height: 1; }
        .stat-label { font-size: 13px; color: var(--gray-500); margin-top: 4px; font-weight: 500; }

        /* ═══════════ BUTTONS ═══════════ */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-primary { background: var(--blue-700); color: white; }
        .btn-primary:hover { background: var(--blue-900); box-shadow: 0 4px 12px rgba(0,71,186,0.35); }

        .btn-red { background: var(--red-600); color: white; }
        .btn-red:hover { background: #b91c1c; box-shadow: 0 4px 12px rgba(220,38,38,0.35); }

        .btn-outline { background: white; color: var(--gray-700); border: 1px solid var(--gray-300); }
        .btn-outline:hover { background: var(--gray-50); border-color: var(--gray-400); }

        .btn-success { background: var(--success); color: white; }
        .btn-success:hover { background: #15803d; }

        .btn-sm { padding: 6px 12px; font-size: 12px; border-radius: 8px; }
        .btn-xs { padding: 5px 10px; font-size: 11px; border-radius: 7px; }

        /* ═══════════ TABLE ═══════════ */
        .table-wrapper { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; }

        thead tr { background: var(--gray-50); }

        thead th {
            padding: 12px 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid var(--gray-200);
            white-space: nowrap;
        }

        thead th a {
            color: inherit;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        thead th a:hover { color: var(--blue-600); }

        tbody tr {
            border-bottom: 1px solid var(--gray-100);
            transition: background 0.15s;
        }

        tbody tr:hover { background: var(--gray-50); }

        tbody td {
            padding: 13px 16px;
            font-size: 14px;
            color: var(--gray-700);
            vertical-align: middle;
        }

        .product-info { display: flex; align-items: center; gap: 12px; }

        .product-thumb {
            width: 44px; height: 44px;
            border-radius: 10px;
            object-fit: cover;
            background: var(--gray-100);
            flex-shrink: 0;
        }

        .product-thumb-placeholder {
            width: 44px; height: 44px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--blue-100), var(--blue-600));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            flex-shrink: 0;
        }

        .product-name  { font-weight: 600; color: var(--gray-800); font-size: 14px; }
        .product-sku   { font-size: 11px; color: var(--gray-400); font-weight: 500; margin-top: 2px; }

        /* ═══════════ BADGES ═══════════ */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }

        .badge-success { background: #dcfce7; color: #166534; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-danger  { background: var(--red-100); color: #991b1b; }
        .badge-info    { background: var(--blue-100); color: var(--blue-700); }
        .badge-gray    { background: var(--gray-100); color: var(--gray-600); }

        /* ═══════════ FORM ═══════════ */
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 13px; font-weight: 600; color: var(--gray-700); margin-bottom: 6px; }
        .form-label .required { color: var(--red-500); margin-left: 2px; }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--gray-200);
            border-radius: 10px;
            font-size: 14px;
            color: var(--gray-800);
            font-family: 'Inter', sans-serif;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--blue-600);
            box-shadow: 0 0 0 3px rgba(0,71,186,0.12);
        }

        .form-control.is-invalid { border-color: var(--red-500); }
        .form-control.is-invalid:focus { box-shadow: 0 0 0 3px rgba(239,68,68,0.12); }

        .invalid-feedback { font-size: 12px; color: var(--red-500); margin-top: 4px; font-weight: 500; }

        .form-row { display: grid; gap: 16px; }
        .cols-2 { grid-template-columns: 1fr 1fr; }
        .cols-3 { grid-template-columns: 1fr 1fr 1fr; }

        /* ═══════════ PAGINATION ═══════════ */
        .pag-wrap { display: flex; align-items: center; justify-content: space-between; padding: 16px 0 0; }
        .pag-info  { font-size: 13px; color: var(--gray-500); }

        .pag-links { display: flex; gap: 4px; }

        .pag-links a, .pag-links span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px; height: 36px;
            padding: 0 10px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.15s;
        }

        .pag-links a { color: var(--gray-600); border: 1px solid var(--gray-200); background: white; }
        .pag-links a:hover { border-color: var(--blue-600); color: var(--blue-600); background: var(--blue-100); }
        .pag-links span.active { background: var(--blue-700); color: white; border: 1px solid var(--blue-700); }
        .pag-links span.disabled { color: var(--gray-300); border: 1px solid var(--gray-200); background: white; }

        /* ═══════════ MODAL ═══════════ */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(4px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.open { display: flex; }

        .modal-box {
            background: white;
            border-radius: 20px;
            padding: 32px;
            max-width: 420px;
            width: 90%;
            box-shadow: 0 25px 60px rgba(0,0,0,0.3);
            animation: modalIn 0.25s ease;
            text-align: center;
        }

        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.92) translateY(20px); }
            to   { opacity: 1; transform: scale(1) translateY(0); }
        }

        .modal-icon {
            width: 72px; height: 72px;
            background: var(--red-100);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: var(--red-600);
            margin: 0 auto 20px;
        }

        .modal-title { font-size: 20px; font-weight: 800; color: var(--gray-900); margin-bottom: 8px; }
        .modal-desc  { font-size: 14px; color: var(--gray-500); margin-bottom: 24px; line-height: 1.6; }
        .modal-product-name { font-weight: 700; color: var(--gray-800); }
        .modal-actions { display: flex; gap: 12px; justify-content: center; }

        /* ═══════════ SEARCH BAR ═══════════ */
        .search-bar {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-input-wrap {
            position: relative;
            flex: 1;
            min-width: 200px;
        }

        .search-input-wrap i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 14px;
        }

        .search-input-wrap input {
            padding-left: 36px;
        }

        .filter-select {
            padding: 10px 14px;
            border: 1.5px solid var(--gray-200);
            border-radius: 10px;
            font-size: 13px;
            color: var(--gray-700);
            background: white;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            min-width: 140px;
        }

        .filter-select:focus { outline: none; border-color: var(--blue-600); }

        /* ═══════════ RESPONSIVE ═══════════ */
        @media (max-width: 1024px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-wrapper { margin-left: 0; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .cols-2, .cols-3 { grid-template-columns: 1fr; }
        }

        /* ═══════════ UTILITIES ═══════════ */
        .text-muted { color: var(--gray-400); }
        .fw-bold    { font-weight: 700; }
        .price-text { font-weight: 700; color: var(--blue-700); }
        .action-group { display: flex; gap: 6px; }
        .empty-state { text-align: center; padding: 60px 20px; color: var(--gray-400); }
        .empty-state i { font-size: 48px; margin-bottom: 16px; opacity: 0.4; }
        .empty-state p { font-size: 14px; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
    <a href="{{ route('products.index') }}" class="sidebar-brand">
        <div class="brand-icon"><i class="fas fa-store"></i></div>
        <div class="brand-text">
            <div class="brand-name">Inventori Toko</div>
            <div class="brand-sub">Sistem Manajemen</div>
        </div>
    </a>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Menu Utama</div>
        <a href="{{ route('products.index') }}" class="nav-item {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-box-open"></i></span>
            Produk
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">{{ strtoupper(substr(session('user_name', 'A'), 0, 1)) }}</div>
            <div class="user-detail">
                <div class="user-name">{{ session('user_name', 'Admin') }}</div>
                <div class="user-email">{{ session('user_email', '') }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</aside>

<!-- MAIN WRAPPER -->
<div class="main-wrapper">
    <header class="topbar">
        <div class="page-breadcrumb">
            <div class="page-title">@yield('page-title', 'Dashboard')</div>
            <div class="breadcrumb-path">Inventori Toko &rsaquo; @yield('page-title', 'Dashboard')</div>
        </div>
        <div class="topbar-right">
            <span class="topbar-time" id="js-clock"></span>
        </div>
    </header>

    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success" id="auto-alert">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
                <button class="alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error" id="auto-alert">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
                <button class="alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
            </div>
        @endif

        @yield('content')
    </main>
</div>

<script>
    // Clock
    function updateClock() {
        const now = new Date();
        const opts = { weekday:'short', day:'numeric', month:'short', hour:'2-digit', minute:'2-digit' };
        const el = document.getElementById('js-clock');
        if (el) el.textContent = now.toLocaleDateString('id-ID', opts);
    }
    updateClock();
    setInterval(updateClock, 60000);

    // Auto dismiss alert
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(a => {
            a.style.transition = 'opacity 0.5s';
            a.style.opacity = '0';
            setTimeout(() => a.remove(), 500);
        });
    }, 4000);
</script>

@yield('scripts')
</body>
</html>
