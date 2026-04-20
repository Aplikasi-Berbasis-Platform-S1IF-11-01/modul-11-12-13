<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <title>La'Vabie — @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"/>
</head>
<body>

<nav class="navbar">
    <div class="container-xl px-4 d-flex justify-content-between align-items-center">
        <div>
            <span class="brand-name">La'<em>Vabie</em></span>
            <div class="brand-sub">TOKO BUSANA & FASHION</div>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span class="nav-right">SINCE 2023</span>
            <form method="POST" action="{{ route('logout') }}" class="mb-0">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="page-header">
    <div class="container-xl px-4">
        <h1 class="page-title">
            @yield('page-title-plain') <em>@yield('page-title-em')</em>
        </h1>
        <p class="page-sub">@yield('page-sub')</p>
    </div>
</div>

<div class="container-xl px-4 pb-5">
    @if(session('success'))
        <div class="alert-toast" id="alertToast">{{ session('success') }}</div>
        <script>
            setTimeout(() => {
                const el = document.getElementById('alertToast');
                if (el) el.style.opacity = '0';
            }, 2500);
        </script>
    @endif

    @yield('content')
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
@yield('scripts')
</body>
</html>