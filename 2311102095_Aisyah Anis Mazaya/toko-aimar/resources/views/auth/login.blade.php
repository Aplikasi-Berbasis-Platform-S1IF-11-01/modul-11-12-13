<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Toko Mas Aimar</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🌸</text></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #FFF0F5; 
            color: #5c4044; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .card-custom { 
            background-color: #FFE4E1; 
            border: 2px solid #FFC0CB; 
            border-radius: 20px; 
            width: 100%; 
            max-width: 400px; 
            padding: 2.5rem; 
        }
        .btn-pink { 
            background-color: #FF69B4; 
            color: white; 
            border: none; 
            width: 100%; 
            border-radius: 50px; 
            padding: 12px; 
            font-weight: bold;
            letter-spacing: 1px;
        }
        .btn-pink:hover { 
            background-color: #FF1493; 
            color: white; 
            box-shadow: 0 4px 8px rgba(255, 20, 147, 0.3);
        }
        .form-control { 
            border-radius: 50px; 
            padding: 12px 20px; 
            border: 1px solid #FFB6C1; 
            background-color: #fffafb;
        }
        .form-control:focus {
            border-color: #FF69B4;
            box-shadow: 0 0 0 0.25rem rgba(255, 105, 180, 0.25);
        }
    </style>
</head>
<body>

    <div class="card-custom shadow-lg">
        <div class="text-center mb-4">
            <h3 class="fw-bold" style="color: #d14781;">🌸 Login Admin 🌸</h3>
            <p class="text-muted small mb-0">Toko Inventori Mas Aimar & Pak Cik</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger rounded-pill text-center border-danger py-2" style="font-size: 14px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Masukkan Email" required autofocus>
            </div>
            <div class="mb-4">
                <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
            </div>
            <button type="submit" class="btn btn-pink transition">Masuk Sekarang</button>
        </form>
    </div>

</body>
</html>