<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Inventaris Toko') — Pak Cik & Mas Aimar</title>

    <!-- Google Fonts: Syne (display) + DM Sans (body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <style>
        :root {
            --primary: #1a1a2e;
            --accent: #e94560;
            --accent-light: #ff6b6b;
            --sidebar-w: 260px;
            --font-display: 'Syne', sans-serif;
            --font-body: 'DM Sans', sans-serif;
        }

        * { box-sizing: border-box; }

        body {
            font-family: var(--font-body);
            background: #f0f2f5;
            color: #1a1a2e;
            margin: 0;
        }

        /* ── Sidebar ── */
        #sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--primary);
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: transform .3s ease;
        }

        .sidebar-brand {
            padding: 28px 24px 24px;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }

        .sidebar-brand h1 {
            font-family: var(--font-display);
            font-size: 1.35rem;
            font-weight: 800;
            color: #fff;
            margin: 0;
            line-height: 1.2;
        }

        .sidebar-brand span {
            display: block;
            font-family: var(--font-body);
            font-size: .75rem;
            font-weight: 400;
            color: rgba(255,255,255,.45);
            margin-top: 4px;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .sidebar-brand .brand-icon {
            width: 40px; height: 40px;
            background: var(--accent);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 12px;
            font-size: 1.2rem;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }

        .nav-label {
            font-size: .68rem;
            font-weight: 600;
            color: rgba(255,255,255,.3);
            text-transform: uppercase;
            letter-spacing: .1em;
            padding: 12px 12px 6px;
        }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            color: rgba(255,255,255,.6);
            font-size: .9rem;
            font-weight: 500;
            transition: all .2s;
            margin-bottom: 2px;
            text-decoration: none;
        }

        .sidebar-nav .nav-link:hover {
            background: rgba(255,255,255,.07);
            color: #fff;
        }

        .sidebar-nav .nav-link.active {
            background: var(--accent);
            color: #fff;
        }

        .sidebar-nav .nav-link i {
            font-size: 1.05rem;
            width: 20px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,.08);
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            background: rgba(255,255,255,.06);
        }

        .user-avatar {
            width: 36px; height: 36px;
            background: var(--accent);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700;
            font-size: .85rem;
            color: #fff;
            flex-shrink: 0;
        }

        .user-info .name {
            font-size: .85rem;
            font-weight: 600;
            color: #fff;
            line-height: 1.2;
        }

        .user-info .role {
            font-size: .72rem;
            color: rgba(255,255,255,.4);
        }

        .logout-btn {
            background: none;
            border: none;
            color: rgba(255,255,255,.4);
            padding: 4px 6px;
            cursor: pointer;
            border-radius: 6px;
            transition: all .2s;
            margin-left: auto;
        }

        .logout-btn:hover {
            color: var(--accent);
            background: rgba(233,69,96,.1);
        }

        /* ── Main Content ── */
        #main-content {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Top Bar ── */
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e8eaed;
            padding: 14px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-title {
            font-family: var(--font-display);
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
            margin: 0;
        }

        .topbar-subtitle {
            font-size: .8rem;
            color: #888;
            margin: 0;
        }

        /* ── Page Content ── */
        .page-content {
            padding: 28px 32px;
            flex: 1;
        }

        /* ── Cards ── */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,.08), 0 1px 2px rgba(0,0,0,.04);
        }

        .stat-card {
            border-radius: 16px;
            padding: 20px 24px;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: -20px; right: -20px;
            width: 80px; height: 80px;
            border-radius: 50%;
            background: rgba(255,255,255,.1);
        }

        .stat-card .stat-icon {
            font-size: 1.6rem;
            margin-bottom: 12px;
            display: block;
        }

        .stat-card .stat-value {
            font-family: var(--font-display);
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-card .stat-label {
            font-size: .8rem;
            color: rgba(255,255,255,.75);
            font-weight: 500;
        }

        /* ── Alert Flash Messages ── */
        .flash-container {
            position: fixed;
            top: 20px; right: 20px;
            z-index: 9999;
            min-width: 300px;
        }

        .flash-alert {
            border-radius: 12px;
            border: none;
            font-size: .9rem;
            padding: 14px 18px;
            box-shadow: 0 4px 20px rgba(0,0,0,.12);
            animation: slideInRight .3s ease;
        }

        @keyframes slideInRight {
            from { transform: translateX(100px); opacity: 0; }
            to   { transform: translateX(0); opacity: 1; }
        }

        /* ── Buttons ── */
        .btn-primary {
            background: var(--accent);
            border-color: var(--accent);
            font-weight: 600;
            border-radius: 10px;
            padding: 8px 18px;
        }

        .btn-primary:hover {
            background: #c73652;
            border-color: #c73652;
        }

        .btn-outline-primary {
            color: var(--accent);
            border-color: var(--accent);
            border-radius: 10px;
        }

        .btn-outline-primary:hover {
            background: var(--accent);
            border-color: var(--accent);
        }

        /* ── DataTable override ── */
        .dataTables_wrapper .dataTables_filter input {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 6px 12px;
        }

        .dataTables_wrapper .dataTables_length select {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 4px 8px;
        }

        table.dataTable tbody tr:hover {
            background: #f8f9ff !important;
        }

        .table thead th {
            font-weight: 600;
            font-size: .85rem;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: .04em;
            border-bottom: 2px solid #e8eaed;
        }

        /* ── Badge ── */
        .badge {
            font-size: .75rem;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 6px;
        }

        /* ── Form ── */
        .form-control, .form-select {
            border-radius: 10px;
            border: 1.5px solid #e8eaed;
            padding: 10px 14px;
            font-size: .9rem;
            transition: border-color .2s, box-shadow .2s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(233,69,96,.12);
        }

        .form-label {
            font-weight: 600;
            font-size: .85rem;
            color: #374151;
            margin-bottom: 6px;
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.show { transform: translateX(0); }
            #main-content { margin-left: 0; }
            .page-content { padding: 16px; }
            .topbar { padding: 12px 16px; }
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- ============ SIDEBAR ============ -->
    <nav id="sidebar">
        <div class="sidebar-brand">
            <h1>Toko Inventaris</h1>
            <span>Rizal Dwi Anggoro - 2311102034</span>
        </div>

        <div class="sidebar-nav">
            <div class="nav-label">Menu</div>

            <a href="{{ route('products.index') }}"
               class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i>
                Produk
            </a>

            <a href="{{ route('products.create') }}"
               class="nav-link {{ request()->routeIs('products.create') ? 'active' : '' }}">
                <i class="bi bi-plus-circle"></i>
                Tambah Produk
            </a>
        </div>

        <div class="sidebar-footer">
            <div class="user-card">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="user-info">
                    <div class="name">{{ auth()->user()->name }}</div>
                    <div class="role">Administrator</div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn" title="Logout">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- ============ MAIN CONTENT ============ -->
    <div id="main-content">

        <!-- Top Bar -->
        <div class="topbar">
            <div>
                <p class="topbar-title mb-0">@yield('page-title', 'Dashboard')</p>
                <p class="topbar-subtitle">@yield('page-subtitle', 'Selamat datang di sistem inventaris')</p>
            </div>

            <!-- Mobile hamburger -->
            <button class="btn btn-sm d-md-none" id="sidebarToggle">
                <i class="bi bi-list fs-5"></i>
            </button>
        </div>

        <!-- Flash Messages -->
        <div class="flash-container">
            @if(session('success'))
                <div class="alert alert-success flash-alert alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger flash-alert alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info flash-alert alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>

        <!-- Page Content -->
        <main class="page-content">
            @yield('content')
        </main>

    </div>

    <!-- ============ SCRIPTS ============ -->
    <!-- Bootstrap 5 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery (required by DataTables) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap5.min.js"></script>

    <script>
        // Auto-dismiss flash messages after 4 seconds
        setTimeout(function() {
            document.querySelectorAll('.flash-alert').forEach(function(el) {
                var alert = bootstrap.Alert.getOrCreateInstance(el);
                alert.close();
            });
        }, 4000);

        // Mobile sidebar toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });
    </script>

    @stack('scripts')
</body>
</html>