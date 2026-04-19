<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventori Toko Mas Aimar</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🌸</text></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body { 
            background-color: #FFF0F5; 
            color: #5c4044; 
            font-family: 'Nunito', sans-serif; 
        }
        .navbar-custom { 
            background-color: #FFB6C1; 
            box-shadow: 0 4px 15px rgba(255, 182, 193, 0.4); 
        }
        .card-custom { 
            background-color: #ffffff; 
            border: none; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(255, 182, 193, 0.3); 
        }
        .btn-pink { 
            background-color: #FF69B4; 
            color: white; 
            border: none; 
            font-weight: 700;
        }
        .btn-pink:hover { 
            background-color: #FF1493; 
            color: white; 
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
        .table-custom { 
            border-radius: 12px; 
            overflow: hidden; 
        }
        .table-hover tbody tr:hover {
            background-color: #FFF0F5; 
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom mb-5 py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-white fs-4" href="{{ route('products.index') }}">🌸 Toko Mas Aimar & Pak Cik</a>
            
            <form action="{{ route('logout') }}" method="POST" class="d-flex">
                @csrf
                <button type="submit" class="btn btn-light text-danger fw-bold rounded-pill px-4 shadow-sm">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container pb-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>