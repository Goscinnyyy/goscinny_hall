<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | GoscinnyHall</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #121212; /* Latar belakang hitam layout utama */
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            background-color: #1e1e1e;
            padding: 40px;
            border-radius: 15px;
            border: 1px solid #D4AF37;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .form-control {
            background-color: #2a2a2a !important;
            border: 1px solid #444 !important;
            color: #fff !important;
        }

        .form-control:focus {
            border-color: #D4AF37 !important;
            box-shadow: none !important;
        }

        .btn-gold {
            background-color: #D4AF37;
            color: #000;
            font-weight: bold;
            padding: 12px;
            border-radius: 8px;
            transition: 0.3s;
            border: none;
            width: 100%;
        }

        .btn-gold:hover {
            background-color: #b8952e;
            color: #000;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="text-center mb-4">
        <h2 style="color: #D4AF37; font-weight: bold; letter-spacing: 2px;">LOGIN</h2>
        <p style="color: #888; font-size: 14px;">Masukkan kredensial untuk akses reservasi</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="mb-3">
            <label class="form-label" style="color: #D4AF37; font-size: 13px;">Alamat Email</label>
            <input type="email" name="email" class="form-control shadow-none" value="{{ old('email') }}" required autofocus>
            @error('email') 
                <small class="text-danger mt-1 d-block">{{ $message }}</small> 
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-4">
            <label class="form-label" style="color: #D4AF37; font-size: 13px;">Kata Sandi</label>
            <input type="password" name="password" class="form-control shadow-none" required autocomplete="current-password">
            @error('password') 
                <small class="text-danger mt-1 d-block">{{ $message }}</small> 
            @enderror
        </div>

        {{-- Tombol Login --}}
        <button type="submit" class="btn-gold">
            MASUK SEKARANG
        </button>

        {{-- Link Tambahan --}}
        <div class="text-center mt-3">
            <a href="{{ url('/') }}" style="color: #888; text-decoration: none; font-size: 12px;">
                &larr; Kembali ke Beranda
            </a>
        </div>
        <p style="color: #888; font-size: 13px;" class="mt-3">Belum punya akun? 
    <a href="{{ route('register') }}" style="color: #D4AF37; text-decoration: none; font-weight: bold;">Daftar Akun</a>
</p>
    </form>
</div>

</body>
</html>