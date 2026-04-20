<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body style="background: linear-gradient(135deg, #4f46e5, #6366f1);">

<div class="d-flex justify-content-center align-items-center vh-100">
    @yield('content')
</div>

</body>
</html>