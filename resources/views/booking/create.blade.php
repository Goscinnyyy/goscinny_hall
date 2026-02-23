@extends('layouts.app')

@section('content')
<style>
    /* Custom Styling sesuai tema GoscinnyHall */
    body {
        margin-top: 50px;
        background-color: #121212;
        color: #eeeeee;
    }
    .booking-card {
        background: #1e1e1e;
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }
    .time-slot-btn {
        transition: all 0.3s ease;
        border-radius: 8px;
        font-weight: 600;
        margin-bottom: 5px;
    }
    .btn-available {
        border: 2px solid #ffc107;
        color: #ffc107;
    }
    .btn-available:hover {
        background: #ffc107;
        color: #000;
    }
    .btn-selected {
        background: #ffc107 !important;
        color: #000 !important;
        border: 2px solid #ffc107 !important;
        transform: scale(1.05);
    }
    .btn-booked {
        background: #333 !important;
        border: 1px solid #444 !important;
        color: #777 !important;
        text-decoration: line-through;
    }
    .section-title {
        border-left: 5px solid #ffc107;
        padding-left: 15px;
        font-weight: bold;
        color: #fff;
    }

    /* Dark Theme FullCalendar */
    .calendar-container {
        background: #252525 !important;
        border: 1px solid #3d3d3d;
        border-radius: 15px;
        padding: 20px;
    }
    .fc {
        --fc-border-color: #3d3d3d;
        --fc-page-bg-color: transparent;
        color: #ffffff;
    }
    .fc .fc-toolbar-title {
        font-size: 1.2rem;
        font-weight: bold;
        text-transform: uppercase;
        color: #ffc107;
    }
    .fc .fc-col-header-cell-cushion, .fc .fc-daygrid-day-number {
        color: #ffffff;
        text-decoration: none;
    }
    .fc .fc-day-today {
        background: rgba(255, 193, 7, 0.1) !important;
    }
    .selected-day {
        background: #ffc107 !important;
    }
    .selected-day .fc-daygrid-day-number {
        color: #000 !important;
        font-weight: bold;
    }
    .fc .fc-button-primary {
        background-color: transparent !important;
        border: 1px solid #ffc107 !important;
        color: #ffc107 !important;
    }
    .fc .fc-button-primary:hover {
        background-color: #ffc107 !important;
        color: #000 !important;
    }

    /* Styling khusus untuk tanggal yang tidak aktif */
    .fc-day-past-disabled {
        background-color: rgba(0, 0, 0, 0.4) !important;
        opacity: 0.3;
        cursor: not-allowed !important;
    }
</style>

