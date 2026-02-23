<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | GoscinnyHall</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #121212; font-family: 'Segoe UI', sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
        .register-card { width: 100%; max-width: 450px; background-color: #1e1e1e; padding: 40px; border-radius: 15px; border: 1px solid #D4AF37; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .form-control { background-color: #2a2a2a !important; border: 1px solid #444 !important; color: #fff !important; }
        .form-control:focus { border-color: #D4AF37 !important; box-shadow: none !important; }
        .btn-gold { background-color: #D4AF37; color: #000; font-weight: bold; padding: 12px; border-radius: 8px; border: none; width: 100%; transition: 0.3s; }
        .btn-gold:hover { background-color: #b8952e; }
        label { color: #D4AF37; font-size: 13px; margin-bottom: 5px; }
    </style>
</head>
<body>

<div class="register-card">
    <div class="text-center mb-4">
        <h2 style="color: #D4AF37; font-weight: bold; letter-spacing: 2px;">REGISTER</h2>
        <p style="color: #888; font-size: 14px;">Buat akun untuk mulai reservasi aula</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="name" class="form-control shadow-none" value="{{ old('name') }}" required autofocus>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Alamat Email</label>
            <input type="email" name="email" class="form-control shadow-none" value="{{ old('email') }}" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Kata Sandi</label>
                <input type="password" name="password" class="form-control shadow-none" required>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-4">
                <label>Konfirmasi</label>
                <input type="password" name="password_confirmation" class="form-control shadow-none" required>
            </div>
        </div>

        <button type="submit" class="btn-gold">DAFTAR SEKARANG</button>

        <div class="text-center mt-4">
            <p style="color: #888; font-size: 13px;">Sudah punya akun? 
                <a href="{{ route('login') }}" style="color: #D4AF37; text-decoration: none; font-weight: bold;">Login di sini</a>
            </p>
        </div>
    </form>
</div>

</body>
</html>