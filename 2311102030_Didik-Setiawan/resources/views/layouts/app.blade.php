<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Inventaris') - Toko Pak Cik & Mas Aimar</title>
    <!-- Simple DataTables CSS -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <!-- Boxicons for icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div class="app-container">
        <!-- Navbar -->
        <header class="navbar">
            <a href="#" class="navbar-brand">
                <i class='bx bx-store-alt'></i>
                <span>Toko Pak Cik & Mas Aimar</span>
            </a>
            
            <nav class="navbar-menu">
                <span class="nav-link"><i class='bx bx-user'></i> {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-secondary" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;">
                        <i class='bx bx-log-out'></i> Logout
                    </button>
                </form>
            </nav>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            @if(session('success'))
            <div class="alert alert-success">
                <i class='bx bx-check-circle'></i> {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                <i class='bx bx-error-circle'></i> {{ session('error') }}
            </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Simple DataTables JS -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    @stack('scripts')
</body>
</html>