<div class="container-flui mt-5 mb-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="text-white">Reservasi <span style="color: #ffc107;">{{ $hall->name }}</span></h2>
        </div>
    </div>

    <div class="mb-3">
        <a href="{{ route('hall.index') }}" class="btn" style="background-color: #ffc107; color: black;">
            ← Kembali
        </a>
    </div>

    <div class="card booking-card shadow-lg">
        <div class="row g-0">
            <div class="col-lg-5 p-4 border-end border-secondary">
                <h5 class="section-title mb-4">1. Pilih Tanggal</h5>
                <div class="calendar-container shadow-sm">
                    <div id="calendar"></div>
                </div>
            </div>

            <div class="col-lg-7 p-4">
                <h5 class="section-title mb-4">2. Pilih Jam Operasional</h5>

                <div id="dateBadge" class="mb-3 d-none">
                    <span class="badge bg-warning text-dark p-2 fs-6">
                        <i class="bi bi-calendar-check"></i> <span id="selectedDateLabel"></span>
                    </span>
                </div>

                <p id="instructionText" class="text-white-50 italic">
                    <i class="bi bi-info-circle"></i> Silakan klik tanggal pada kalender untuk melihat jam tersedia.
                </p>

                <div id="timeSlots" class="row row-cols-2 row-cols-md-3 g-2 mb-4"></div>

                <form method="POST" action="{{ route('booking.store') }}" id="bookingForm">
                    @csrf
                    <input type="hidden" name="hall_id" value="{{ $hall->id }}">
                    <input type="hidden" name="booking_date" id="booking_date">
                    <input type="hidden" name="start_time" id="start_time">
                    <input type="hidden" name="end_time" id="end_time">

                    <div class="d-grid">
                        <button type="submit" id="bookButton" class="btn btn-warning btn-lg fw-bold d-none shadow">
                            Konfirmasi Booking Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let bookings = @json($bookings);
    let selectedDate = null;

    // Set waktu ke 00:00 agar perbandingan hanya pada tanggal
    let today = new Date();
    today.setHours(0,0,0,0);

    let calendarEl = document.getElementById('calendar');
    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 'auto',
        headerToolbar: {
            left: 'prev',
            center: 'title',
            right: 'next'
        },
        // Memberikan style pada sel kalender
        dayCellDidMount: function(info) {
            let cellDate = info.date;
            cellDate.setHours(0,0,0,0);

            if (cellDate < today) {
                info.el.classList.add('fc-day-past-disabled');
            }
        },
        dateClick: function(info) {
            let clickedDate = new Date(info.dateStr);
            clickedDate.setHours(0,0,0,0);

            // Blokir klik jika tanggal sebelum hari ini
            if (clickedDate < today) return;

            document.querySelectorAll('.fc-daygrid-day').forEach(el => {
                el.classList.remove('selected-day');
            });

            info.dayEl.classList.add('selected-day');
            selectedDate = info.dateStr;

            document.getElementById('instructionText').classList.add('d-none');
            document.getElementById('dateBadge').classList.remove('d-none');
            document.getElementById('selectedDateLabel').innerText = selectedDate;

            generateTimeSlots(selectedDate);
            document.getElementById('bookButton').classList.add('d-none');
        }
    });
    calendar.render();

    function generateTimeSlots(date) {
        let container = document.getElementById('timeSlots');
        container.innerHTML = "";

        for (let hour = 8; hour < 22; hour++) {
            let start = hour.toString().padStart(2, '0') + ":00:00";
            let end = (hour+1).toString().padStart(2, '0') + ":00:00";

            let isBooked = bookings.some(b => b.booking_date === date && b.start_time === start);

            let col = document.createElement("div");
            col.className = "col";

            let button = document.createElement("button");
            button.type = "button";
            button.className = "btn w-100 time-slot-btn";

            if (isBooked) {
                button.classList.add("btn-booked");
                button.innerHTML = `<small>${hour}:00</small>`;
                button.disabled = true;
            } else {
                button.classList.add("btn-available");
                button.innerHTML = `<small>${hour}:00 - ${hour+1}:00</small>`;

                button.addEventListener("click", function() {
                    document.querySelectorAll('.time-slot-btn').forEach(btn => {
                        if(!btn.disabled) {
                            btn.classList.remove('btn-selected');
                            btn.classList.add('btn-available');
                        }
                    });

                    button.classList.remove('btn-available');
                    button.classList.add('btn-selected');

                    document.getElementById('booking_date').value = selectedDate;
                    document.getElementById('start_time').value = start;
                    document.getElementById('end_time').value = end;
                    document.getElementById('bookButton').classList.remove('d-none');
                });
            }
            col.appendChild(button);
            container.appendChild(col);
        }
    }
    document.getElementById('bookingForm').addEventListener('submit', function() {
        let btn = document.getElementById('bookButton');
        btn.disabled = true;
        btn.innerHTML = 'Memproses...';
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cek apakah ada session success dari Controller
    @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            icon: 'success',
            background: '#1e1e1e', // Menyesuaikan tema gelap kamu
            color: '#fff',
            confirmButtonColor: '#ffc107',
            confirmButtonText: 'Oke'
        });
    @endif

    // Cek jika ada error validasi
    @if($errors->any())
        Swal.fire({
            title: 'Ups!',
            text: "Mohon periksa kembali form anda.",
            icon: 'error',
            background: '#1e1e1e',
            color: '#fff',
            confirmButtonColor: '#d33'
        });
    @endif
});
</script>
@endpush
