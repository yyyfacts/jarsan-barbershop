<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Jarsan - Premium Barbershop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:wght@400;600;700&display=swap"
        rel="stylesheet">

    <style>
    :root {
        --bg-dark: #121212;
        --bg-card: #1E1E1E;
        --text-main: #E0E0E0;
        --gold-accent: #D4AF37;
        --gold-hover: #F4CF57;
    }

    body {
        background-color: var(--bg-dark);
        color: var(--text-main);
        font-family: 'Inter', sans-serif;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    /* Typography */
    h1,
    h2,
    h3,
    h4,
    .serif-font,
    .navbar-brand {
        font-family: 'Playfair Display', serif;
    }

    .text-gold {
        color: var(--gold-accent) !important;
    }

    /* Navbar & Offcanvas (Menu Geser) */
    .navbar-custom {
        background-color: #000;
        border-bottom: 1px solid var(--gold-accent);
        padding: 15px 0;
    }

    /* MENU GESER SAMPING STYLE */
    .offcanvas-custom {
        background-color: #1a1a1a;
        color: white;
        border-left: 1px solid var(--gold-accent);
    }

    .offcanvas-header .btn-close {
        filter: invert(1);
        /* Tombol close jadi putih */
    }

    .nav-link {
        color: #aaa !important;
        font-size: 1rem;
        padding: 10px 0;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: 0.3s;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        /* Garis tipis antar menu di HP */
    }

    .nav-link:hover,
    .nav-link.active {
        color: var(--gold-accent) !important;
        padding-left: 10px;
        /* Efek geser dikit saat hover */
    }

    /* Elements */
    .card {
        background-color: var(--bg-card);
        border: 1px solid #333;
        border-radius: 12px;
    }

    .table {
        --bs-table-bg: transparent;
        --bs-table-color: #E0E0E0;
        border-color: #333;
    }

    thead th {
        color: var(--gold-accent) !important;
        border-bottom: 2px solid var(--gold-accent);
        font-family: 'Playfair Display', serif;
    }

    /* Inputs & Modals */
    .form-control {
        background-color: #2A2A2A;
        border: 1px solid #444;
        color: white !important;
    }

    .form-control:focus {
        background-color: #333;
        border-color: var(--gold-accent);
        box-shadow: none;
    }

    .modal-content {
        background-color: var(--bg-card);
        border: 1px solid var(--gold-accent);
        color: white;
    }

    .modal-header {
        border-bottom: 1px solid #333;
    }

    .modal-footer {
        border-top: 1px solid #333;
    }

    .btn-close {
        filter: invert(1);
    }

    /* Buttons */
    .btn-gold {
        background-color: var(--gold-accent);
        color: #000;
        font-weight: bold;
        border: none;
    }

    .btn-gold:hover {
        background-color: var(--gold-hover);
        color: #000;
    }

    footer {
        background-color: #000;
        padding: 25px 0;
        margin-top: auto;
        border-top: 1px solid #333;
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-dark navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="{{ route('admin.dashboard') }}"
                style="color: var(--gold-accent);">
                JARSAN<span class="text-white fw-light">ADMIN</span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <i class="bi bi-list fs-1" style="color: var(--gold-accent);"></i>
            </button>

            <div class="offcanvas offcanvas-end offcanvas-custom" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title serif-font fw-bold text-gold" id="offcanvasNavbarLabel">NAVIGATION</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item"><a
                                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="nav-item"><a
                                class="nav-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}"
                                href="{{ route('admin.services.index') }}">Pricelist</a></li>
                        <li class="nav-item"><a
                                class="nav-link {{ request()->routeIs('admin.barbers*') ? 'active' : '' }}"
                                href="{{ route('admin.barbers.index') }}">Barberman</a></li>
                        <li class="nav-item"><a
                                class="nav-link {{ request()->routeIs('admin.reservations*') ? 'active' : '' }}"
                                href="{{ route('admin.reservations.index') }}">Reservasi</a></li>
                        <li class="nav-item"><a
                                class="nav-link {{ request()->routeIs('admin.about*') ? 'active' : '' }}"
                                href="{{ route('admin.about.index') }}">Tentang Kami</a></li>
                        <li class="nav-item"><a
                                class="nav-link {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}"
                                href="{{ route('admin.contacts.index') }}">Pesan</a></li>

                        <li class="nav-item mt-4">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-outline-warning w-100 rounded-0"
                                    style="color: var(--gold-accent); border-color: var(--gold-accent);">LOGOUT</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <main class="container py-5">
        @yield('content')
    </main>

    <footer class="text-center">