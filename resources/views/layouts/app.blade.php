<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Judul Dinamis --}}
    <title>@yield('title') - {{ $setting->app_name ?? 'Jarsan Barbershop' }}</title>

    {{-- Typography --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&family=Playfair+Display:ital,wght@0,700;1,700&display=swap"
        rel="stylesheet">

    {{-- Libraries --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
    :root {
        --deep-charcoal: #121212;
        --matte-black: #1a1a1a;
        --luxury-gold: #D4AF37;
        --metallic-red: #c41e3a;
        --glass-white: rgba(255, 255, 255, 0.05);
        --font-main: 'Montserrat', sans-serif;
        --font-heading: 'Playfair Display', serif;
    }

    body {
        font-family: var(--font-main);
        background-color: var(--deep-charcoal);
        color: #ffffff;
        overflow-x: hidden;
    }

    h1,
    h2,
    h3,
    .navbar-brand {
        font-family: var(--font-heading);
    }

    /* --- AESTHETIC PRE-LOADER --- */
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--deep-charcoal);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .loader-logo {
        width: 100px;
        animation: pulse 2s infinite;
        filter: drop-shadow(0 0 10px var(--luxury-gold));
    }

    @keyframes pulse {
        0% {
            opacity: 0.5;
            transform: scale(0.9);
        }

        50% {
            opacity: 1;
            transform: scale(1);
        }

        100% {
            opacity: 0.5;
            transform: scale(0.9);
        }
    }

    /* --- NAVBAR --- */
    .navbar-luxury {
        background: rgba(18, 18, 18, 0.8);
        backdrop-filter: blur(15px);
        border-bottom: 1px solid var(--glass-white);
        padding: 1.2rem 0;
    }

    .btn-outline-gold {
        border: 1px solid var(--luxury-gold);
        color: var(--luxury-gold);
        transition: 0.3s;
    }

    .btn-outline-gold:hover {
        background: var(--luxury-gold);
        color: #000;
    }

    /* --- MOBILE FLOATING DOCK --- */
    @media (max-width: 991px) {
        .mobile-dock {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(26, 26, 26, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid var(--luxury-gold);
            border-radius: 50px;
            display: flex;
            padding: 10px 25px;
            z-index: 999;
            gap: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .mobile-dock a {
            color: #fff;
            font-size: 1.4rem;
            transition: 0.3s;
        }

        .mobile-dock a.active {
            color: var(--luxury-gold);
        }

        .navbar-toggler {
            display: none;
        }
    }

    footer a:hover {
        color: var(--luxury-gold) !important;
        transition: 0.3s;
    }
    </style>
    @stack('styles')
</head>

<body>

    {{-- Pre-loader Dinamis --}}
    <div id="preloader">
        @if($setting && $setting->logo_path)
        <img src="{{ $setting->logo_path }}" class="loader-logo" alt="Jarsan Logo">
        @else
        <h1 class="loader-logo fw-bold" style="color: var(--luxury-gold); font-size: 3rem; text-align: center;">J</h1>
        @endif
    </div>

    {{-- Navbar Dinamis --}}
    <nav class="navbar navbar-expand-lg navbar-dark navbar-luxury sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fs-3" href="{{ route('welcome') }}">
                @if($setting && $setting->logo_path)
                <img src="{{ $setting->logo_path }}" alt="Logo" height="40" class="me-2">
                @else
                <span style="color: var(--luxury-gold); font-weight: bold; margin-right: 5px;">J</span>
                @endif
                {{ $setting->app_name ?? 'JARSAN' }}
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-4">
                    <li class="nav-item"><a class="nav-link" href="{{ route('welcome') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('pricelist') }}">Layanan</a></li>
                    <li class="nav-item">
                        <a href="{{ route('reservasi') }}" class="btn btn-outline-gold rounded-0 px-4">RESERVASI</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Mobile Nav --}}
    <div class="mobile-dock d-lg-none">
        <a href="{{ route('welcome') }}"><i class="bi bi-house-door"></i></a>
        <a href="{{ route('pricelist') }}"><i class="bi bi-scissors"></i></a>
        <a href="{{ route('reservasi') }}"><i class="bi bi-calendar-check-fill"
                style="color: var(--luxury-gold)"></i></a>
        <a href="{{ route('barberman') }}"><i class="bi bi-people"></i></a>
        <a href="{{ route('contact') }}"><i class="bi bi-geo-alt"></i></a>
    </div>

    <main>
        @yield('content')
    </main>

    {{-- Footer dengan Link Sosial Media --}}
    <footer class="py-5 border-top border-secondary mt-5" style="background: var(--matte-black)">
        <div class="container text-center">
            <h3 class="mb-4" style="color: var(--luxury-gold)">{{ $setting->app_name ?? 'JARSAN BARBERSHOP' }}</h3>
            <div class="social-links mb-4">
                {{-- Link Instagram --}}
                <a href="https://www.instagram.com/jarsan_barbershop?igsh=MWRpb2ZzbG56MWc3bg==" target="_blank"
                    class="mx-2 text-white">
                    <i class="bi bi-instagram fs-4"></i>
                </a>
                {{-- Link TikTok --}}
                <a href="https://www.tiktok.com/@jarsan_barbershop?_r=1&_t=ZS-92bYdkMyeG8" target="_blank"
                    class="mx-2 text-white">
                    <i class="bi bi-tiktok fs-4"></i>
                </a>
            </div>
            <p class="text-muted small">© {{ date('Y') }} {{ $setting->app_name ?? 'Jarsan Barbershop' }}. Crafted for
                Professionals.</p>
        </div>
    </footer>

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init({
        duration: 1000,
        once: true
    });
    window.addEventListener('load', function() {
        setTimeout(function() {
            $('#preloader').fadeOut('slow');
        }, 500); // Memberikan sedikit jeda agar animasi pulse terlihat
    });
    </script>
    @stack('scripts')
</body>

</html>