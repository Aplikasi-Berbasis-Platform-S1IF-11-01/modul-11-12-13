<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | Suki Pak Cik</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { 
            --primary-red: #ff4b2b; 
            --dark-suki: #1D3557; 
            --soft-bg: #F8FAFC; 
        }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--soft-bg); 
            height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            margin: 0; 
        }
        .bento-card { 
            background: white; 
            border-radius: 32px; 
            padding: 40px; 
            width: 100%; 
            max-width: 450px; 
            box-shadow: 0 20px 60px rgba(29, 53, 87, 0.08); 
            text-align: center;
        }
        /* Style Logo Kotak Merah */
        .logo-circle {
            width: 80px; height: 80px;
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            color: white;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 10px 20px rgba(255, 75, 43, 0.2);
        }
        .input-custom { 
            border-radius: 16px; 
            padding: 14px 20px; 
            border: 2px solid #F1F5F9; 
            background: #F8FAFC; 
            text-align: left;
        }
        .btn-suki { 
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            color: white; 
            border: none; 
            border-radius: 16px; 
            padding: 16px; 
            font-weight: 700; 
            width: 100%; 
            transition: 0.3s;
        }
        .btn-suki:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 75, 43, 0.3);
            color: white;
        }
    </style>
</head>
<body>
    <div class="bento-card">
        <div class="logo-circle">
            <i class="fas fa-boxes-stacked fa-2x"></i>
        </div>

        <h2 class="fw-800" style="color: var(--dark-suki); letter-spacing: -1px;">Daftar Akun Baru</h2>
        <p class="text-muted mb-4 small">Buat akun untuk akses inventori StockSense.</p>

        <form action="/register" method="POST">
            @csrf
            <div class="mb-3 text-start">
                <label class="fw-600 small mb-2 d-block" style="color: var(--dark-suki);">Pilih Username</label>
                <input type="text" name="username" class="form-control input-custom" placeholder="admin_baru" required>
            </div>
            <div class="mb-4 text-start">
                <label class="fw-600 small mb-2 d-block" style="color: var(--dark-suki);">Buat Kata Sandi</label>
                <input type="password" name="password" class="form-control input-custom" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn btn-suki shadow">Buat Akun Sekarang</button>
        </form>
        
        <div class="text-center mt-4">
            <a href="/login" class="small text-muted text-decoration-none">Sudah punya akun? <strong style="color: var(--primary-red);">Login</strong></a>
        </div>
    </div>
</body>
</html>