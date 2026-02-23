@extends('layouts.app')

@section('title', 'Goscinny Hall Reservation')

@section('content')

<style>
    /* Global Theme Background untuk halaman ini */
    body {
        background-color: #121212;
        color: #eeeeee;
        /* margin-top: 76px; */
    /* z-index: 1; */

    }

    .section-header {
        margin-bottom: 50px;
        
    }

    .section-header h2 {
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .section-header .underline {
        width: 80px;
        height: 4px;
        background: #ffc107;
        margin: 10px auto;
        border-radius: 2px;
    }

    /* Container utama kartu */
    .flip-card {
        background-color: transparent;
        height: 450px;
        perspective: 1000px;
    }

    /* Container untuk animasi rotasi */
    .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
        transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        transform-style: preserve-3d;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        border-radius: 15px;
    }

    /* Efek hover untuk memutar kartu */
    .flip-card:hover .flip-card-inner {
        transform: rotateY(180deg);
    }

    /* Pengaturan posisi depan dan belakang */
    .flip-card-front, .flip-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        border-radius: 15px;
        overflow: hidden;
        border: 1px solid #333;
    }

    /* --- SISI DEPAN --- */
    .flip-card-front {
        background-color: #1e1e1e;
        color: white;
        display: flex;
        flex-direction: column;
    }

    .flip-card-front img {
        height: 280px;
        object-fit: cover;
        filter: brightness(0.8);
        transition: 0.5s;
    }

    .flip-card:hover .flip-card-front img {
        filter: brightness(1);
    }

    .img-overlay-line {
        height: 4px;
        background: #ffc107;
        width: 100%;
    }

    .flip-card-front .card-body {
        flex-grow: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(to bottom, #1e1e1e, #121212);
    }

    .flip-card-front .card-title {
        font-size: 1.4rem;
        font-weight: 700;
        margin: 0;
        color: #f8f9fa;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    /* --- SISI BELAKANG --- */
    .flip-card-back {
        background: linear-gradient(135deg, #252525 0%, #121212 100%);
        color: #eeeeee;
        transform: rotateY(180deg);
        padding: 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border: 1px solid #ffc107; /* Aksen border emas di belakang */
    }

    .flip-card-back h5 {
        color: #ffc107;
        font-weight: bold;
        margin-bottom: 15px;
        text-transform: uppercase;
    }

    .flip-card-back p {
        font-size: 0.95rem;
        line-height: 1.6;
        color: #ccc;
    }

    /* Tombol Gold Custom */
    .btn-gold {
        background-color: #ffc107;
        color: #000;
        font-weight: 800;
        border-radius: 50px;
        padding: 12px 30px;
        transition: all 0.3s ease;
        border: none;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
    }

    .btn-gold:hover {
        background-color: #ffffff;
        color: #000;
        transform: scale(1.05);
        box-shadow: 0 0 20px rgba(255, 193, 7, 0.4);
    }

    /* Grid Spacing */
    .g-custom {
        --bs-gutter-x: 2rem;
        --bs-gutter-y: 2rem;
    }
</style>

<div class="container py-5">
    <div class="section-header text-center">
        <h2 class="text-white">Daftar <span style="color: #ffc107;">Lapangan</span></h2>
        <div class="underline"></div>
        <p class="text-white-50">Pilih arena favoritmu dan rasakan pengalaman bermain yang luar biasa.</p>
    </div>

    <div class="row justify-content-center g-custom">
        @foreach($Hall as $hall)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="flip-card">
                <div class="flip-card-inner">

                    <div class="flip-card-front">
                        <img src="{{ $hall['pathGambar'] }}" alt="{{ $hall['name'] }}">
                        <div class="img-overlay-line"></div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $hall['name'] }}</h5>
                        </div>
                    </div>

                    <div class="flip-card-back">
                        <h5>{{ $hall['name'] }}</h5>
                        <p class="mb-4">{{ \Illuminate\Support\Str::limit($hall['description'], 120) }}</p>
                        <a href="/booking/create/{{ $hall['id'] }}" class="btn btn-gold shadow">
                            <i class="bi bi-calendar-check me-2"></i>Booking Now
                        </a>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
