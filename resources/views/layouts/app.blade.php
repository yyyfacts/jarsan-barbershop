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

    /* Reset warna teks untuk elemen standar */
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

    .letter-spacing-1 {
        letter-spacing: 1px;
    }

    .letter-spacing-2 {
        letter-spacing: 2px;
    }

    /* --- NAVBAR --- */
    .navbar-luxury {
        background: rgba(10, 10, 10, 0.98);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid var(--gold-accent);
        padding: 0.8rem 0;
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

    /* --- DROPDOWN USER --- */
    .user-dropdown-toggle {
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--gold-accent);
        padding: 5px 15px 5px 5px;
        border-radius: 4px;
        color: white !important;
        text-decoration: none;
    }

    .user-avatar-small {
        width: 30px;
        height: 30px;
        object-fit: cover;
        border: 1px solid var(--luxury-gold);
    }

    .custom-dropdown-menu {
        background: #1a1a1a;
        border: 1px solid var(--gold-accent);
        border-radius: 0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }

    .custom-dropdown-item {
        color: #ccc !important;
        padding: 10px 20px;
        font-size: 0.9rem;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .custom-dropdown-item:hover {
        background: var(--luxury-gold) !important;
        color: #000 !important;
    }

    /* --- BUTTONS --- */
    .btn-gold {
        background-color: var(--luxury-gold);
        color: #000;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.8rem;
        border-radius: 0;
        border: none;
        transition: 0.3s;
        padding: 10px 25px;
    }

    .btn-gold:hover {
        background-color: #f1d382;
        color: #000;
        transform: translateY(-2px);
    }

    /* --- FOOTER --- */
    footer {
        background-color: #050505;
        border-top: 1px solid #222;
        padding: 80px 0 0 0;
    }

    .footer-title {
        color: var(--luxury-gold);
        font-weight: 700;
        font-size: 0.85rem;
        letter-spacing: 2px;
        margin-bottom: 25px;
        text-transform: uppercase;
    }

    .footer-desc {
        color: #888;
        font-size: 0.9rem;
        line-height: 1.7;
    }

    .footer-links a {
        color: #888;
        text-decoration: none;
        transition: 0.3s;
        font-size: 0.9rem;
    }

    .footer-links a:hover {
        color: var(--luxury-gold);
        padding-left: 5px;
    }

    .social-icon {
        width: 35px;
        height: 35px;
        border: 1px solid #333;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-decoration: none;
        transition: 0.3s;
    }

    .social-icon:hover {
        border-color: var(--luxury-gold);
        color: var(--luxury-gold);
    }

    .copyright-bar {
        background-color: #000;
        padding: 25px 0;
        margin-top: 60px;
        border-top: 1px solid #111;
    }
    </style>
    @stack('styles')
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-luxury sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('welcome') }}">
                @if($setting && $setting->logo_path)
                <img src="{{ $setting->logo_path }}" alt="Logo" height="45" class="me-3"
                    style="border: 1px solid var(--luxury-gold); padding: 2px;">
                @endif
                <div>
                    <span
                        class="d-block fw-bold lh-1 text-white letter-spacing-1">{{ $setting->app_name ?? 'JARSAN' }}</span>
                    <span class="small text-gold letter-spacing-2" style="font-size: 0.55rem;">BARBERSHOP</span>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-2 align-items-lg-center">
                    <li class="nav-item"><a class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                            href="{{ route('welcome') }}">BERANDA</a></li>
                    <li class="nav-item"><a class="nav-link {{ Request::is('about') ? 'active' : '' }}"
                            href="{{ route('about') }}">TENTANG</a></li>
                    <li class="nav-item"><a class="nav-link {{ Request::is('barberman') ? 'active' : '' }}"
                            href="{{ route('barberman') }}">BARBER</a></li>
                    <li class="nav-item"><a class="nav-link {{ Request::is('pricelist') ? 'active' : '' }}"
                            href="{{ route('pricelist') }}">LAYANAN</a></li>
                    <li class="nav-item"><a class="nav-link {{ Request::is('contact') ? 'active' : '' }}"
                            href="{{ route('contact') }}">KONTAK</a></li>

                    @guest
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <a href="{{ route('reservasi') }}" class="btn btn-gold w-100">PESAN JADWAL</a>
                    </li>
                    @else
                    <li class="nav-item dropdown ms-lg-3 mt-3 mt-lg-0">
                        <a class="user-dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown">
                            <img src="{{ Auth::user()->avatar_blob ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=D4AF37&color=000' }}"
                                class="user-avatar-small rounded-circle">
                            <span class="small fw-bold text-uppercase">{{ Str::limit(Auth::user()->name, 12) }}</span>
                            <i class="bi bi-chevron-down small" style="font-size: 0.6rem;"></i>
                        </a>
                        <ul class="dropdown-menu custom-dropdown-menu dropdown-menu-end mt-2">
                            <li><a class="custom-dropdown-item" href="{{ route('dashboard') }}"><i
                                        class="bi bi-person-circle"></i> Profil Saya</a></li>
                            @if(Auth::user()->role === 'admin')
                            <li><a class="custom-dropdown-item" href="{{ route('admin.dashboard') }}"><i
                                        class="bi bi-speedometer2"></i> Panel Admin</a></li>
                            @endif
                            <li>
                                <hr class="dropdown-divider border-secondary opacity-25">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="custom-dropdown-item w-100 text-start border-0 bg-transparent">
                                        <i class="bi bi-box-arrow-right"></i> Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
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
                    <h5 class="fw-bold text-white mb-4 letter-spacing-1">{{ $setting->app_name ?? 'JARSAN BARBERSHOP' }}
                    </h5>
                    <p class="footer-desc mb-4">
                        Pusat perawatan pria premium yang menggabungkan keahlian pangkas rambut klasik dengan gaya hidup
                        modern untuk penampilan maksimal.
                    </p>
                    <div class="d-flex gap-2">
                        @if($setting && $setting->instagram_link)
                        <a href="{{ $setting->instagram_link }}" target="_blank" class="social-icon"><i
                                class="bi bi-instagram"></i></a>
                        @endif
                        @if($setting && $setting->tiktok_link)
                        <a href="{{ $setting->tiktok_link }}" target="_blank" class="social-icon"><i
                                class="bi bi-tiktok"></i></a>
                        @endif
                        @if($setting && $setting->whatsapp_number)
                        <a href="https://wa.me/{{ $setting->whatsapp_number }}" target="_blank" class="social-icon"><i
                                class="bi bi-whatsapp"></i></a>
                        @endif
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="footer-title">Tautan Cepat</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="{{ route('welcome') }}">Beranda</a></li>
                        <li><a href="{{ route('barberman') }}">Tim Barber</a></li>
                        <li><a href="{{ route('pricelist') }}">Menu Layanan</a></li>
                        <li><a href="{{ route('reservasi') }}">Pesan Jadwal</a></li>
                    </ul>
                </div>

                <div class="col-lg-5 col-md-12">
                    <h6 class="footer-title">Lokasi & Waktu</h6>
                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <p class="mb-1 text-white small fw-bold">ALAMAT</p>
                            <p class="footer-desc small">Kayulangit, Sikampuh, Kroya,<br>Cilacap, Jawa Tengah</p>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <p class="mb-1 text-white small fw-bold">JAM BUKA</p>
                            <p class="text-gold small mb-1 fw-bold">13:00 - 21:00 WIB</p>
                            <small class="text-white-50">Buka Setiap Hari<br>(Jumat Libur)</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="copyright-bar text-center">
            <div class="container">
                <p class="mb-0 small text-white-50">
                    &copy; {{ date('Y') }} {{ $setting->app_name ?? 'Jarsan Barbershop' }}. Hak Cipta Dilindungi.
                </p>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init({
        duration: 800,
        once: true,
        offset: 50
    });
    </script>
    @stack('scripts')
</body>

</html>