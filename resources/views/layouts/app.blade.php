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
        --deep-charcoal: #0a0a0a;
        --matte-black: #121212;
        --luxury-gold: #D4AF37;
        --metallic-red: #e62e2e;
        --glass-bg: rgba(255, 255, 255, 0.05);
        --font-main: 'Montserrat', sans-serif;
        --font-heading: 'Playfair Display', serif;
    }

    body {
        background-color: var(--deep-charcoal);
        color: #ffffff;
        /* Kontras Tinggi: Putih murni */
        font-family: var(--font-main);
        overflow-x: hidden;
    }

    h1,
    h2,
    h3,
    h4,
    .navbar-brand {
        font-family: var(--font-heading);
    }

    /* --- PRE-LOADER PREMIUM --- */
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
        animation: pulse 2s infinite;
        filter: drop-shadow(0 0 15px var(--luxury-gold));
    }

    @keyframes pulse {
        0% {
            transform: scale(0.95);
            opacity: 0.7;
        }

        50% {
            transform: scale(1.05);
            opacity: 1;
        }

        100% {
            transform: scale(0.95);
            opacity: 0.7;
        }
    }

    /* --- NAVBAR GLASSMORPHISM --- */
    .navbar-luxury {
        background: rgba(10, 10, 10, 0.85);
        backdrop-filter: blur(15px);
        border-bottom: 1px solid rgba(212, 175, 55, 0.3);
        padding: 1rem 0;
    }

    .nav-link {
        color: #ffffff !important;
        font-weight: 600;
        letter-spacing: 1px;
        transition: 0.3s;
        font-size: 0.9rem;
    }

    .nav-link:hover {
        color: var(--luxury-gold) !important;
    }

    /* --- MOBILE FLOATING DOCK --- */
    @media (max-width: 991px) {
        .mobile-dock {
            position: fixed;
            bottom: 25px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(20, 20, 20, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid var(--luxury-gold);
            border-radius: 50px;
            display: flex;
            padding: 12px 30px;
            z-index: 1000;
            gap: 25px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.8);
        }

        .mobile-dock a {
            color: #ffffff;
            font-size: 1.4rem;
            transition: 0.3s;
        }

        .mobile-dock a.active {
            color: var(--luxury-gold);
            transform: translateY(-5px);
        }

        .navbar-toggler {
            display: none;
        }
    }

    /* Utility Kontras */
    .text-muted {
        color: #bbbbbb !important;
    }

    /* Lebih terang dari abu-abu standar */
    .glass-card {
        background: var(--glass-bg);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }

    .btn-gold-luxury {
        background: transparent;
        border: 1px solid var(--luxury-gold);
        color: var(--luxury-gold);
        letter-spacing: 2px;
        font-weight: 700;
        transition: 0.4s;
        text-transform: uppercase;
    }

    .btn-gold-luxury:hover {
        background: var(--luxury-gold);
        color: #000;
        box-shadow: 0 0 20px rgba(212, 175, 55, 0.4);
    }
    </style>
    @stack('styles')
</head>

<body>

    <div id="preloader">
        @if($setting && $setting->logo_path)
        <img src="{{ $setting->logo_path }}" class="loader-logo" alt="Jarsan Logo">
        @else
        <h1 class="text-gold display-1 fw-bold" style="color: var(--luxury-gold)">J</h1>
        @endif
        <p class="mt-4 letter-spacing-5 text-gold small fw-bold"
            style="color: var(--luxury-gold); letter-spacing: 5px;">MEMBER OF EXCELLENCE</p>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-luxury sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fs-3" href="{{ route('welcome') }}">
                @if($setting && $setting->logo_path)
                <img src="{{ $setting->logo_path }}" alt="Logo" height="45" class="me-2">
                @endif
                <span class="fw-bold text-white">{{ $setting->app_name ?? 'JARSAN' }}</span>
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-4">
                    <li class="nav-item"><a class="nav-link" href="{{ route('welcome') }}">BERANDA</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('pricelist') }}">LAYANAN</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('barberman') }}">BARBERMAN</a></li>
                    <li class="nav-item">
                        <a href="{{ route('reservasi') }}" class="btn btn-gold-luxury px-4 py-2">RESERVASI</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="mobile-dock d-lg-none">
        <a href="{{ route('welcome') }}"><i class="bi bi-house-door"></i></a>
        <a href="{{ route('pricelist') }}"><i class="bi bi-scissors"></i></a>
        <a href="{{ route('reservasi') }}"><i class="bi bi-calendar-check-fill"
                style="color: var(--luxury-gold)"></i></a>
        <a href="{{ route('barberman') }}"><i class="bi bi-people"></i></a>
        <a href="{{ route('contact') }}"><i class="bi bi-geo-alt"></i></a>
    </div>

    @yield('content')

    <footer class="py-5" style="background: #050505; border-top: 1px solid #1a1a1a;">
        <div class="container text-center">
            <h2 class="text-white mb-4 fw-bold" style="letter-spacing: 2px;">
                {{ $setting->app_name ?? 'JARSAN BARBERSHOP' }}</h2>
            <div class="mb-4">
                <a href="https://www.instagram.com/jarsan_barbershop" target="_blank" class="mx-3 text-white fs-3"><i
                        class="bi bi-instagram"></i></a>
                <a href="https://www.tiktok.com/@jarsan_barbershop" target="_blank" class="mx-3 text-white fs-3"><i
                        class="bi bi-tiktok"></i></a>
            </div>
            <p class="text-muted small">© {{ date('Y') }} {{ $setting->app_name ?? 'Jarsan Barbershop' }}. Luxury
                Grooming for Every Gentleman.</p>
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
        }, 600);
    });
    </script>
</body>

</html>