<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- JUDUL DINAMIS: Mengambil Nama Aplikasi dari Database --}}
    <title>@yield('title') - {{ $setting->app_name ?? 'Jarsan Barbershop' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
    }

    .navbar-brand {
        font-weight: bold;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .bg-black {
        background-color: #000 !important;
    }

    /* Menu Link Style */
    .navbar-dark .navbar-nav .nav-link {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.95rem;
        margin: 0 5px;
        transition: 0.3s;
    }

    .navbar-dark .navbar-nav .nav-link:hover,
    .navbar-dark .navbar-nav .nav-link.active {
        color: #fff;
        font-weight: 600;
    }
    </style>
    @stack('styles')
</head>

<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-black py-3 sticky-top shadow-sm">
        <div class="container">

            {{-- LOGO & NAMA WEBSITE DINAMIS --}}
            <a class="navbar-brand d-flex align-items-center" href="{{ route('welcome') }}">
                @if(isset($setting) && !empty($setting->logo_path))
                {{-- OPSI 1: Jika Admin sudah upload logo --}}
                <img src="{{ $setting->logo_path }}" alt="Logo" height="40" class="me-2 object-fit-contain">
                @else
                {{-- OPSI 2: Logo Default (Bawaan Codingan) --}}
                <img src="{{ asset('images/logo jarsan.png') }}" alt="Logo" height="40" class="me-2">
                @endif

                {{-- Nama Website dari Database --}}
                {{ $setting->app_name ?? 'JARSAN BARBERSHOP' }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">

                    {{-- DAFTAR MENU LENGKAP --}}
                    <li class="nav-item"><a class="nav-link" href="{{ route('welcome') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('barberman') }}">Barberman</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('pricelist') }}">Price List</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('reservasi') }}">Reservasi</a></li>

                    {{-- LOGIKA TOMBOL KANAN (Login/Logout) --}}
                    @guest
                    {{-- Kalau Belum Login --}}
                    <li class="nav-item ms-lg-3">
                        <a href="{{ route('login') }}"
                            class="btn btn-outline-light rounded-pill px-4 btn-sm fw-bold">Login</a>
                    </li>
                    @else
                    {{-- Kalau Sudah Login --}}
                    <li class="nav-item ms-lg-3">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light rounded-0 px-3 btn-sm">Logout</button>
                        </form>
                    </li>
                    @endguest

                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container text-center">
            {{-- COPYRIGHT DINAMIS --}}
            <small>&copy; {{ date('Y') }} {{ $setting->app_name ?? 'Jarsan Barbershop' }}. All Rights Reserved.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>