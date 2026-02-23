<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hall;
use App\Models\User;
use App\Models\Booking;

class HallController extends Controller
{
   public function index()
   {
    $Hall = Hall::all();
    return view('hall.index', compact('Hall'));
   }
    public function showReservations($id)
{
    $hall = Hall::findOrFail($id);
    // Urutkan berdasarkan waktu booking terbaru
    $bookings = Booking::where('hall_id', $id)
                ->with('user')
                ->orderBy('booking_date', 'desc')
                ->orderBy('start_time', 'desc')
                ->get();

    return view('hall.reservations_detail', compact('hall', 'bookings'));
}
}
