<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HallController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk SEMUA USER yang sudah login (Auth)
Route::middleware('auth')->group(function () {

    // --- AREA USER BIASA ---
    Route::get('/hall', [HallController::class, 'index'])->name('hall.index');
    Route::get('/booking/create/{id}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/mybooking', [BookingController::class, 'myhistory'])->name('booking.myhistory');

    // Fitur Riwayat User (Jika sudah ada methodnya)
    // Route::get('/my-bookings', [BookingController::class, 'myHistory'])->name('booking.my-history');

    // --- AREA KHUSUS ADMIN ---
    // Gunakan prefix 'admin' agar URL menjadi /admin/booking
    Route::middleware(['can:admin-only'])->prefix('admin')->group(function () {

        // Menampilkan antrian reservasi (URL: /admin/booking)
        Route::get('/booking', [BookingController::class, 'index'])->name('bookings.index');

        // Update Status (URL: /admin/booking/{id}/status)
        // Di dalam routes/web.php

        Route::patch('/booking/{id}/status', [BookingController::class, 'updateStatus'])->name('booking.update-status');

        // Detail per aula (URL: /admin/halls/{id}/reservations)
        Route::get('/halls/{id}/reservations', [HallController::class, 'showReservations'])->name('admin.hall.reservations');
    });
});

require __DIR__ . '/auth.php';
