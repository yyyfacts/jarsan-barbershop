<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ $setting->app_name ?? 'Jarsan Barbershop' }}</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&family=Playfair+Display:ital,wght@0,700;1,700&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
    :root {
        --deep-charcoal: #0f0f0f;
        /* Lebih gelap agar luxury */
        --matte-black: #161616;
        --luxury-gold: #D4AF37;
        --metallic-red: #e62e2e;
        --font-main: 'Montserrat', sans-serif;
        --font-heading: 'Playfair Display', serif;
    }

    body {
        font-family: var(--font-main);
        background-color: var(--deep-charcoal);
        color: #f0f0f0;
        /* Tulisan putih gading agar nyaman di mata */
        overflow-x: hidden;
    }

    h1,
    h2,
    h3,
    h4,
    .navbar-brand {
        font-family: var(--font-heading);
    }

    /* --- PRE-LOADER DINAMIS --- */
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--deep-charcoal);
        z-index: 9999;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .loader-logo {
        width: 120px;
        height: auto;
        animation: pulse 2s infinite;
        filter: drop-shadow(0 0 15px var(--luxury-gold));
    }

    @keyframes pulse {
        0% {
            opacity: 0.4;
            transform: scale(0.9);
        }

        50% {
            opacity: 1;
            transform: scale(1.05);
        }

        100% {
            opacity: 0.4;
            transform: scale(0.9);
        }
    }

    /* --- NAVBAR LUXURY --- */
    .navbar-luxury {
        background: rgba(15, 15, 15, 0.9);
        backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(212, 175, 55, 0.2);
        padding: 1rem 0;
    }

    .navbar-brand img {
        max-height: 45px;
        width: auto;
    }

    .nav-link {
        color: #ffffff !important;
        font-weight: 500;
        letter-spacing: 1px;
        transition: 0.3s;
    }

    .nav-link:hover {
        color: var(--luxury-gold) !important;
    }

    /* --- MOBILE BOTTOM DOCK --- */
    @media (max-width: 991px) {
        .mobile-dock {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(22, 22, 22, 0.95);
            backdrop-filter: blur(15px);
            border: 1px solid var(--luxury-gold);
            border-radius: 40px;
            display: flex;
            padding: 12px 30px;
            z-index: 999;
            gap: 25px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.8);
        }

        .mobile-dock a {
            color: #ffffff;
            font-size: 1.5rem;
        }

        .mobile-dock a.active {
            color: var(--luxury-gold);
        }

        .navbar-toggler {
            display: none;
        }
    }

    /* Perbaikan kontras tulisan Abu-abu */
    .text-muted {
        color: #cccccc !important;
    }

    /* Lebih terang dari standar */
    </style>
    @stack('styles')
</head>

<body>

    <div id="preloader">
        @if($setting && $setting->logo_path)
        <img src="{{ $setting->logo_path }}" class="loader-logo" alt="Jarsan Logo">
        @else
        <h1 class="text-gold display-1 fw-bold">J</h1>
        @endif
        <p class="mt-3 letter-spacing-5 text-gold small">LOADING EXPERIENCE</p>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-luxury sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('welcome') }}">
                @if($setting && $setting->logo_path)
                <img src="{{ $setting->logo_path }}" alt="Logo" class="me-2">
                @endif
                <span class="fs-3 fw-bold">{{ $setting->app_name ?? 'JARSAN' }}</span>
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-4">
                    <li class="nav-item"><a class="nav-link" href="{{ route('welcome') }}">BERANDA</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('pricelist') }}">LAYANAN</a></li>
                    <li class="nav-item">
                        <a href="{{ route('reservasi') }}"
                            class="btn btn-outline-warning rounded-0 px-4 fw-bold">RESERVASI</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="mobile-dock d-lg-none">
        <a href="{{ route('welcome') }}"><i class="bi bi-house-door"></i></a>
        <a href="{{ route('pricelist') }}"><i class="bi bi-scissors"></i></a>
        <a href="{{ route('reservasi') }}"><i class="bi bi-calendar-check" style="color: var(--luxury-gold)"></i></a>
        <a href="{{ route('barberman') }}"><i class="bi bi-people"></i></a>
        <a href="{{ route('contact') }}"><i class="bi bi-geo-alt"></i></a>
    </div>

    @yield('content')

    <footer class="py-5" style="background: #0a0a0a; border-top: 1px solid #222;">
        <div class="container text-center">
            <h2 class="text-gold mb-4">{{ $setting->app_name ?? 'JARSAN BARBERSHOP' }}</h2>
            <div class="mb-4">
                <a href="https://www.instagram.com/jarsan_barbershop" class="mx-3 text-white fs-3"><i
                        class="bi bi-instagram"></i></a>
                <a href="https://www.tiktok.com/@jarsan_barbershop" class="mx-3 text-white fs-3"><i
                        class="bi bi-tiktok"></i></a>
            </div>
            <p class="text-muted small">© {{ date('Y') }} {{ $setting->app_name ?? 'Jarsan Barbershop' }}. Luxury
                Grooming for Gentlemen.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init({
        duration: 1000,
        once: true
    });
    window.addEventListener('load', function() {
        setTimeout(() => {
            $('#preloader').fadeOut('slow');
        }, 500);
    });
    </script>
</body>

</html>