<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Inventori Toko</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .login-card {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-title {
            font-size: 24px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
            color: #111827;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #374151;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            box-sizing: border-box;
            font-family: inherit;
        }
        .btn-primary {
            width: 100%;
            padding: 10px;
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
        }
        .btn-primary:hover {
            background-color: #1d4ed8;
        }
        .alert {
            background-color: #fee2e2;
            color: #b91c1c;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 14px;
        }
        .text-danger {
            color: #dc2626;
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }
        .watermark {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #9ca3af;
        }
    </style>
</head>
<body>
    <div>
        <div class="login-card">
            <div class="login-title">Login Admin</div>
            
            @if($errors->has('email'))
                <div class="alert">
                    {{ $errors->first('email') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', 'admin@toko.com') }}" required>
                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                    @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <button type="submit" class="btn-primary">Masuk</button>
            </form>
        </div>
        
        <div class="watermark">
            <!-- Watermark: 2311102001-NofitaFitriyani -->
            &copy; 2026 2311102001-NofitaFitriyani
        </div>
    </div>
</body>
</html>
