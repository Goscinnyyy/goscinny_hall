<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Reservasi - Admin Panel</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #121212;
            color: #eee;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            padding-bottom: 50px;
        }
        
        /* Memastikan warna teks navbar mengikuti tema Anda */
        .navbar-dark-custom {
            background-color: #1e1e1e;
            border-bottom: 1px solid #333;
        }

        .form-control:focus {
            background-color: #2a2a2a;
            border-color: #D4AF37;
            color: #fff;
            box-shadow: none;
        }

        .hall-card {
            background-color: #1e1e1e; 
            border: 1px solid #444; 
            border-radius: 12px; 
            transition: transform 0.3s ease, border-color 0.3s ease;
            text-decoration: none;
            display: block;
        }
        
        .hall-card:hover {
            transform: translateY(-10px);
            border-color: #D4AF37;
        }

        .btn-gold {
            background-color: #D4AF37;
            color: #000;
            font-weight: bold;
            border: none;
        }

        .btn-gold:hover {
            background-color: #b8962d;
            color: #000;
        }

        .table-responsive::-webkit-scrollbar {
            height: 8px;
        }
        .table-responsive::-webkit-scrollbar-thumb {
            background: #444;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-dark-custom mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#" style="color: #D4AF37;">ADMIN PANEL</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item me-3">
                    <span class="nav-link disabled text-secondary">
                        Halo, {{ Auth::user()->name ?? 'Admin' }}
                    </span>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-danger btn-sm fw-bold" 
                       href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        LOGOUT
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

<div class="container py-2">
    {{-- Header Halaman --}}
    <div class="mb-4" style="border-left: 5px solid #D4AF37; padding-left: 15px;">
        <h2 style="color: #D4AF37; font-weight: bold; margin: 0;">PERMINTAAN RESERVASI (PENDING)</h2>
        <p class="text-secondary m-0">Hanya menampilkan pesanan yang butuh konfirmasi manual.</p>
    </div>

    {{-- Form Filter --}}
    <div class="mb-4 p-4" style="background-color: #1e1e1e; border-radius: 10px; border: 1px solid #333;">
        <form action="{{ route('booking.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-9">
                <label class="form-label" style="color: #D4AF37; font-size: 13px;">Cari Nama Aula di Antrian</label>
                <input type="text" name="hall" class="form-control" placeholder="Masukkan nama aula..." 
                       value="{{ request('hall') }}"
                       style="background-color: #2a2a2a; border: 1px solid #444; color: #fff;">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-gold w-100">Filter</button>
                <a href="{{ route('booking.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
            </div>
        </form>
    </div>

    {{-- Tabel Reservasi Pending --}}
    <div class="table-responsive mb-5" style="background-color: #1e1e1e; border-radius: 15px; border: 1px solid #333; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
        <table class="table table-hover" style="color: #fff; margin-bottom: 0;">
            <thead style="background-color: #2a2a2a; color: #D4AF37; border-bottom: 2px solid #D4AF37;">
                <tr>
                    <th class="py-3 px-4">Nama User</th>
                    <th class="py-3 px-4">Nama Aula</th>
                    <th class="py-3 px-4">Tanggal</th>
                    <th class="py-3 px-4">Waktu</th>
                    <th class="py-3 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                <tr style="border-bottom: 1px solid #333; vertical-align: middle;">
                    <td class="px-4">{{ $booking->user->name ?? 'N/A' }}</td>
                    <td class="px-4">{{ $booking->hall->name ?? 'N/A' }}</td>
                    <td class="px-4">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                    <td class="px-4 text-nowrap">{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                    <td class="text-center px-4">
                        <div class="d-flex gap-2 justify-content-center">
                            <form action="{{ route('booking.update-status', $booking->id) }}" method="POST">
                                @csrf 
                                @method('PATCH')
                                <input type="hidden" name="status" value="confirmed">
                                <button type="submit" class="btn btn-sm btn-success px-3" style="font-weight: bold; border-radius: 5px;">Approve</button>
                            </form>
                            <form action="{{ route('booking.update-status', $booking->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" class="btn btn-sm btn-danger px-3" style="font-weight: bold; border-radius: 5px;">Decline</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5" style="color: #666;">Tidak ada permintaan reservasi baru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Bagian Card Aula untuk Riwayat Detail --}}
    <div class="mt-5 mb-4" style="border-left: 5px solid #D4AF37; padding-left: 15px;">
        <h2 style="color: #D4AF37; font-weight: bold; margin: 0;">DETAIL RESERVASI PER AULA</h2>
        <p class="text-secondary m-0">Klik kartu untuk melihat riwayat lengkap per lokasi.</p>
    </div>

    <div class="row g-4">
        @foreach($halls as $hall)
        <div class="col-md-4">
            <a href="{{ route('admin.hall.reservations', $hall->id) }}" class="hall-card h-100">
                <div class="card-body p-4">
                    <h4 style="color: #D4AF37; font-weight: bold;">{{ $hall->name }}</h4>
                    <p style="color: #aaa; font-size: 14px; margin-bottom: 20px;">
                        Lihat semua riwayat penggunaan, jadwal yang disetujui, maupun yang dibatalkan di aula ini.
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="color: #888; font-size: 12px;">Klik untuk Detail</span>
                        <span style="color: #D4AF37; font-size: 1.2rem;">&rarr;</span>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>