<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Reservasi - {{ $hall->nama_hall }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #121212; /* Warna gelap agar kontras dengan tabel */
            color: #eee;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .btn-gold {
            border-color: #D4AF37;
            color: #D4AF37;
        }
        .btn-gold:hover {
            background-color: #D4AF37;
            color: #000;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div style="border-left: 5px solid #D4AF37; padding-left: 15px;">
            <h2 style="color: #D4AF37; font-weight: bold; margin: 0;">RIWAYAT: {{ strtoupper($hall->nama_hall) }}</h2>
            <small style="color: #888;">Menampilkan semua riwayat pesanan (Urutan Terbaru).</small>
        </div>
        <a href="{{ route('bookings.index') }}" class="btn btn-outline-secondary btn-gold">
            &larr; Kembali ke Antrian
        </a>
    </div>

    <div class="table-responsive mb-5" style="background-color: #1e1e1e; border-radius: 15px; border: 1px solid #333; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
        <table class="table table-hover" style="color: #fff; margin-bottom: 0;">
            <thead style="background-color: #2a2a2a; color: #D4AF37; border-bottom: 2px solid #D4AF37;">
                <tr>
                    <th class="py-3 px-4">Nama User</th>
                    <th class="py-3 px-4">Tanggal Booking</th>
                    <th class="py-3 px-4">Waktu</th>
                    <th class="py-3 px-4 text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                <tr style="border-bottom: 1px solid #333; vertical-align: middle;">
                    <td class="px-4">{{ $booking->user->name ?? 'N/A' }}</td>
                    <td class="px-4">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') }}</td>
                    <td class="px-4">{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                    <td class="text-center">
                        <span class="badge" style="padding: 8px 15px; border-radius: 20px; font-size: 11px;
                            background-color: {{ $booking->status == 'confirmed' ? '#28a745' : ($booking->status == 'cancelled' ? '#dc3545' : '#D4AF37') }};
                            color: {{ $booking->status == 'pending' ? '#000' : '#fff' }};">
                            {{ strtoupper($booking->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-5" style="color: #666;">Belum ada riwayat reservasi untuk aula ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
