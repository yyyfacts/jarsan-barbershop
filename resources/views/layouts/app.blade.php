<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ $setting->app_name ?? 'Jarsan Barbershop' }}</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,700;1,700&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
    :root {
        --deep-charcoal: #0a0a0a;
        --matte-black: #121212;
        --luxury-gold: #D4AF37;
        --gold-accent: rgba(212, 175, 55, 0.5);
        --metallic-red: #960018;
        --glass-bg: rgba(255, 255, 255, 0.05);
        --text-light: #ffffff;
        --font-main: 'Montserrat', sans-serif;
        --font-heading: 'Playfair Display', serif;
    }

    body {
        background-color: var(--deep-charcoal);
        color: var(--text-light) !important;
        font-family: var(--font-main);
        overflow-x: hidden;
    }

    p,
    h1,
    h2,
    h3,
    h4,
    h5,
    span,
    div,
    li,
    a {
        color: var(--text-light);
    }

    .text-muted {
        color: #e0e0e0 !important;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    .navbar-brand,
    .luxury-font {
        font-family: var(--font-heading);
        color: var(--text-light);
    }

    .text-gold {
        color: var(--luxury-gold) !important;
    }

    .bg-matte {
        background-color: var(--matte-black);
    }

    .letter-spacing-2 {
        letter-spacing: 2px;
    }

    /* --- CIRCULAR PRE-LOADER --- */
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--deep-charcoal);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .loader-container {
        position: relative;
        width: 150px;
        height: 150px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .loader-logo {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        object-fit: cover;
        position: relative;
        z-index: 2;
        animation: pulse-logo 2.5s infinite ease-in-out;
    }

    .loader-ring {
        position: absolute;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        border: 2px solid transparent;
        border-top-color: var(--luxury-gold);
        border-left-color: var(--gold-accent);
        z-index: 1;
        animation: spin-ring 1.5s linear infinite;
    }

    @keyframes pulse-logo {

        0%,
        100% {
            transform: scale(0.95);
            opacity: 0.9;
        }

        50% {
            transform: scale(1);
            opacity: 1;
            box-shadow: 0 0 25px rgba(212, 175, 55, 0.6);
        }
    }

    @keyframes spin-ring {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* --- LUXURY NAVBAR --- */
    .navbar-luxury {
        background: rgba(10, 10, 10, 0.95);
        backdrop-filter: blur(15px);
        border-bottom: 1px solid var(--gold-accent);
        padding: 1rem 0;
    }

    .nav-link {
        color: #ffffff !important;
        font-weight: 500;
        letter-spacing: 1px;
        transition: 0.3s;
        font-size: 0.9rem;
        position: relative;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 0;
        background-color: var(--luxury-gold);
        transition: width 0.3s;
    }

    .nav-link:hover::after,
    .nav-link.active::after {
        width: 100%;
    }

    .nav-link:hover,
    .nav-link.active {
        color: var(--luxury-gold) !important;
    }

    /* --- TOGGLER (HAMBURGER MENU) STYLING --- */
    .navbar-toggler {
        border-color: var(--luxury-gold) !important;
        color: var(--luxury-gold) !important;
    }

    .navbar-toggler:focus {
        box-shadow: 0 0 10px rgba(212, 175, 55, 0.5);
    }

    /* Styling Menu Saat Dibuka di HP */
    @media (max-width: 991px) {
        .navbar-collapse {
            background: rgba(15, 15, 15, 0.98);
            padding: 20px;
            margin-top: 15px;
            border-radius: 5px;
            border: 1px solid var(--gold-accent);
        }

        .nav-item {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding: 10px 0;
        }

        .nav-item:last-child {
            border-bottom: none;
        }
    }

    /* --- USER DROPDOWN --- */
    .user-dropdown-toggle {
        display: flex;
        align-items: center;
        gap: 10px;
        background: transparent;
        border: 1px solid var(--gold-accent);
        padding: 5px 15px 5px 5px;
        border-radius: 50px;
        color: white !important;
        transition: 0.3s;
        cursor: pointer;
    }

    .user-dropdown-toggle:hover {
        background: rgba(212, 175, 55, 0.1);
        border-color: var(--luxury-gold);
    }

    .user-avatar-small {
        width: 35px;
        height: 35px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid var(--luxury-gold);
    }

    .custom-dropdown-menu {
        background: #1a1a1a;
        border: 1px solid var(--gold-accent);
        border-radius: 0;
        margin-top: 10px !important;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
    }

    .custom-dropdown-item {
        color: white !important;
        padding: 10px 20px;
        transition: 0.2s;
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .custom-dropdown-item:hover {
        background: var(--luxury-gold) !important;
        color: black !important;
    }

    .custom-dropdown-item i {
        margin-right: 10px;
        color: var(--luxury-gold);
    }

    .custom-dropdown-item:hover i {
        color: black;
    }

    .btn-gold-luxury {
        background: linear-gradient(45deg, var(--luxury-gold), #fff0d1);
        border: none;
        color: #000000;
        font-weight: 700;
        letter-spacing: 1px;
        border-radius: 2px;
        transition: 0.4s;
    }

    .btn-gold-luxury:hover {
        background: linear-gradient(45deg, #fff0d1, var(--luxury-gold));
        box-shadow: 0 5px 20px rgba(212, 175, 55, 0.5);
        color: #000;
    }

    .hover-gold:hover {
        color: var(--luxury-gold) !important;
    }
    </style>
    @stack('styles')
</head>

<body>

    <div id="preloader">
        <div class="loader-container">
            @if($setting && $setting->logo_path)
            <img src="{{ $setting->logo_path }}" class="loader-logo" alt="Jarsan Logo">
            @else
            <div class="loader-logo d-flex align-items-center justify-content-center bg-matte fs-1 fw-bold text-gold"
                style="border: 2px solid var(--luxury-gold);">J</div>
            @endif
            <div class="loader-ring"></div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-luxury sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('welcome') }}">
                @if($setting && $setting->logo_path)
                <img src="{{ $setting->logo_path }}" alt="Logo" height="50" class="me-3 rounded-circle"
                    style="border: 2px solid var(--luxury-gold); padding: 2px;">
                @endif
                <div>
                    <span class="d-block fw-bold lh-1 text-white">{{ $setting->app_name ?? 'JARSAN' }}</span>
                    <span class="small text-gold letter-spacing-2"
                        style="font-size: 0.6rem; font-family: var(--font-main);">BARBERSHOP</span>
                </div>
            </a>

            {{-- TOMBOL HAMBURGER (MUNCUL DI HP) --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- MENU UTAMA --}}
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-3 align-items-lg-center">
                    <li class="nav-item"><a class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                            href="{{ route('welcome') }}">BERANDA</a></li>
                    <li class="nav-item"><a class="nav-link {{ Request::is('about') ? 'active' : '' }}"
                            href="{{ route('about') }}">ABOUT</a></li>
                    <li class="nav-item"><a class="nav-link {{ Request::is('barberman') ? 'active' : '' }}"
                            href="{{ route('barberman') }}">BARBERMAN</a></li>
                    <li class="nav-item"><a class="nav-link {{ Request::is('pricelist') ? 'active' : '' }}"
                            href="{{ route('pricelist') }}">LAYANAN</a></li>
                    <li class="nav-item"><a class="nav-link {{ Request::is('contact') ? 'active' : '' }}"
                            href="{{ route('contact') }}">KONTAK</a></li>

                    @guest
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a href="{{ route('login') }}" class="btn btn-outline-light rounded-0 px-4 py-2 w-100"
                            style="border-color: var(--luxury-gold); color: var(--luxury-gold);">LOGIN</a>
                    </li>
                    <li class="nav-item mt-2 mt-lg-0">
                        <a href="{{ route('reservasi') }}" class="btn btn-gold-luxury px-4 py-2 w-100">BOOK NOW</a>
                    </li>
                    @else
                    <li class="nav-item dropdown ms-lg-2 mt-2 mt-lg-0">
                        <a class="nav-link user-dropdown-toggle justify-content-center justify-content-lg-start"
                            href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ Auth::user()->avatar_blob ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=D4AF37&color=000' }}"
                                class="user-avatar-small" alt="Profile">
                            <span
                                class="small fw-bold text-uppercase ms-1">{{ Str::limit(Auth::user()->name, 10) }}</span>
                            <i class="bi bi-chevron-down small ms-1" style="font-size: 0.7rem;"></i>
                        </a>

                        <ul class="dropdown-menu custom-dropdown-menu dropdown-menu-end"
                            aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item custom-dropdown-item" href="{{ route('dashboard') }}"><i
                                        class="bi bi-speedometer2"></i> Dashboard</a></li>
                            <li><a class="dropdown-item custom-dropdown-item" href="{{ route('profile.edit') }}"><i
                                        class="bi bi-person-gear"></i> Edit Profile</a></li>
                            <li>
                                <hr class="dropdown-divider bg-secondary">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item custom-dropdown-item w-100 text-start">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item mt-2 mt-lg-0">
                        <a href="{{ route('reservasi') }}" class="btn btn-gold-luxury px-4 py-2 w-100">BOOK</a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="py-5 bg-matte" style="border-top: 1px solid #333; margin-top: 50px;">
        <div class="container text-center">
            <h2 class="text-gold mb-4 fw-bold letter-spacing-2">{{ $setting->app_name ?? 'JARSAN BARBERSHOP' }}</h2>
            <div class="mb-4 d-flex justify-content-center gap-4">
                <a href="https://www.instagram.com/jarsan_barbershop" target="_blank"
                    class="text-white fs-4 hover-gold"><i class="bi bi-instagram"></i></a>
                <a href="https://www.tiktok.com/@jarsan_barbershop" target="_blank"
                    class="text-white fs-4 hover-gold"><i class="bi bi-tiktok"></i></a>
            </div>
            <p class="text-white small mb-0">© {{ date('Y') }} {{ $setting->app_name ?? 'Jarsan Barbershop' }}. <br
                    class="d-md-none">Luxury Grooming for Every Gentleman.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/gsap.min.js"></script>
    <script>
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });

    window.addEventListener('load', function() {
        const tl = gsap.timeline();
        tl.to(".loader-logo", {
                scale: 1.1,
                opacity: 0,
                duration: 0.5,
                ease: "power2.in"
            })
            .to(".loader-ring", {
                scale: 0.1,
                opacity: 0,
                duration: 0.5
            }, "-=0.3")
            .to("#preloader", {
                yPercent: -100,
                duration: 0.8,
                ease: "expo.inOut"
            });
    });
    </script>
    @stack('scripts')
</body>

</html>