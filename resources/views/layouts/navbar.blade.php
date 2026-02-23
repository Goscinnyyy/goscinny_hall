<nav class="navbar navbar-expand-lg navbar-dark fixed-top py-3" id="mainNavbar">
  <div class="container-fluid px-lg-5">
    <a class="navbar-brand fw-bold fs-4" href="{{ url('/') }}">GoscinnyHall</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('hall*') || request()->is('booking*') ? 'active' : '' }}" href="{{ url('/hall') }}">Booking Hall</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('mybooking*') ? 'active' : '' }}" href="{{ url('/mybooking') }}">My History</a>
        </li>

        {{-- Fitur Log Out --}}
        @auth
        <li class="nav-item ms-lg-3">
          <form method="POST" action="{{ route('logout') }}" id="logout-form">
            @csrf
            <button type="button" onclick="confirmLogout()" class="btn nav-link fw-bold" 
                    style="color: #ffc107 !important; border: 1px solid rgba(255, 193, 7, 0.5); padding: 5px 15px; border-radius: 8px;">
              LOG OUT
            </button>
          </form>
        </li>
        @else
        <li class="nav-item ms-lg-3">
          <a class="nav-link fw-bold" href="{{ route('login') }}" style="color: #ffc107 !important;">LOGIN</a>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

{{-- Script SweetAlert untuk Konfirmasi Logout --}}
@push('scripts')
<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Keluar sistem?',
            text: "Sesi Anda akan dihentikan.",
            icon: 'warning',
            showCancelButton: true,
            background: '#1e1e1e',
            color: '#ffc107',
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Logout!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        })
    }
</script>
@endpush