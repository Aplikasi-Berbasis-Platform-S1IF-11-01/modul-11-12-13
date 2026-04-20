<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventori Toko</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fbff 0%, #eef4ff 45%, #f6f7fb 100%);
            min-height: 100vh;
            color: #1f2937;
        }

        .navbar-modern {
            background: rgba(17, 24, 39, 0.85);
            backdrop-filter: blur(14px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .brand-badge {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #4f46e5, #06b6d4);
            color: white;
            font-weight: 800;
            margin-right: 10px;
        }

        .hero-card {
            border: 0;
            border-radius: 28px;
            background:
                radial-gradient(circle at top left, rgba(255,255,255,0.16), transparent 22%),
                linear-gradient(135deg, #0f172a 0%, #1d4ed8 48%, #0891b2 100%);
            color: white;
            box-shadow: 0 24px 60px rgba(29, 78, 216, 0.22);
            overflow: hidden;
            position: relative;
        }

        .hero-card::before {
            content: '';
            position: absolute;
            width: 280px;
            height: 280px;
            right: -60px;
            top: -60px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
        }

        .hero-card::after {
            content: '';
            position: absolute;
            width: 180px;
            height: 180px;
            left: 55%;
            bottom: -80px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }

        .glass-card {
            border: 1px solid rgba(255,255,255,0.55);
            border-radius: 22px;
            background: rgba(255,255,255,0.82);
            backdrop-filter: blur(12px);
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
        }

        .section-title {
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .stat-card {
            border: 0;
            border-radius: 20px;
            color: #111827;
            box-shadow: 0 16px 35px rgba(15, 23, 42, 0.06);
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 700;
        }

        .btn-modern {
            border-radius: 14px;
            padding: 10px 18px;
            font-weight: 600;
        }

        .soft-panel {
            border-radius: 22px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.12);
            backdrop-filter: blur(10px);
        }

        .mini-label {
            font-size: 13px;
            color: rgba(255,255,255,0.7);
        }

        .floating-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #22c55e;
            display: inline-block;
            margin-right: 8px;
            box-shadow: 0 0 0 6px rgba(34,197,94,0.18);
        }

        .product-name {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .product-avatar {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: linear-gradient(135deg, #e0e7ff, #dbeafe);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #4338ca;
            font-weight: 700;
        }

        .empty-box {
            border: 2px dashed #dbe4f0;
            border-radius: 22px;
            padding: 42px 20px;
            text-align: center;
            background: linear-gradient(180deg, rgba(255,255,255,0.7), rgba(248,250,252,0.9));
        }

        .datatable-wrap .dataTables_filter input,
        .datatable-wrap .dataTables_length select {
            border-radius: 12px !important;
            border: 1px solid #dbe4f0 !important;
            padding: 6px 10px !important;
        }

        .datatable-wrap .pagination .page-link {
            border-radius: 10px !important;
            margin: 0 3px;
            border: none;
            color: #334155;
        }

        .datatable-wrap .pagination .active > .page-link {
            background: linear-gradient(135deg, #4f46e5, #06b6d4);
        }

        .table-modern tbody td {
            vertical-align: middle;
        }

        .section-subtle {
            color: #64748b;
        }

        .badge-category {
            background: #f8fafc;
            color: #334155;
            border: 1px solid #e2e8f0;
            border-radius: 999px;
            padding: 8px 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .text-truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .btn-modern {
            border-radius: 14px;
            padding: 10px 18px;
            font-weight: 600;
        }

        .btn-gradient {
            border: 0;
            color: white;
            background: linear-gradient(135deg, #4f46e5, #06b6d4);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.24);
        }

        .table-modern thead th {
            background: #111827;
            color: white;
            border: none;
        }

        .table-modern {
            overflow: hidden;
            border-radius: 18px;
        }

        .table-modern tbody tr:hover {
            background-color: #f8fafc;
        }

        .form-control, .form-select, textarea {
            border-radius: 14px !important;
            border: 1px solid #dbe4f0;
            padding: 12px 14px;
        }

        .form-control:focus, .form-select:focus, textarea:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.15);
        }

        .page-shell {
            padding-top: 32px;
            padding-bottom: 48px;
        }

        .badge-soft {
            background: #eef2ff;
            color: #4338ca;
            border-radius: 999px;
            padding: 8px 12px;
            font-weight: 600;
            font-size: 12px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark navbar-modern sticky-top">
    <div class="container py-2">
        <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ route('products.index') }}">
            <span class="brand-badge">IT</span>
            Inventori Toko iLutS
        </a>
        <div class="collapse navbar-collapse justify-content-end">
            @auth
                <div class="d-flex align-items-center gap-3">
                    <span class="text-white-50 small">Halo, <strong class="text-white">{{ Auth::user()->name }}</strong></span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-outline-light btn-sm btn-modern">Logout</button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>

<div class="container page-shell">
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm" style="border-radius:16px;">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
@stack('scripts')
</body>
</html>