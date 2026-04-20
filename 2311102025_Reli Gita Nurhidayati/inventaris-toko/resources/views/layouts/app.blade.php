<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Inventaris Toko Mas Aimar')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Poppins', sans-serif; }

        body { background-color: #f0f2f5; }

        /* Navbar */
        .navbar-brand-custom {
            font-weight: 700;
            font-size: 1.2rem;
            color: white !important;
        }
        .navbar-custom {
            background: linear-gradient(135deg, #1e3a5f 0%, #2d6a9f 100%);
            box-shadow: 0 2px 15px rgba(0,0,0,0.2);
        }

        /* Sidebar */
        .sidebar {
            min-height: calc(100vh - 60px);
            background: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.08);
            padding-top: 1rem;
        }
        .sidebar .nav-link {
            color: #495057;
            padding: 0.7rem 1.2rem;
            border-radius: 8px;
            margin: 2px 8px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: linear-gradient(135deg, #1e3a5f 0%, #2d6a9f 100%);
            color: white !important;
        }
        .sidebar .nav-link i { margin-right: 8px; font-size: 1rem; }

        /* Cards */
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
        .card-header { border-radius: 12px 12px 0 0 !important; border-bottom: none; }

        /* Stats cards */
        .stat-card { border-radius: 12px; padding: 1.2rem 1.5rem; color: white; }
        .stat-card .stat-icon { font-size: 2.5rem; opacity: 0.8; }
        .stat-card .stat-number { font-size: 1.8rem; font-weight: 700; }
        .stat-card .stat-label { font-size: 0.85rem; opacity: 0.9; }

        /* Buttons */
        .btn { border-radius: 8px; font-weight: 500; font-size: 0.875rem; }
        .btn-sm { padding: 0.35rem 0.75rem; }

        /* Alerts */
        .alert { border-radius: 10px; border: none; }

        /* DataTable */
        .dataTables_wrapper .dataTables_filter input {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 5px 10px;
        }
        .dataTables_wrapper .dataTables_length select {
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }
        table.dataTable thead th {
            background: #f8f9fa;
            font-weight: 600;
            font-size: 0.875rem;
            color: #495057;
        }

        /* Badge */
        .badge { border-radius: 6px; font-weight: 500; }

        /* Form */
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            font-size: 0.9rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: #2d6a9f;
            box-shadow: 0 0 0 0.2rem rgba(45, 106, 159, 0.15);
        }
        .form-label { font-weight: 500; font-size: 0.9rem; color: #495057; }

        /* Page title */
        .page-title { font-weight: 700; color: #1e3a5f; font-size: 1.4rem; }
        .page-subtitle { color: #6c757d; font-size: 0.875rem; }

        /* User info di navbar */
        .user-info { font-size: 0.85rem; color: rgba(255,255,255,0.9); }

        /* Watermark di footer */
        .watermark-footer {
            background: white;
            border-top: 1px solid #dee2e6;
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
            color: #adb5bd;
            text-align: center;
        }
    </style>

    @stack('styles')
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom py-2">
    <div class="container-fluid px-3">
        <a class="navbar-brand-custom" href="{{ route('products.index') }}">
            🛒 Inventaris Toko Mas Aimar
        </a>
        <div class="d-flex align-items-center gap-3">
            <span class="user-info">
                <i class="bi bi-person-circle me-1"></i>
                {{ Auth::user()->name ?? 'Guest' }}
            </span>
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- Main Layout -->
<div class="container-fluid p-0">
    <div class="row g-0">

        <!-- Sidebar -->
        <div class="col-auto sidebar d-none d-md-block" style="width: 220px;">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('products.index') }}"
                       class="nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}">
                        <i class="bi bi-grid-3x3-gap"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}"
                       class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                        <i class="bi bi-box-seam"></i> Kelola Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.create') }}"
                       class="nav-link {{ request()->routeIs('products.create') ? 'active' : '' }}">
                        <i class="bi bi-plus-circle"></i> Tambah Produk
                    </a>
                </li>
            </ul>

            <!-- Info toko di sidebar -->
            <div class="mt-4 mx-2 p-3 rounded-3" style="background: #f8f9fa;">
                <div class="text-center">
                    <div style="font-size: 2rem;">🏪</div>
                    <div style="font-size: 0.75rem; color: #6c757d; font-weight: 500;">Toko Mas Aimar</div>
                    <div style="font-size: 0.7rem; color: #adb5bd;">Purwokerto</div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="col" style="min-height: calc(100vh - 60px);">
            <div class="p-4">

                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('info'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="bi bi-info-circle-fill me-2"></i>{{ session('info') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>

            <!-- Watermark Footer -->
            <div class="watermark-footer">
                Dibuat oleh: <strong>2311102025 - Reli Gita Nurhidayati</strong> | Praktikum ABP - Modul 11, 12, 13 | {{ date('Y') }}
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

@stack('scripts')
</body>
</html>
