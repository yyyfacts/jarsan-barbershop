<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Jarsan - Premium Barbershop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:wght@400;600;700&display=swap"
        rel="stylesheet">

    <style>
    :root {
        --bg-dark: #121212;
        --bg-card: #1E1E1E;
        --text-main: #E0E0E0;
        /* Teks Putih Terang */
        --text-muted: #B0B0B0;
        /* Abu-abu Terang (Bukan Gelap) */
        --gold-accent: #D4AF37;
        --gold-hover: #F4CF57;
        --glass-bg: rgba(30, 30, 30, 0.95);
        /* Lebih solid agar menu jelas */
        --glass-border: 1px solid rgba(255, 255, 255, 0.1);
    }

    body {
        background-color: var(--bg-dark);
        color: var(--text-main);
        /* Default Teks Putih */
        font-family: 'Inter', sans-serif;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    /* PERBAIKAN TEKS GLOBAL */
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    th,
    td,
    p,
    span,
    div,
    label {
        color: var(--text-main);
    }

    .text-muted {
        color: var(--text-muted) !important;
        /* Override Bootstrap Muted */
    }

    /* Typography */
    .serif-font,
    h1,
    h2,
    h3,
    .navbar-brand {
        font-family: 'Playfair Display', serif;
    }

    /* Navbar Fix Mobile */
    .navbar-custom {
        background-color: #000000;
        /* Hitam pekat di HP agar kontras */
        border-bottom: 1px solid var(--gold-accent);
        padding: 15px 0;
        z-index: 1050;
        /* Pastikan di atas segalanya */
    }

    .navbar-toggler {
        border: 1px solid var(--gold-accent);
        padding: 5px 10px;
    }

    .navbar-toggler:focus {
        box-shadow: 0 0 10px var(--gold-accent);
    }

    .nav-link {
        color: var(--text-muted) !important;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 5px 0;
    }

    .nav-link:hover,
    .nav-link.active {
        color: var(--gold-accent) !important;
    }

    /* Card Style */
    .card {
        background-color: var(--bg-card);
        border: 1px solid #333;
        border-radius: 12px;
    }

    /* Input Form Gelap */
    .form-control,
    .form-select {
        background-color: #2A2A2A;
        border: 1px solid #444;
        color: #FFF !important;
        /* Teks Input Putih */
    }

    .form-control:focus {
        background-color: #333;
        color: #FFF !important;
        border-color: var(--gold-accent);
        box-shadow: none;
    }

    /* Modal Fix */
    .modal-content {
        background-color: var(--bg-card);
        border: 1px solid var(--gold-accent);
    }

    .modal-header,
    .modal-footer {
        border-color: #333;
    }

    .btn-close {
        filter: invert(1);
        /* Tombol Close Putih */
    }

    /* Button Gold */
    .btn-gold {
        background-color: var(--gold-accent);
        color: #000 !important;
        /* Teks tombol hitam agar terbaca */
        font-weight: 700;
        border: none;
    }

    .btn-gold:hover {
        background-color: var(--gold-hover);
    }

    /* Table Responsive Fix */
    .table-responsive {
        border-radius: 8px;
        overflow: hidden;
    }

    .table {
        --bs-table-bg: transparent;
        --bs-table-color: var(--text-main);
        border-color: #333;
    }

    thead {
        background-color: #000;
    }

    thead th {
        color: var(--gold-accent) !important;
        border-bottom: 2px solid var(--gold-accent);
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

    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}" style="color: var(--gold-accent);">
                JARSAN<span class="text-white fw-light">ADMIN</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar"
                aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list" style="font-size: 1.8rem; color: var(--gold-accent);"></i>
            </button>

            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
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

                    <li class="nav-item mt-3 mt-lg-0 ms-lg-3">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-warning btn-sm w-100 px-4 rounded-0"
                                style="color: var(--gold-accent); border-color: var(--gold-accent);">
                                LOGOUT
                            </button>
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
            <small class="text-muted text-uppercase letter-spacing-1">&copy; 2025 Jarsan Barbershop. All Rights
                Reserved.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>