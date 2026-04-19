<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Inventaris Toko') — TokoKu</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary:     #4361ee;
            --primary-dark:#3451d1;
            --secondary:   #f72585;
            --success:     #06d6a0;
            --warning:     #ffd166;
            --danger:      #ef476f;
            --sidebar-w:   260px;
            --sidebar-bg:  #1a1f36;
            --sidebar-txt: #ced4da;
        }

        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #f0f2f8;
            margin: 0;
        }

        /* ── Sidebar ── */
        #sidebar {
            position: fixed;
            top: 0; left: 0;
            height: 100vh;
            width: var(--sidebar-w);
            background: var(--sidebar-bg);
            z-index: 1040;
            display: flex;
            flex-direction: column;
            transition: transform .3s ease;
        }

        .sidebar-brand {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .sidebar-brand h5 {
            color: #fff;
            font-weight: 700;
            margin: 0;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .sidebar-brand .logo-icon {
            width: 34px; height: 34px;
            background: var(--primary);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: #fff;
            font-size: .95rem;
        }

        .sidebar-nav { flex: 1; padding: 1rem 0; overflow-y: auto; }
        .nav-label {
            padding: .35rem 1.25rem;
            font-size: .68rem;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: rgba(255,255,255,.3);
            margin-top: .5rem;
        }
        .sidebar-nav .nav-link {
            display: flex; align-items: center; gap: .75rem;
            padding: .65rem 1.25rem;
            color: var(--sidebar-txt);
            text-decoration: none;
            font-size: .875rem;
            border-radius: 0;
            transition: background .2s, color .2s;
        }
        .sidebar-nav .nav-link i { font-size: 1rem; width: 20px; text-align: center; }
        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link.active {
            background: rgba(255,255,255,.07);
            color: #fff;
        }
        .sidebar-nav .nav-link.active {
            border-left: 3px solid var(--primary);
            background: rgba(67,97,238,.15);
            color: #fff;
        }

        .sidebar-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid rgba(255,255,255,.08);
        }
        .user-card {
            display: flex; align-items: center; gap: .75rem;
        }
        .user-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: var(--primary);
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 700; font-size: .85rem;
            flex-shrink: 0;
        }
        .user-info { flex: 1; min-width: 0; }
        .user-info .name {
            color: #fff; font-size: .8rem; font-weight: 600;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .user-info .role { color: rgba(255,255,255,.4); font-size: .7rem; }

        /* ── Main content ── */
        #main-content {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex; flex-direction: column;
        }

        /* ── Topbar ── */
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e8eaf0;
            padding: .75rem 1.5rem;
            display: flex; align-items: center; gap: 1rem;
            position: sticky; top: 0; z-index: 100;
            box-shadow: 0 1px 4px rgba(0,0,0,.05);
        }
        .topbar .page-title {
            font-size: 1rem; font-weight: 600; color: #1a1f36;
            margin: 0; flex: 1;
        }

        /* ── Page body ── */
        .page-body { padding: 1.5rem; flex: 1; }

        /* ── Cards ── */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
        }
        .card-header {
            background: #fff; border-bottom: 1px solid #f0f2f8;
            border-radius: 12px 12px 0 0 !important;
            padding: 1rem 1.25rem;
        }

        /* ── Stat cards ── */
        .stat-card {
            border-radius: 12px; border: none; overflow: hidden;
        }
        .stat-card .stat-icon {
            width: 52px; height: 52px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
        }
        .stat-card .stat-number { font-size: 1.6rem; font-weight: 700; }

        /* ── Badge status ── */
        .badge-aktif    { background: #d1fae5; color: #065f46; }
        .badge-nonaktif { background: #fee2e2; color: #991b1b; }

        /* ── Stok badge ── */
        .stok-habis  { color: #ef476f; font-weight: 600; }
        .stok-tipis  { color: #f59e0b; font-weight: 600; }
        .stok-normal { color: #065f46; }

        /* ── DataTable override ── */
        .dataTables_wrapper .dataTables_filter input {
            border-radius: 6px; border: 1px solid #dee2e6; padding: .35rem .75rem;
        }
        .dataTables_wrapper .dataTables_length select {
            border-radius: 6px; border: 1px solid #dee2e6; padding: .2rem .5rem;
        }
        table.dataTable tbody tr:hover { background: #f8f9ff; }

        /* ── Form ── */
        .form-label { font-weight: 500; font-size: .875rem; color: #374151; }
        .form-control, .form-select {
            border-radius: 8px;
            border-color: #d1d5db;
            font-size: .875rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67,97,238,.15);
        }

        /* ── Buttons ── */
        .btn-primary   { background: var(--primary);  border-color: var(--primary); }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }
        .btn { border-radius: 8px; font-size: .875rem; font-weight: 500; }

        /* ── Alert ── */
        .alert { border-radius: 10px; border: none; }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.show { transform: translateX(0); }
            #main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- ── Sidebar ─────────────────────────────────────────────────────── -->
<nav id="sidebar">
    <div class="sidebar-brand">
        <h5>
            <span class="logo-icon"><i class="bi bi-shop"></i></span>
            TokoKu Inventaris
        </h5>
    </div>

    <div class="sidebar-nav">
        <div class="nav-label">Menu Utama</div>
        <a href="{{ route('dashboard') }}"
           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="nav-label">Inventaris</div>
        <a href="{{ route('products.index') }}"
           class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Kelola Produk
        </a>
        <a href="{{ route('products.create') }}"
           class="nav-link {{ request()->routeIs('products.create') ? 'active' : '' }}">
            <i class="bi bi-plus-circle"></i> Tambah Produk
        </a>
    </div>

    <div class="sidebar-footer">
        <div class="user-card">
            <div class="user-avatar">
                {{ strtoupper(substr(session('user_name', 'A'), 0, 1)) }}
            </div>
            <div class="user-info">
                <div class="name">{{ session('user_name') }}</div>
                <div class="role">Administrator</div>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="ms-auto">
                @csrf
                <button type="submit" class="btn btn-sm p-0 text-danger"
                    title="Logout" onclick="return confirm('Yakin ingin logout?')">
                    <i class="bi bi-box-arrow-right fs-5"></i>
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- ── Main Content ─────────────────────────────────────────────────── -->
<div id="main-content">
    <!-- Topbar -->
    <div class="topbar">
        <button class="btn btn-sm btn-light d-md-none me-1" id="sidebarToggle">
            <i class="bi bi-list fs-5"></i>
        </button>
        <h6 class="page-title">@yield('page-title', 'Dashboard')</h6>
        <div class="d-flex align-items-center gap-2">
            <span class="text-muted small d-none d-sm-inline">
                <i class="bi bi-calendar3 me-1"></i>
                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
            </span>
        </div>
    </div>

    <!-- Page Body -->
    <div class="page-body">

        {{-- Alert flash messages --}}
        @if(session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2 mb-3" role="alert">
            <i class="bi bi-check-circle-fill text-success"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger d-flex align-items-center gap-2 mb-3" role="alert">
            <i class="bi bi-x-circle-fill text-danger"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </div>
</div>

<!-- ── Scripts ──────────────────────────────────────────────────────── -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script>
    // Sidebar toggle (mobile)
    document.getElementById('sidebarToggle')?.addEventListener('click', () => {
        document.getElementById('sidebar').classList.toggle('show');
    });

    // Auto-dismiss alerts
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
