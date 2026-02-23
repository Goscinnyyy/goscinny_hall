<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Reservasi Web')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Tema Dasar Dark Gold */
        body {
            background-color: #121212; /* Latar belakang hitam pekat */
            color: #e0e0e0;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Memberikan ruang agar konten tidak tertutup navbar fixed */
        main {
            padding-top: 78px; /* Jarak aman dari navbar */
            /* padding-bottom: 50px; */
        }

        /* Style tambahan untuk elemen global jika diperlukan */
        .navbar-reduced-opacity {
            background-color: rgba(18, 18, 18, 0.85) !important;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        /* Warna scrollbar agar senada dengan tema dark */
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #1a1a1a;
        }
        ::-webkit-scrollbar-thumb {
            background: #D4AF37; 
            border-radius: 5px;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Content --}}
    <main class="flex-grow-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

    <script>
        window.onscroll = function() {
            var nav = document.getElementById('mainNavbar');
            if (nav) {
                if (window.pageYOffset > 20) {
                    nav.classList.add("navbar-reduced-opacity");
                } else {
                    nav.classList.remove("navbar-reduced-opacity");
                }
            }
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')

</body>
</html>