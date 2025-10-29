<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/logo jarsan.png') }}" alt="Logo Jarsan" 
                 class="me-2" style="height: 45px; width: auto;">
            <span class="fw-bold fs-5 text-uppercase">Jarsan Barbershop</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('barberman') ? 'active' : '' }}" href="{{ url('/barberman') }}">Barberman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('pricelist') ? 'active' : '' }}" href="{{ url('/pricelist') }}">Price List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}">Kontak</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-secondary text-white ms-2 btn-login" href="{{ url('/login') }}">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@push('styles')
<style>
.navbar-nav .nav-link {
    color: rgba(255,255,255,0.7);
    transition: color 0.3s ease;
}

.navbar-nav .nav-link:hover {
    color: #ffffff;
}

.navbar-nav .nav-link.active {
    color: #ffffff;
    font-weight: 600;
    border-bottom: 2px solid #0dcaf0;
}

/* Gaya tombol login abu-abu */
.btn-login {
    background-color: #6c757d; /* abu-abu Bootstrap */
    border: none;
    transition: background-color 0.3s ease;
}

.btn-login:hover {
    background-color: #5a6268; /* abu-abu lebih gelap saat hover */
}
</style>
@endpush
