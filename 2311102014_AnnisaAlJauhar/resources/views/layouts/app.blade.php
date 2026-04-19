<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris Toko Pak Cik & Mas Aimar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #fff0f5; }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #c2185b 0%, #e91e8c 100%);
            padding-top: 20px;
            position: relative;
        }
        .sidebar-brand {
            color: white;
            font-size: 1rem;
            font-weight: 700;
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            margin-bottom: 10px;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 10px 20px;
            border-radius: 8px;
            margin: 2px 10px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
        }
        .sidebar .nav-link i { width: 20px; }
        .main-content { padding: 30px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(233,30,140,0.1); }
        .card-header {
            background: linear-gradient(90deg, #e91e8c, #f06292) !important;
            color: white;
            border-radius: 12px 12px 0 0 !important;
        }
        .btn-primary {
            background: linear-gradient(90deg, #c2185b, #e91e8c);
            border: none;
        }
        .btn-primary:hover { background: linear-gradient(90deg, #ad1457, #c2185b); border: none; }
        .btn { border-radius: 8px; }
        .table th {
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background-color: #fce4ec;
            color: #c2185b;
        }
        .badge-category {
            background-color: #fce4ec;
            color: #c2185b;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        .user-info {
            color: rgba(255,255,255,0.8);
            font-size: 0.85rem;
            padding: 10px 20px;
            border-top: 1px solid rgba(255,255,255,0.2);
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        .stat-card {
            border-radius: 12px;
            padding: 20px;
            color: white;
            margin-bottom: 20px;
        }
        .stat-card.pink { background: linear-gradient(135deg, #e91e8c, #f48fb1); }
        .stat-card.rose { background: linear-gradient(135deg, #c2185b, #e91e8c); }
        .stat-card.light { background: linear-gradient(135deg, #f06292, #f48fb1); }
        .navbar-top {
            background: white;
            border-bottom: 2px solid #f8bbd0;
            padding: 15px 30px;
            margin-bottom: 0;
        }
        .form-control:focus, .form-select:focus {
            border-color: #e91e8c;
            box-shadow: 0 0 0 0.2rem rgba(233,30,140,0.15);
        }
        .page-item.active .page-link { background-color: #e91e8c; border-color: #e91e8c; }
        .page-link { color: #e91e8c; }
    </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar" style="width: 250px; min-width: 250px;">
        <div class="sidebar-brand">
            <i class="fas fa-store me-2"></i>
            Toko Pak Cik & Aimar
        </div>
        <nav class="nav flex-column">
            <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                <i class="fas fa-boxes me-2"></i> Inventaris Produk
            </a>
        </nav>
        <div class="user-info">
            <i class="fas fa-user-circle me-2"></i>
            {{ Auth::user()->name }} <br>
            <form action="{{ route('logout') }}" method="POST" class="mt-2">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-light w-100">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1">
        <div class="navbar-top d-flex align-items-center">
            <h5 class="mb-0 fw-bold" style="color: #c2185b;">
                <i class="fas fa-store me-2"></i>
                Sistem Inventaris Toko
            </h5>
            <span class="ms-auto text-muted small">
                <i class="fas fa-calendar me-1"></i>
                {{ now()->format('d F Y') }}
            </span>
        </div>
        <div class="main-content">
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
@stack('scripts')
</body>
</html>