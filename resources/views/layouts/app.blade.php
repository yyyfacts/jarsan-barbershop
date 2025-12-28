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
        --gold-accent: rgba(212, 175, 55, 0.4);
        --text-white: #ffffff;
        --font-main: 'Montserrat', sans-serif;
        --font-heading: 'Playfair Display', serif;
    }

    body {
        background-color: var(--deep-charcoal);
        color: var(--text-white);
        font-family: var(--font-main);
        overflow-x: hidden;
    }

    /* Override Bootstrap Colors for High Contrast */
    .text-muted,
    p,
    span,
    label,
    small {
        color: #ffffff !important;
        opacity: 1 !important;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    .navbar-brand {
        font-family: var(--font-heading);
        color: var(--luxury-gold) !important;
    }

    /* Pre-loader Lingkaran */
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
        }

        50% {
            transform: scale(1);
            box-shadow: 0 0 25px var(--gold-accent);
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

    /* Navbar */
    .navbar-luxury {
        background: rgba(10, 10, 10, 0.95);
        backdrop-filter: blur(15px);
        border-bottom: 1px solid var(--gold-accent);
        padding: 1rem 0;
    }

    .nav-link {
        color: #ffffff !important;
        font-weight: 600;
        letter-spacing: 1px;
        transition: 0.3s;
        font-size: 0.9rem;
    }

    .nav-link:hover,
    .nav-link.active {
        color: var(--luxury-gold) !important;
    }

    /* Mobile Dock */
    @media (max-width: 991px) {
        .mobile-dock {
            position: fixed;
            bottom: 25px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(18, 18, 18, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid var(--luxury-gold);
            border-radius: 50px;
            display: flex;
            padding: 12px 25px;
            z-index: 1000;
            gap: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);
        }

        .mobile-dock a {
            color: #ffffff !important;
            font-size: 1.3rem;
            transition: 0.3s;
            display: flex;
            align-items: center;
        }

        .mobile-dock a.active {
            color: var(--luxury-gold) !important;
            transform: translateY(-3px);
        }

        .navbar-toggler {
            display: none;
        }
    }

    .btn-gold-luxury {
        background: var(--luxury-gold);
        border: none;
        color: #000 !important;
        font-weight: 700;
        letter-spacing: 1px;
        border-radius: 2px;
        transition: 0.4s;
    }

    .btn-gold-luxury:hover {
        background: #ffffff;
        color: #000 !important;
        box-shadow: 0 5px 15px var(--gold-accent);
    }
    </style>
    @stack('styles')
</head>

<body>
    <div id="preloader">
        <div class="loader-container">
            @if($setting && $setting->logo_path)
            <img src="{{ $setting->logo_path }}" class="loader-logo" alt="Logo">
            @else
            <div class="loader-logo d-flex align-items-center justify-content-center bg-dark fs-1 fw-bold text-gold"
                style="border: 2px solid var(--luxury-gold); color: var(--luxury-gold); width: 100%; height: 100%; border-radius: 50%;">
                J</div>
            @endif
            <div class="loader-ring"></div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-luxury sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('welcome') }}">
                @if($setting && $setting->logo_path)
                <img src="{{ $setting->logo_path }}" alt="Logo" height="50"
                    class="me-3 rounded-circle border border-warning">
                @endif
                <span class="fw-bold text-white fs-3">{{ $setting->app_name ?? 'JARSAN' }}</span>
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-3 align-items-center">
                    <li class="nav-item"><a class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                            href="{{ route('welcome') }}">BERANDA</a></li>
                    <li class="nav-item"><a class="nav-link {{ Request::is('about') ? 'active' : '' }}"
                            href="{{ route('about') }}">TENTANG KAMI</a></li>
                    <li class="nav-item"><a class="nav-link {{ Request::is('barberman') ? 'active' : '' }}"
                            href="{{ route('barberman') }}">BARBERMAN</a></li>
                    <li class="nav-item"><a class="nav-link {{ Request::is('pricelist') ? 'active' : '' }}"
                            href="{{ route('pricelist') }}">LAYANAN</a></li>
                    <li class="nav-item"><a class="nav-link {{ Request::is('contact') ? 'active' : '' }}"
                            href="{{ route('contact') }}">KONTAK</a></li>
                    <li class="nav-item ms-lg-2">
                        @auth
                        <a href="{{ route('reservasi') }}" class="btn btn-gold-luxury px-4 py-2">BOOK NOW</a>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-gold-luxury px-4 py-2">LOGIN TO BOOK</a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="mobile-dock d-lg-none">
        <a href="{{ route('welcome') }}"><i class="bi bi-house"></i></a>
        <a href="{{ route('pricelist') }}"><i class="bi bi-scissors"></i></a>
        <a href="{{ auth()->check() ? route('reservasi') : route('login') }}"><i
                class="bi bi-calendar-check-fill text-gold fs-3" style="color: var(--luxury-gold) !important;"></i></a>
        <a href="{{ route('contact') }}"><i class="bi bi-geo-alt"></i></a>
        <a href="{{ auth()->check() ? route('dashboard') : route('login') }}"><i class="bi bi-person-circle"></i></a>
    </div>

    <main>@yield('content')</main>

    <footer class="py-5 bg-matte border-top border-secondary mt-5" style="background: #121212;">
        <div class="container text-center">
            <h2 class="text-gold mb-4 fw-bold letter-spacing-2">{{ $setting->app_name ?? 'JARSAN BARBERSHOP' }}</h2>
            <div class="mb-4 d-flex justify-content-center gap-4">
                <a href="https://www.instagram.com/jarsan_barbershop" target="_blank" class="text-white fs-4"><i
                        class="bi bi-instagram"></i></a>
                <a href="https://www.tiktok.com/@jarsan_barbershop" target="_blank" class="text-white fs-4"><i
                        class="bi bi-tiktok"></i></a>
            </div>
            <p class="text-white small">© {{ date('Y') }} Jarsan Barbershop. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/gsap.min.js"></script>
    <script>
    AOS.init();
    window.addEventListener('load', function() {
        setTimeout(() => {
            document.getElementById('preloader').style.display = 'none';
        }, 600);
    });
    </script>
    @stack('scripts')
</body>

</html>