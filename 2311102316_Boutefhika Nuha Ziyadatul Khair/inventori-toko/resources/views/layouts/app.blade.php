<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Toko Inventory Aimar') — Inventory Toko</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    {{-- DataTables --}}
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --cream-50:  #fdfbf7;
            --cream-100: #f8f3e8;
            --cream-200: #f0e6d0;
            --cream-300: #e4d0b0;
            --cream-400: #c9a97a;
            --cream-500: #b08850;
            --cream-600: #8c6a38;
            --cream-700: #6b4f28;
            --cream-800: #4a3518;
            --brown-text: #3d2c14;
            --muted-text: #7a6148;
            --border:    #e0d0b8;
            --white:     #ffffff;
        }
        * { box-sizing: border-box; }
        body {
            background: var(--cream-100);
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--brown-text);
            font-size: 0.9rem;
        }

        /* Sidebar */
        .sidebar {
            width: 248px; min-height: 100vh;
            background: var(--cream-800);
            position: fixed; top: 0; left: 0; z-index: 100;
            display: flex; flex-direction: column;
        }
        .sidebar .brand {
            padding: 1.5rem 1.25rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,.07);
        }
        .sidebar .brand-icon {
            width: 38px; height: 38px; background: var(--cream-400);
            border-radius: 10px; display: flex; align-items: center; justify-content: center;
        }
        .sidebar .brand h5 {
            color: var(--cream-100); font-family: 'Playfair Display', serif;
            font-size: 1rem; font-weight: 700; margin: 0;
        }
        .sidebar .brand small { color: var(--cream-500); font-size: .7rem; }
        .sidebar-nav { padding: 1rem 0.75rem; flex: 1; }
        .sidebar-section-label {
            color: var(--cream-500); font-size: .62rem; font-weight: 600;
            text-transform: uppercase; letter-spacing: .1em;
            padding: .5rem .5rem .25rem;
        }
        .sidebar .nav-link {
            color: var(--cream-300); padding: .52rem .75rem;
            border-radius: 8px; margin: 1px 0; font-size: .84rem;
            display: flex; align-items: center; gap: 9px;
            transition: background .15s, color .15s;
        }
        .sidebar .nav-link i { font-size: .9rem; opacity: .8; }
        .sidebar .nav-link:hover { background: rgba(255,255,255,.06); color: var(--cream-100); }
        .sidebar .nav-link.active { background: var(--cream-600); color: var(--cream-50); }
        .sidebar .nav-link.active i { opacity: 1; }
        .sidebar-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid rgba(255,255,255,.07);
        }
        .sidebar-footer .user-name { color: var(--cream-200); font-size: .82rem; font-weight: 500; }
        .sidebar-footer .user-role { color: var(--cream-500); font-size: .7rem; }
        .btn-logout {
            background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.09);
            color: var(--cream-400); font-size: .78rem; border-radius: 7px;
            padding: .35rem .75rem; width: 100%; text-align: left; cursor: pointer;
            transition: background .15s;
        }
        .btn-logout:hover { background: rgba(255,255,255,.1); color: var(--cream-200); }

        /* Main */
        .main-content { margin-left: 248px; min-height: 100vh; }
        .topbar {
            background: var(--white); border-bottom: 1px solid var(--border);
            padding: .7rem 1.5rem; display: flex; align-items: center;
            justify-content: space-between; position: sticky; top: 0; z-index: 99;
        }
        .topbar .page-title {
            font-family: 'Playfair Display', serif; font-size: 1.05rem;
            font-weight: 600; color: var(--brown-text); margin: 0;
        }
        .page-wrapper { padding: 1.5rem; }

        /* Cards */
        .card { border: 1px solid var(--border) !important; border-radius: 12px !important; background: var(--white); box-shadow: 0 1px 3px rgba(61,44,20,.05); }
        .card-header { background: var(--cream-50) !important; border-bottom: 1px solid var(--border) !important; border-radius: 12px 12px 0 0 !important; font-weight: 500; color: var(--brown-text); font-size: .88rem; }

        /* Stat cards */
        .stat-icon { width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }

        /* Badges */
        .badge-stock-ok  { background: #eef7e8; color: #3a7d2a; }
        .badge-stock-low { background: #fdf6e3; color: #8a5a00; }
        .badge-stock-out { background: #fdf0f0; color: #b03030; }

        /* Buttons */
        .btn-primary { background: var(--cream-600) !important; border-color: var(--cream-600) !important; color: var(--cream-50) !important; font-weight: 500; }
        .btn-primary:hover { background: var(--cream-700) !important; border-color: var(--cream-700) !important; }
        .btn-outline-primary { color: var(--cream-600) !important; border-color: var(--cream-400) !important; }
        .btn-outline-primary:hover { background: var(--cream-600) !important; border-color: var(--cream-600) !important; color: #fff !important; }
        .btn-secondary { background: var(--cream-200) !important; border-color: var(--border) !important; color: var(--brown-text) !important; }
        .btn-secondary:hover { background: var(--cream-300) !important; }

        /* Table */
        .table { color: var(--brown-text); }
        .table thead th { background: var(--cream-50); color: var(--muted-text); font-weight: 500; font-size: .75rem; text-transform: uppercase; letter-spacing: .05em; border-bottom: 1px solid var(--border); }
        .table-hover tbody tr:hover { background: var(--cream-50); }

        /* Form */
        .form-control, .form-select { border-color: var(--border); color: var(--brown-text); background: var(--white); }
        .form-control:focus, .form-select:focus { border-color: var(--cream-400); box-shadow: 0 0 0 3px rgba(176,136,80,.12); }
        .form-label { color: var(--brown-text); font-weight: 500; font-size: .83rem; }
        .input-group-text { background: var(--cream-50); border-color: var(--border); color: var(--muted-text); }

        /* Alert */
        .alert-success { background: #f0f7ec; border-color: #c6e0b8; color: #2e6b1e; }
        .alert-danger  { background: #fdf0f0; border-color: #f0c0c0; color: #b03030; }

        /* Cart badge */
        .cart-badge { background: var(--cream-400); color: var(--cream-800); font-size: .65rem; }

        hr { border-color: var(--border); }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: var(--cream-300); border-radius: 3px; }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: transform .3s; }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
    @yield('styles')
</head>
<body>

<nav class="sidebar">
    <div class="brand">
        <div class="d-flex align-items-center gap-2">
            <div class="brand-icon">
                <i class="bi bi-shop-window" style="color:var(--cream-800);font-size:1.1rem;"></i>
            </div>
            <div>
                <h5>Toko Inventory Aimar</h5>
                <small>Simple Inventory Management</small>
            </div>
        </div>
    </div>

    <div class="sidebar-nav">
        @auth
            @if(auth()->user()->isAdmin())
                <div class="sidebar-section-label">Admin</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam"></i> Produk
                </a>
                <a href="{{ route('admin.products.create') }}" class="nav-link {{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                    <i class="bi bi-plus-circle"></i> Tambah Produk
                </a>
            @else
                <div class="sidebar-section-label">Belanja</div>
                <a href="{{ route('shop.index') }}" class="nav-link {{ request()->routeIs('shop.index') ? 'active' : '' }}">
                    <i class="bi bi-shop"></i> Toko
                </a>
                <a href="{{ route('shop.cart.index') }}" class="nav-link {{ request()->routeIs('shop.cart.index') ? 'active' : '' }}">
                    <i class="bi bi-cart3"></i> Keranjang
                    @php $cartCount = count(session()->get('cart', [])); @endphp
                    @if($cartCount > 0)
                        <span class="badge cart-badge rounded-pill ms-auto">{{ $cartCount }}</span>
                    @endif
                </a>
            @endif
        @endauth
    </div>

    <div class="sidebar-footer">
        @auth
        <div class="d-flex align-items-center gap-2 mb-2">
            <div style="width:30px;height:30px;background:var(--cream-600);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="bi bi-person-fill" style="color:var(--cream-100);font-size:.8rem;"></i>
            </div>
            <div style="overflow:hidden;">
                <div class="user-name text-truncate">{{ auth()->user()->name }}</div>
                <div class="user-role">{{ ucfirst(auth()->user()->role) }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn-logout"><i class="bi bi-box-arrow-right me-2"></i>Keluar</button>
        </form>
        @endauth
    </div>
</nav>

<div class="main-content">
    <div class="topbar">
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-sm d-md-none border-0" onclick="document.querySelector('.sidebar').classList.toggle('show')" style="color:var(--muted-text);">
                <i class="bi bi-list fs-5"></i>
            </button>
            <h6 class="page-title">@yield('page-title', 'Dashboard')</h6>
        </div>
        @auth
        <div class="d-flex align-items-center gap-2">
            @if(auth()->user()->isCustomer())
                <a href="{{ route('shop.cart.index') }}" class="btn btn-sm btn-outline-primary position-relative" style="border-radius:8px;">
                    <i class="bi bi-cart3"></i>
                    @if($cartCount > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill cart-badge">{{ $cartCount }}</span>
                    @endif
                </a>
            @endif
            <span style="color:var(--muted-text);font-size:.8rem;" class="d-none d-sm-inline">
                Halo, <strong style="color:var(--brown-text);">{{ auth()->user()->name }}</strong>
            </span>
        </div>
        @endauth
    </div>

    <div class="page-wrapper pb-0 pt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert" style="border-radius:10px;font-size:.85rem;">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert" style="border-radius:10px;font-size:.85rem;">
                <i class="bi bi-exclamation-circle-fill"></i>
                {{ session('error') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <div class="page-wrapper pt-2">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
@yield('scripts')
</body>
</html>