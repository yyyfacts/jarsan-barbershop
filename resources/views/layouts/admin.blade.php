<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Jarsan - Premium Barbershop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet">

    <style>
    :root {
        --bg-dark: #121212;
        --bg-card: #1E1E1E;
        --text-main: #E0E0E0;
        --text-muted: #A0A0A0;
        --gold-accent: #D4AF37;
        --gold-hover: #B5952F;
        --glass-bg: rgba(30, 30, 30, 0.7);
        --glass-border: 1px solid rgba(255, 255, 255, 0.1);
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
    h5,
    .navbar-brand,
    .serif-font {
        font-family: 'Playfair Display', serif;
        letter-spacing: 0.5px;
    }

    /* Glassmorphism Navbar */
    .navbar-custom {
        background: var(--glass-bg);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-bottom: var(--glass-border);
    }

    .navbar-brand {
        color: var(--gold-accent) !important;
        font-weight: 700;
        font-size: 1.5rem;
    }

    .nav-link {
        color: var(--text-muted) !important;
        font-weight: 400;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .nav-link:hover,
    .nav-link.active {
        color: var(--gold-accent) !important;
    }

    /* Luxury Cards */
    .card {
        background-color: var(--bg-card);
        border: var(--glass-border);
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
    }

    /* Buttons */
    .btn-gold {
        background-color: var(--gold-accent);
        color: #000;
        font-weight: 600;
        border: none;
        transition: all 0.3s;
    }

    .btn-gold:hover {
        background-color: var(--gold-hover);
        color: #000;
        transform: translateY(-1px);
    }

    .btn-outline-gold {
        border: 1px solid var(--gold-accent);
        color: var(--gold-accent);
        background: transparent;
    }

    .btn-outline-gold:hover {
        background: var(--gold-accent);
        color: #000;
    }

    /* Tables Customization */
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
    }

    .table {
        --bs-table-bg: transparent;
        --bs-table-color: var(--text-main);
        --bs-table-border-color: #333;
    }

    .table thead {
        background-color: #000;
    }

    .table thead th {
        color: var(--gold-accent);
        font-family: 'Playfair Display', serif;
        font-weight: 400;
        letter-spacing: 1px;
        border-bottom: 2px solid var(--gold-accent);
    }

    /* Forms & Inputs */
    .form-control {
        background-color: #252525;
        border: 1px solid #444;
        color: #fff;
    }

    .form-control:focus {
        background-color: #252525;
        color: #fff;
        border-color: var(--gold-accent);
        box-shadow: 0 0 5px rgba(212, 175, 55, 0.3);
    }

    /* Modals */
    .modal-content {
        background-color: var(--bg-card);
        border: 1px solid var(--gold-accent);
        color: var(--text-main);
    }

    .modal-header {
        border-bottom: 1px solid #333;
    }

    .modal-footer {
        border-top: 1px solid #333;
    }

    .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }

    /* Footer */
    footer {
        background-color: #000;
        color: #555;
        padding: 30px 0;
        border-top: 1px solid #222;
        margin-top: auto;
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                JARSAN<span style="color: #fff; font-weight: 300;">ADMIN</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar"
                style="border-color: var(--gold-accent);">
                <i class="bi bi-list" style="color: var(--gold-accent); font-size: 1.5rem;"></i>
            </button>

            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}"
                            href="{{ route('admin.services.index') }}">Pricelist</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.barbers*') ? 'active' : '' }}"
                            href="{{ route('admin.barbers.index') }}">Barberman</a></li>
                    <li class="nav-item"><a
                            class="nav-link {{ request()->routeIs('admin.reservations*') ? 'active' : '' }}"
                            href="{{ route('admin.reservations.index') }}">Reservasi</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.about*') ? 'active' : '' }}"
                            href="{{ route('admin.about.index') }}">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}"
                            href="{{ route('admin.contacts.index') }}">Pesan</a></li>

                    <li class="nav-item ms-lg-4 mt-3 mt-lg-0 w-100 w-lg-auto">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-gold btn-sm px-4 rounded-0 w-100">LOGOUT</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-5">
        @yield('content')
    </main>

    <footer class="text-center">
        <div class="container">
            <p class="mb-0 serif-font" style="font-size: 0.9rem;">&copy; 2025 Jarsan Barbershop. Defining Masculine
                Excellence.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js