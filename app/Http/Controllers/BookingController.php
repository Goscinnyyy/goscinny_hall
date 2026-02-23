<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Hall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data booking yang HANYA berstatus pending untuk tabel admin
        $query = Booking::with(['user', 'hall'])->where('status', 'pending');

        // Sesuaikan 'name' atau 'nama_hall' dengan kolom di database Anda
        if ($request->filled('hall')) {
            $query->whereHas('hall', function ($q) use ($request) {
                $q->where('nama_hall', 'like', '%' . $request->hall . '%');
            });
        }

        $bookings = $query->orderBy('booking_date', 'asc')->get();

        // 2. Ambil semua data aula untuk ditampilkan di Card bawah (Panel Admin)
        $halls = Hall::all();

        return view('booking.index', compact('bookings', 'halls'));
    }

    public function create($id) // Pastikan parameter sesuai dengan {id} di route
    {
        $hall = Hall::findOrFail($id);

        // Menampilkan riwayat booking agar user tahu jam yang sudah terisi
        $bookings = Booking::where('hall_id', $id)
            ->where('status', 'confirmed')
            ->get();

        return view('booking.create', compact('hall', 'bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hall_id'      => 'required|exists:halls,id',
            'booking_date' => 'required|date',
            'start_time'   => 'required',
            'end_time'     => 'required',
        ]);

        Booking::create([
            'user_id'      => auth()->id(),
            'hall_id'      => $request->hall_id,
            'booking_date' => $request->booking_date,
            'start_time'   => $request->start_time,
            'end_time'     => $request->end_time,
            'status'       => 'pending',
        ]);

        // Redirect kembali ke halaman form booking user
        return redirect()->route('booking.create', ['id' => $request->hall_id])
            ->with('success', 'Booking berhasil disimpan! Admin akan segera meninjau pesanan Anda.');
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi status sesuai enum: confirmed atau cancelled
        $request->validate([
            'status' => 'required|in:confirmed,cancelled',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update([
            'status' => $request->status,
        ]);

        // Redirect back agar admin tetap di halaman antrian (admin/booking)
        return redirect()->back()->with('success', 'Status berhasil diperbarui menjadi ' . $request->status);
    }
    public function myhistory()
    {

        $bookings = Auth::user()->bookings()->with('hall')->latest()->get();

        return view('booking.my', compact('bookings'));

    }
}
