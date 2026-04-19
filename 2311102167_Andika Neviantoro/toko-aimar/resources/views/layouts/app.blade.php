<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Toko Aimar') — Inventari Toko</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    {{-- DataTables --}}
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #2c6e49;
            --primary-dark: #1b4332;
            --accent: #f4a261;
            --light-bg: #f8f9fa;
        }
        body { background: var(--light-bg); font-family: 'Segoe UI', sans-serif; }

        /* Sidebar */
        .sidebar {
            width: 250px; min-height: 100vh;
            background: linear-gradient(180deg, var(--primary-dark) 0%, var(--primary) 100%);
            position: fixed; top: 0; left: 0; z-index: 100;
            box-shadow: 2px 0 10px rgba(0,0,0,.2);
        }
        .sidebar .brand {
            padding: 1.5rem 1rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,.15);
        }
        .sidebar .brand h5 { color: #fff; font-weight: 700; margin: 0; font-size: 1.1rem; }
        .sidebar .brand small { color: rgba(255,255,255,.6); font-size: .75rem; }
        .sidebar .nav-link {
            color: rgba(255,255,255,.75); padding: .6rem 1rem;
            border-radius: 8px; margin: 2px 8px; font-size: .9rem;
            transition: all .2s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff; background: rgba(255,255,255,.15);
        }
        .sidebar .nav-link i { width: 20px; margin-right: 8px; }

        /* Main content */
        .main-content { margin-left: 250px; min-height: 100vh; }
        .topbar {
            background: #fff; padding: .75rem 1.5rem;
            box-shadow: 0 1px 4px rgba(0,0,0,.08);
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 99;
        }
        .page-wrapper { padding: 1.5rem; }

        /* Cards */
        .card { border: none; box-shadow: 0 1px 6px rgba(0,0,0,.07); border-radius: 12px; }
        .card-header { background: #fff; border-bottom: 1px solid #eee; border-radius: 12px 12px 0 0 !important; font-weight: 600; }

        /* Stats */
        .stat-card { border-radius: 12px; border: none; overflow: hidden; }
        .stat-card .stat-icon { width: 52px; height: 52px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; }

        /* Badges */
        .badge-stock-ok  { background: #d1fae5; color: #065f46; }
        .badge-stock-low { background: #fef3c7; color: #92400e; }
        .badge-stock-out { background: #fee2e2; color: #991b1b; }

        /* Buttons */
        .btn-primary { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }
        .btn-outline-primary { color: var(--primary); border-color: var(--primary); }
        .btn-outline-primary:hover { background: var(--primary); border-color: var(--primary); }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 5px; } ::-webkit-scrollbar-thumb { background: #ccc; border-radius: 3px; }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: transform .3s; }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
    @yield('styles')
</head>
<body>

{{-- Sidebar --}}
<nav class="sidebar">
    <div class="brand">
        <div class="d-flex align-items-center gap-2">
            <div style="width:36px;height:36px;background:var(--accent);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-shop-window text-white fs-5"></i>
            </div>
            <div>
                <h5>Toko Aimar</h5>
                <small>Milik Pak Cik & Mas Aimar</small>
            </div>
        </div>
    </div>

    <div class="pt-3">
        @auth
            @if(auth()->user()->isAdmin())
                {{-- Admin Menu --}}
                <p class="px-3 mb-1" style="color:rgba(255,255,255,.4);font-size:.7rem;text-transform:uppercase;letter-spacing:.05em;">Menu Admin</p>
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
                {{-- Customer Menu --}}
                <p class="px-3 mb-1" style="color:rgba(255,255,255,.4);font-size:.7rem;text-transform:uppercase;letter-spacing:.05em;">Menu Belanja</p>
                <a href="{{ route('shop.index') }}" class="nav-link {{ request()->routeIs('shop.index') ? 'active' : '' }}">
                    <i class="bi bi-shop"></i> Toko
                </a>
                <a href="{{ route('shop.cart.index') }}" class="nav-link {{ request()->routeIs('shop.cart.index') ? 'active' : '' }}">
                    <i class="bi bi-cart3"></i> Keranjang
                    @php $cartCount = count(session()->get('cart', [])); @endphp
                    @if($cartCount > 0)
                        <span class="badge bg-warning text-dark ms-1">{{ $cartCount }}</span>
                    @endif
                </a>
            @endif
        @endauth
    </div>

    <div class="position-absolute bottom-0 w-100 p-3">
        @auth
        <div class="d-flex align-items-center gap-2 mb-2 px-1">
            <div style="width:32px;height:32px;background:var(--accent);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="bi bi-person-fill text-white small"></i>
            </div>
            <div style="overflow:hidden;">
                <div style="color:#fff;font-size:.8rem;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ auth()->user()->name }}</div>
                <div style="color:rgba(255,255,255,.5);font-size:.7rem;">{{ ucfirst(auth()->user()->role) }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-sm w-100 text-start" style="color:rgba(255,255,255,.6);background:rgba(255,255,255,.08);border:none;">
                <i class="bi bi-box-arrow-right me-2"></i>Logout
            </button>
        </form>
        @endauth
    </div>
</nav>

{{-- Main Content --}}
<div class="main-content">
    {{-- Top Bar --}}
    <div class="topbar">
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-sm d-md-none" onclick="document.querySelector('.sidebar').classList.toggle('show')">
                <i class="bi bi-list fs-5"></i>
            </button>
            <h6 class="mb-0 fw-600">@yield('page-title', 'Dashboard')</h6>
        </div>
        @auth
        <div class="d-flex align-items-center gap-2">
            @if(auth()->user()->isCustomer())
                <a href="{{ route('shop.cart.index') }}" class="btn btn-sm btn-outline-primary position-relative">
                    <i class="bi bi-cart3"></i>
                    @if($cartCount > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $cartCount }}</span>
                    @endif
                </a>
            @endif
            <span class="text-muted small d-none d-sm-inline">Hai, <strong>{{ auth()->user()->name }}</strong>!</span>
        </div>
        @endauth
    </div>

    {{-- Flash Messages --}}
    <div class="page-wrapper pb-0 pt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert">
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

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
@yield('scripts')
</body>
</html>
