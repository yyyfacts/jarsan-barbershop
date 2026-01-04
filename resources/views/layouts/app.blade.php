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

    .text-gold {
        color: var(--luxury-gold) !important;
    }

    .bg-matte {
        background-color: var(--matte-black);
    }

    .letter-spacing-2 {
        letter-spacing: 2px;
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

    .nav-link:hover,
    .nav-link.active {
        color: var(--luxury-gold) !important;
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

    /* --- BUTTONS --- */
    .btn-gold-luxury {
        background: linear-gradient(45deg, var(--luxury-gold), #fff0d1);
        border: none;
        color: #000;
        font-weight: 700;
        letter-spacing: 1px;
        border-radius: 2px;
        transition: 0.4s;
    }

    .btn-gold-luxury:hover {
        background: linear-gradient(45deg, #fff0d1, var(--luxury-gold));
        box-shadow: 0 5px 20px rgba(212, 175, 55, 0.5);
    }

    /* --- FOOTER LUXURY STYLE --- */
    footer {
        background-color: #050505;
        border-top: 1px solid var(--gold-accent);
        padding-top: 80px;
        position: relative;
    }

    .footer-brand {
        font-family: var(--font-heading);
        font-size: 2rem;
        font-weight: 700;
        color: var(--luxury-gold);
        margin-bottom: 20px;
        display: block;
        text-decoration: none;
    }

    .footer-desc {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.9rem;
        line-height: 1.8;
        max-width: 300px;
    }

    .footer-title {
        color: #fff;
        font-weight: 700;
        letter-spacing: 2px;
        margin-bottom: 25px;
        font-size: 0.9rem;
        text-transform: uppercase;
    }

    .footer-links li {
        margin-bottom: 12px;
    }

    .footer-links a {
        color: rgba(255, 255, 255, 0.6);
        text-decoration: none;
        transition: 0.3s;
        font-size: 0.9rem;
    }

    .footer-links a:hover {
        color: var(--luxury-gold);
        padding-left: 5px;
    }

    .social-icon-circle {
        width: 40px;
        height: 40px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-decoration: none;
        transition: 0.3s;
    }

    .social-icon-circle:hover {
        border-color: var(--luxury-gold);
        background: var(--luxury-gold);
        color: #000;
        transform: translateY(-3px);
    }

    .copyright-bar {
        background-color: #000;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        padding: 25px 0;
        margin-top: 60px;
    }
    </style>
    @stack('styles')
</head>

<body>

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

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

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
                            href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <img src="{{ Auth::user()->avatar_blob ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=D4AF37&color=000' }}"
                                class="user-avatar-small">
                            <span
                                class="small fw-bold text-uppercase ms-1">{{ Str::limit(Auth::user()->name, 10) }}</span>
                            <i class="bi bi-chevron-down small ms-1" style="font-size: 0.7rem;"></i>
                        </a>
                        <ul class="dropdown-menu custom-dropdown-menu dropdown-menu-end">
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
                                    <button type="submit" class="dropdown-item custom-dropdown-item w-100 text-start"><i
                                            class="bi bi-box-arrow-right"></i> Logout</button>
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

    <footer>
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('welcome') }}" class="footer-brand">
                        {{ $setting->app_name ?? 'JARSAN' }}
                    </a>
                    <p class="footer-desc">
                        Destinasi grooming premium untuk pria modern. Kami memadukan teknik klasik dengan gaya hidup
                        masa kini.
                    </p>
                    <div class="d-flex gap-3 mt-4">
                        @if($setting && $setting->instagram_link)
                        <a href="{{ $setting->instagram_link }}" target="_blank" class="social-icon-circle"><i
                                class="bi bi-instagram"></i></a>
                        @endif
                        @if($setting && $setting->tiktok_link)
                        <a href="{{ $setting->tiktok_link }}" target="_blank" class="social-icon-circle"><i
                                class="bi bi-tiktok"></i></a>
                        @endif

                        {{-- LOGIKA WHATSAPP OTOMATIS --}}
                        @if($setting && $setting->whatsapp_number)
                        <a href="https://wa.me/{{ $setting->whatsapp_number }}" target="_blank"
                            class="social-icon-circle"><i class="bi bi-whatsapp"></i></a>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h6 class="footer-title">QUICK LINKS</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="{{ route('welcome') }}">Beranda</a></li>
                        <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                        <li><a href="{{ route('barberman') }}">Tim Barber</a></li>
                        <li><a href="{{ route('pricelist') }}">Daftar Layanan</a></li>
                        <li><a href="{{ route('contact') }}">Hubungi Kami</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h6 class="footer-title">STUDIO & HOURS</h6>
                    <div class="mb-4">
                        <p class="mb-1 text-white opacity-75 small">ALAMAT STUDIO</p>
                        <p class="text-white small">Kayulangit, Sikampuh, Kroya, Cilacap, Jawa Tengah 53282</p>
                    </div>
                    <div>
                        <p class="mb-1 text-white opacity-75 small">JAM OPERASIONAL</p>
                        <p class="text-gold fw-bold mb-0">Setiap Hari: 13.00 - 21.00 WIB</p>
                        <small class="text-white-50">(Kecuali Jumat Libur)</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="copyright-bar text-center">
            <div class="container">
                <p class="mb-0 small text-white-50">
                    &copy; {{ date('Y') }} <strong
                        class="text-white">{{ $setting->app_name ?? 'Jarsan Barbershop' }}</strong>. All Rights
                    Reserved.
                </p>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init({
        duration: 1000,
        once: true,
        offset: 50
    });
    </script>
    @stack('scripts')
</body>

</html>