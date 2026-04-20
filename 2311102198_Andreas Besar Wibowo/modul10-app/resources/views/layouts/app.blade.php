<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Inventaris') — Toko Andreas & Viani</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Sora:wght@400;600;700&display=swap"
        rel="stylesheet">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #1a56db;
            --primary-light: #e8f0fe;
            --primary-dark: #1239a5;
            --accent: #f59e0b;
            --accent-light: #fef3c7;
            --success: #059669;
            --danger: #dc2626;
            --sidebar-w: 260px;
            --sidebar-bg: #0f172a;
            --topbar-h: 64px;
            --body-bg: #f1f5f9;
            --card-radius: 14px;
            --font-main: 'Plus Jakarta Sans', sans-serif;
            --font-brand: 'Sora', sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-main);
            background: var(--body-bg);
            color: #1e293b;
            min-height: 100vh;
        }

        /* ── SIDEBAR ─────────────────────────────── */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
        }

        .sidebar-brand .brand-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 12px;
        }

        .sidebar-brand .brand-title {
            font-family: var(--font-brand);
            font-size: 15px;
            font-weight: 700;
            color: #fff;
            line-height: 1.3;
        }

        .sidebar-brand .brand-sub {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.4);
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .sidebar-nav {
            padding: 16px 12px;
            flex: 1;
        }

        .nav-label {
            font-size: 10px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.3);
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0 8px;
            margin: 16px 0 8px;
        }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            color: rgba(255, 255, 255, 0.65);
            font-size: 13.5px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            margin-bottom: 2px;
        }

        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link.active {
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
        }

        .sidebar-nav .nav-link.active {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 4px 14px rgba(26, 86, 219, 0.4);
        }

        .sidebar-nav .nav-link i {
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255, 255, 255, 0.07);
        }

        .user-card {
            background: rgba(255, 255, 255, 0.06);
            border-radius: 10px;
            padding: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--accent), #fb923c);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            color: #fff;
            flex-shrink: 0;
        }

        .user-info .user-name {
            font-size: 13px;
            font-weight: 600;
            color: #fff;
        }

        .user-info .user-role {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.4);
        }

        /* ── MAIN CONTENT ─────────────────────────── */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── TOPBAR ─────────────────────────────── */
        .topbar {
            height: var(--topbar-h);
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            padding: 0 28px;
            gap: 16px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar .page-title {
            font-size: 17px;
            font-weight: 700;
            color: #1e293b;
            flex: 1;
        }

        .topbar .btn-logout {
            background: none;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 6px 14px;
            font-size: 13px;
            color: #64748b;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            font-family: var(--font-main);
            transition: all 0.2s;
        }

        .topbar .btn-logout:hover {
            border-color: var(--danger);
            color: var(--danger);
            background: #fef2f2;
        }

        /* ── PAGE CONTENT ─────────────────────────── */
        .page-content {
            padding: 28px;
            flex: 1;
        }

        /* ── CARDS ─────────────────────────────── */
        .card {
            border: none;
            border-radius: var(--card-radius);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid #f1f5f9;
            padding: 18px 22px;
            border-radius: var(--card-radius) var(--card-radius) 0 0 !important;
        }

        /* ── STAT CARDS ─────────────────────────── */
        .stat-card {
            background: #fff;
            border-radius: var(--card-radius);
            padding: 20px 22px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .stat-icon.blue {
            background: var(--primary-light);
            color: var(--primary);
        }

        .stat-icon.green {
            background: #d1fae5;
            color: var(--success);
        }

        .stat-icon.yellow {
            background: var(--accent-light);
            color: var(--accent);
        }

        .stat-icon.red {
            background: #fee2e2;
            color: var(--danger);
        }

        .stat-val {
            font-size: 24px;
            font-weight: 800;
            line-height: 1;
            color: #1e293b;
        }

        .stat-label {
            font-size: 12px;
            color: #94a3b8;
            font-weight: 500;
            margin-top: 4px;
        }

        /* ── TABLE ─────────────────────────────── */
        .table-hover tbody tr:hover {
            background: #f8fafc;
        }

        .table thead th {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #64748b;
            border-bottom: 2px solid #e2e8f0;
            padding: 12px 16px;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 13px 16px;
            vertical-align: middle;
            border-color: #f1f5f9;
            font-size: 13.5px;
        }

        /* ── BADGES ─────────────────────────────── */
        .badge-category {
            background: var(--primary-light);
            color: var(--primary);
            font-weight: 600;
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .stock-low {
            color: var(--danger);
            font-weight: 700;
        }

        .stock-ok {
            color: var(--success);
            font-weight: 600;
        }

        /* ── BUTTONS ─────────────────────────────── */
        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
            font-weight: 600;
            font-size: 13.5px;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-action {
            padding: 5px 10px;
            font-size: 13px;
            border-radius: 7px;
        }

        /* ── ALERTS ─────────────────────────────── */
        .alert {
            border: none;
            border-radius: 10px;
            font-size: 14px;
        }

        /* ── FORMS ─────────────────────────────── */
        .form-label {
            font-weight: 600;
            font-size: 13.5px;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-control,
        .form-select {
            border-color: #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            padding: 9px 12px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(26, 86, 219, 0.1);
        }

        /* ── RESPONSIVE ─────────────────────────── */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .page-content {
                padding: 16px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- ════ SIDEBAR ════ --}}
    <aside class="sidebar" id="sidebar">
        {{-- Brand --}}
        <div class="sidebar-brand">
            <div class="brand-icon">🏪</div>
            <div class="brand-title">Andreas & Viani</div>
            <div class="brand-sub">Sistem Inventaris Toko</div>
        </div>

        {{-- Navigation --}}
        <nav class="sidebar-nav">
            <div class="nav-label">Menu Utama</div>
            <a href="{{ route('products.index') }}"
                class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i>
                Manajemen Produk
            </a>

            <div class="nav-label">Statistik</div>
            <a href="{{ route('products.index') }}?category=Sembako" class="nav-link">
                <i class="bi bi-grid-3x3-gap"></i>
                Sembako
            </a>
            <a href="{{ route('products.index') }}?category=Minuman" class="nav-link">
                <i class="bi bi-cup-straw"></i>
                Minuman
            </a>
            <a href="{{ route('products.index') }}?category=Kebersihan" class="nav-link">
                <i class="bi bi-stars"></i>
                Kebersihan
            </a>
            <a href="{{ route('products.index') }}?category=Snack" class="nav-link">
                <i class="bi bi-egg-fried"></i>
                Snack
            </a>
        </nav>

        {{-- User Card --}}
        <div class="sidebar-footer">
            <div class="user-card">
                <div class="user-avatar">
                    {{ strtoupper(substr(session('auth_user.name', 'A'), 0, 1)) }}
                </div>
                <div class="user-info">
                    <div class="user-name">{{ session('auth_user.name', 'User') }}</div>
                    <div class="user-role">Pengelola Toko</div>
                </div>
            </div>
        </div>
    </aside>

    {{-- ════ MAIN WRAPPER ════ --}}
    <div class="main-wrapper">

        {{-- Topbar --}}
        <header class="topbar">
            <button class="btn btn-sm btn-outline-secondary d-md-none me-2" id="toggleSidebar">
                <i class="bi bi-list"></i>
            </button>
            <div class="page-title">@yield('page-title', 'Dashboard')</div>

            {{-- Logout --}}
            <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                @csrf
                <button type="submit" class="btn-logout" onclick="return confirm('Yakin ingin logout?')">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </form>
        </header>

        {{-- Flash Messages --}}
        <div class="px-4 pt-3">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>

        {{-- Page Content --}}
        <main class="page-content">
            @yield('content')
        </main>
    </div>

    {{-- Bootstrap 5 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle sidebar mobile
        document.getElementById('toggleSidebar')?.addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('show');
        });

        // Auto hide alert after 4s
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(el => {
                const bsAlert = bootstrap.Alert.getOrCreateInstance(el);
                bsAlert.close();
            });
        }, 4000);
    </script>

    @stack('scripts')
</body>

</html>