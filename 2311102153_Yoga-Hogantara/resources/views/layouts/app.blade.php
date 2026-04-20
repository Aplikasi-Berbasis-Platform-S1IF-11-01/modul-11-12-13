<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko Suki') — Inventaris</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* Menerapkan Palet Warna Custom */
        :root {
            --bg-carbon: #212529;
            --bg-gunmetal: #343A40;
            --border-slate: #6C757D;
            --text-pale: #CED4DA;
            --text-snow: #F8F9FA;
        }
        
        body { 
            background-color: var(--bg-carbon); 
            color: var(--text-snow);
            font-family: 'Segoe UI', sans-serif; 
        }
        
        /* Navbar Minimalis */
        .navbar { 
            background-color: var(--bg-carbon) !important; 
            border-bottom: 1px solid var(--border-slate);
        }
        .navbar-brand { font-weight: 700; color: var(--text-snow) !important; }
        
        /* Card & Table Custom */
        .card { 
            background-color: var(--bg-gunmetal); 
            border: 1px solid var(--border-slate); 
        }
        .table { --bs-table-bg: transparent; --bs-table-color: var(--text-snow); }
        .table thead th { 
            background-color: var(--bg-carbon); 
            border-bottom: 2px solid var(--border-slate); 
            color: var(--text-pale);
            font-weight: 600;
        }
        .table td { border-bottom: 1px solid var(--border-slate); }
        
        /* Text Muted adjustment */
        .text-muted { color: var(--text-pale) !important; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ route('products.index') }}">
            🛒 Toko Suki
        </a>
        <div class="ms-auto d-flex align-items-center gap-3">
            <span class="small" style="color: var(--text-pale);">
                <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name ?? 'Tamu' }}
            </span>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-light">
                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="container mt-4 mb-5">
    {{-- Flash Message tetap sama --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>