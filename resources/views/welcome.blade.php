@extends('layouts.app')

@section('title', 'Goscinny Hall Reservation')

@section('content')
<div class="hero-section">
    <div class="hero-overlay">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8 hero-caption">
                    <h1 class="display-3 fw-bold mb-3">Discover Our Library</h1>
                    <p class="fs-5 mb-4 opacity-75">Explore a world of books and reserve your favorites instantly.</p>
                    <div class="d-grid d-sm-flex justify-content-sm-center gap-3">
                        <a href="/hall" class="btn btn-warning btn-lg px-5 py-3 fw-bold">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hero-section {
    /* Path gambar asset */
    background: url('{{ asset("storage/images/carousel_1.jpg") }}') no-repeat center center;
    background-size: cover;
    /* 100vh berarti memenuhi tinggi layar */
    height: 100vh;
    width: 100%;
    position: relative;
    /* Menghilangkan gap jika navbar fixed-top */
    /* margin-top: -76px; 
    z-index: 1; */
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* Overlay hitam transparan agar teks terbaca jelas */
    background: linear-gradient(to bottom, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.7) 100%);
    display: flex;
    align-items: center; /* Menengah secara vertikal */
    justify-content: center; /* Menengah secara horizontal */
}

.hero-caption {
    text-align: center;
    color: #ffffff;
    padding: 0 15px;
    animation: slideUp 1.2s ease-out forwards;
}

.hero-caption h1 {
    text-shadow: 0 4px 15px rgba(0,0,0,0.5);
    letter-spacing: -1px;
}

@keyframes slideUp {
    0% {
        transform: translateY(40px);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}

.hero-caption .btn-warning {
    color: #000;
    border: none;
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(255, 193, 7, 0.2);
}

.hero-caption .btn-warning:hover {
    transform: translateY(-5px);
    background-color: #ffca2c;
    box-shadow: 0 15px 30px rgba(255, 193, 7, 0.4);
}

/* Responsivitas untuk layar kecil */
@media (max-width: 768px) {
    .hero-section {
        height: 80vh; /* Sedikit lebih pendek di mobile agar tidak terlalu jauh scrollnya */
    }
    .hero-caption h1 {
        font-size: 2.5rem;
    }
}
</style>
@endsection