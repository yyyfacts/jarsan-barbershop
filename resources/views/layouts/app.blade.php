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
        --gold-accent: rgba(212, 175, 55, 0.3);
        --text-light: #ffffff;
        /* Kontras Tinggi */
        --font-main: 'Montserrat', sans-serif;
        --font-heading: 'Playfair Display', serif;
    }

    body {
        background-color: var(--deep-charcoal);
        color: var(--text-light);
        font-family: var(--font-main);
        overflow-x: hidden;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    .navbar-brand {
        font-family: var(--font-heading);
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
        animation: pulse-logo 2s infinite ease-in-out;
    }

    .loader-ring {
        position: absolute;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        border: 2px solid transparent;
        border-top-color: var(--luxury-gold);
        animation: spin-ring 1.5s linear infinite;
    }

    @keyframes pulse-logo {

        0%,
        100% {
            transform: scale(0.95);
            opacity: 0.8;
        }

        50% {
            transform: scale(1);
            opacity: 1;
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

    /* --- NAVBAR --- */
    .navbar-luxury {
        background: rgba(10, 10, 10, 0.9);
        backdrop-filter: blur(15px);
        border-bottom: 1px solid var(--gold-accent);
        padding: 1rem 0;
    }

    .nav-link {
        color: #ffffff !important;
        font-weight: 500;
        letter-spacing: 1px;
        transition: 0.3s;
        font-size: 0.85rem;
    }

    .nav-link:hover,
    .nav-link.active {
        color: var(--luxury-gold) !important;
    }

    /* --- MOBILE DOCK --- */
    @media (max-width: 991px) {
        .mobile-dock {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(18, 18, 18, 0.95);
            backdrop-filter: blur(15px);
            border: 1px solid var(--luxury-gold);
            border-radius: 50px;
            display: flex;
            padding: 10px 25px;
            z-index: 1000;
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

    .btn-gold-luxury {
        background: var(--luxury-gold);
        border: none;
        color: #000;
        font-weight: 700;
        border-radius: 2px;
        transition: 0.4s;
        padding: 10px 25px;
    }

    .btn-gold-luxury:hover {
        background: #fff;
        box-shadow: 0 0 20px var(--gold-accent);
    }
    </style>
</head>

<body>

    <div id="preloader">
        <div class="loader-container">
            <img src="{{ $setting->logo_path ?? asset('images/logo.png') }}" class="loader-logo">
            <div class="loader-ring"></div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-luxury sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ $setting->logo_path ?? asset('images/logo.png') }}" height="40"
                    class="me-2 rounded-circle border border-warning">
                <span class="fw-bold">{{ $setting->app_name ?? 'JARSAN' }}</span>
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-3 align-items-center">
                    <li class="nav-item"><a class="nav-link" href="/">BERANDA</a></li>
                    <li class="nav-item"><a class="nav-link" href="/about">TENTANG KAMI</a></li>
                    <li class="nav-item"><a class="nav-link" href="/barberman">BARBERMAN</a></li>
                    <li class="nav-item"><a class="nav-link" href="/pricelist">LAYANAN</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact">KONTAK</a></li>
                    @auth
                    <li class="nav-item"><a class="nav-link text-gold fw-bold border border-warning px-3 rounded-pill"
                            href="/dashboard"><i class="bi bi-person-circle me-1"></i> PROFIL</a></li>
                    @else
                    <li class="nav-item"><a href="/login" class="btn btn-gold-luxury py-1 px-4">LOGIN</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="mobile-dock d-lg-none">
        <a href="/"><i class="bi bi-house"></i></a>
        <a href="/pricelist"><i class="bi bi-scissors"></i></a>
        <a href="/reservasi" class="text-gold"><i class="bi bi-calendar-plus-fill"></i></a>
        <a href="/contact"><i class="bi bi-geo-alt"></i></a>
        @auth
        <a href="/dashboard"><i class="bi bi-person-circle"></i></a>
        @else
        <a href="/login"><i class="bi bi-box-arrow-in-right"></i></a>
        @endauth
    </div>

    @yield('content')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init();
    window.addEventListener('load', function() {
        setTimeout(() => {
            $('#preloader').fadeOut('slow');
        }, 600);
    });
    </script>
</body>

</html>