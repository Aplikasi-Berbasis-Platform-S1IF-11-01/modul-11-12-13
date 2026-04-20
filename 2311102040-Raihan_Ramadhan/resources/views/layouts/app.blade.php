<!DOCTYPE html>
<html>
<head>
    <title>Inventaris Toko</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-custom mb-4">
    <div class="container">
        <span class="navbar-brand">🛒 Inventaris Toko</span>
        <a href="/logout" class="btn btn-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>




<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

@stack('scripts')

</body>
</html>