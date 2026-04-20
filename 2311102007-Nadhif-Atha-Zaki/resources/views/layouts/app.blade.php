<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventori Toko</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    body {
        background: #f4f7fb;
        font-family: 'Segoe UI', sans-serif;
    }

    /* NAVBAR */
    .navbar-custom {
        background: linear-gradient(135deg, #0a1f44, #142f63);
    }

    /* CARD */
    .card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 6px 15px rgba(0,0,0,0.08);
    }

    /* TABLE */
    .table thead {
        background: #0a1f44;
        color: white;
    }

    /* BUTTON */
    .btn-primary {
        background: #142f63;
        border: none;
    }

    .btn-primary:hover {
        background: #0d234d;
    }

    .btn-success {
        background: #1f4f82;
        border: none;
    }

    .btn-warning {
        background: #ffc107;
        color: #000;
    }

    .btn-danger {
        background: #b02a37;
    }

    /* TITLE */
    h2 {
        color: #0a1f44;
        font-weight: 600;
    }

</style>

<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('products.index') }}">
            🏪 Inventori Toko
        </a>

        <div class="d-flex align-items-center gap-3">
            <span class="text-white">
                {{ Auth::user()->name }}
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-light btn-sm">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<main class="py-4">
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>