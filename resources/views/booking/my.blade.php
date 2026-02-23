@extends('layouts.app')

@section('content')
<div class="container-fluid py-5" style="background-color: #121212; min-height: 100vh; color: white;">
    <div class="container">
        <div class="row mb-5 text-center">
            <div class="col">
                <h2 class="fw-bold text-uppercase" style="letter-spacing: 2px;">
                    RIWAYAT <span style="color: #FFC107;">RESERVASI</span>
                </h2>
                <div style="width: 80px; height: 3px; background-color: #FFC107; margin: 10px auto;"></div>
                <p class="text-secondary mt-3">Pantau status reservasi arena favoritmu di sini.</p>
            </div>
        </div>

        <div class="card border-0 shadow-lg" style="background-color: #1e1e1e; border-radius: 15px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0" style="background-color: #1e1e1e;">
                        <thead style="border-bottom: 2px solid #FFC107;">
                            <tr>
                                <th class="px-4 py-4 text-secondary">ID</th>
                                <th class="py-4 text-secondary">AULA / GEDUNG</th>
                                <th class="py-4 text-secondary">TANGGAL</th>
                                <th class="py-4 text-secondary">WAKTU</th>
                                <th class="py-4 text-secondary">TOTAL</th>
                                <th class="py-4 text-secondary text-center">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                            <tr class="align-middle" style="border-bottom: 1px solid #333;">
                                <td class="px-4 text-secondary">#{{ $booking->id }}</td>
                                <td class="fw-bold text-white">
                                    {{ $booking->hall->name ?? 'Gedung tidak ditemukan' }}
                                </td>
                                <td class="text-white">{{ \Carbon\Carbon::parse($booking->date)->format('d M Y') }}</td>
                                <td class="text-white">
                                    {{ $booking->start_time }} 
                                    <span class="badge bg-secondary ms-2" style="font-size: 0.7rem;">{{ $booking->duration_hours }} Jam</span>
                                </td>
                                <td style="color: #FFC107; font-weight: bold;">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    @if($booking->status == 'pending')
                                        <span class="badge rounded-pill border border-warning text-warning px-3 py-2">MENUNGGU</span>
                                    @elseif($booking->status == 'confirmed')
                                        <span class="badge rounded-pill bg-success px-3 py-2">BERHASIL</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger px-3 py-2">BATAL</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="bi bi-calendar-x d-block mb-3" style="font-size: 3rem; color: #333;"></i>
                                        <p class="text-secondary">Anda belum memiliki riwayat reservasi.</p>
                                        <a href="{{ route('booking.index') }}" class="btn btn-warning mt-2 fw-bold" style="background-color: #FFC107;">BOOKING SEKARANG</a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Menghilangkan border default bootstrap yang mengganggu tema gelap */
    .table > :not(caption) > * > * {
        background-color: transparent !important;
        box-shadow: none !important;
    }
    .table-hover tbody tr:hover {
        background-color: #252525 !important;
        transition: 0.3s;
    }
    .btn-outline-warning:hover {
        background-color: #FFC107 !important;
        color: black !important;
    }
</style>
@endsection