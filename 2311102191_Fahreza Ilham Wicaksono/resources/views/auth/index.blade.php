<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | NguawiStore</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: #fdf5ee;
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .nw-card {
            background: #fff9f5;
            border: 0.5px solid #d4a97a;
            border-radius: 12px;
            padding: 2rem 2.25rem;
            width: 100%;
            max-width: 380px;
        }

        .nw-brand {
            text-align: center;
            margin-bottom: 1.75rem;
        }

        .nw-logo {
            width: 44px;
            height: 44px;
            background: #6d4c41;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .nw-brand h1 {
            font-size: 18px;
            font-weight: 500;
            color: #8B4513;
            margin: 0 0 4px;
        }

        .nw-brand p {
            font-size: 12.5px;
            color: #a07050;
            margin: 0;
        }

        .nw-divider {
            border: none;
            border-top: 0.5px solid #d4a97a;
            margin: 0 0 1.5rem;
        }

        .form-group {
            margin-bottom: 1.1rem;
        }

        .form-label {
            display: block;
            font-size: 12.5px;
            font-weight: 500;
            color: #7a4a20;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 6px;
        }

        .input-group {
            display: flex;
            align-items: center;
            background: #fffaf7;
            border: 0.5px solid #d4a97a;
            border-radius: 8px;
            overflow: hidden;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .input-group:focus-within {
            border-color: #8B4513;
            box-shadow: 0 0 0 3px rgba(139, 69, 19, 0.1);
        }

        .ig-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a07050;
            border-right: 0.5px solid #e8cdb0;
            flex-shrink: 0;
        }

        .input-group input {
            flex: 1;
            border: none;
            background: transparent;
            padding: 0 12px;
            height: 38px;
            font-size: 14px;
            color: #3e2010;
            outline: none;
            font-family: 'Segoe UI', sans-serif;
        }

        .input-group input::placeholder {
            color: #c4a080;
        }

        .nw-forgot {
            text-align: right;
            margin-top: 6px;
        }

        .nw-forgot a {
            font-size: 12px;
            color: #8B4513;
            text-decoration: none;
        }

        .nw-forgot a:hover {
            text-decoration: underline;
        }

        .btn-add {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            width: 100%;
            padding: 9px 14px;
            background: #6d4c41;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 1.5rem;
            font-family: 'Segoe UI', sans-serif;
            transition: background 0.15s;
        }

        .btn-add:hover {
            background: #5a3d33;
        }

        .btn-secondary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            width: 100%;
            padding: 9px 14px;
            background: #fff3ed;
            color: #6d4c41;
            border: 0.5px solid #d4a97a;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 10px;
            font-family: 'Segoe UI', sans-serif;
            transition: background 0.15s;
        }

        .btn-secondary:hover {
            background: #fde8d8;
        }

        .nw-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 12px;
            color: #a07050;
        }
    </style>
</head>

<body>
    <div class="nw-card">
        <div class="nw-brand">
            <div class="nw-logo">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" stroke="#f5e6da" stroke-width="1.5"
                        stroke-linejoin="round" />
                    <path d="M9 22V12h6v10" stroke="#f5e6da" stroke-width="1.5" stroke-linejoin="round" />
                </svg>
            </div>
            <h1><b>NguawiStore</b></h1>
            <p>Masuk ke panel admin toko</p>
        </div>
        <hr class="nw-divider">

        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group">
                <label class="form-label">Email</label>
                <div class="input-group">
                    <span class="ig-icon">
                        <i class="fa-solid fa-envelope"></i>
                    </span>

                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        id="email" placeholder="name@example.com" value="{{ old('email') }}" autofocus required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="ig-icon">
                        <i class="fa-solid fa-lock"></i>
                    </span>

                    <input type="password" name="password" class="form-control" id="password" placeholder="Password"
                        required>
                </div>
            </div>

            <button type="submit" class="btn-add">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                Masuk
            </button>
        </form>

        <div class="nw-footer">© 2026 NguawiStore · All rights reserved</div>
    </div>
</body>

</html>
