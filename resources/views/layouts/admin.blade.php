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
        --text-main: #FFFFFF;
        --text-secondary: #CCCCCC;
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

    /* TYPOGRAPHY */
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Playfair Display', serif;
        color: #FFFFFF !important;
    }

    .text-gold {
        color: var(--gold-accent) !important;
    }

    .text-secondary {
        color: var(--text-secondary) !important;
    }

    /* NAVBAR STYLING */
    .navbar-custom {
        background-color: #000;
        border-bottom: 1px solid var(--gold-accent);
        padding: 15px 0;
    }

    .navbar-nav .nav-link {
        color: #AAAAAA !important;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 10px 15px;
        transition: 0.3s;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
        color: var(--gold-accent) !important;
        font-weight: bold;
    }

    /* CARD & TABLE */
    .card {
        background-color: var(--bg-card);
        border: 1px solid #333;
        border-radius: 12px;
    }

    .table {
        --bs-table-bg: transparent;
        --bs-table-color: #FFFFFF;
        /* Warna teks tabel putih */
        border-color: #333;
        white-space: nowrap;
    }

    thead th {
        color: var(--gold-accent) !important;
        border-bottom: 2px solid var(--gold-accent);
        font-family: 'Playfair Display', serif;
        padding: 15px;
    }

    tbody td {
        padding: 15px;
        vertical-align: middle;
        color: white !important;
        /* Paksa putih */
    }

    /* FORMS */
    .form-control,
    .form-select {
        background-color: #2A2A2A;
        border: 1px solid #444;
        color: #FFFFFF !important;
    }

    .form-control:focus {
        background-color: #333;
        border-color: var(--gold-accent);
        box-shadow: none;
    }

    /* BUTTONS */
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

    /* MODAL */
    .modal-content {
        background-color: var(--bg-card);
        border: 1px solid var(--gold-accent);
        color: white;
    }

    .btn-close {
        filter: invert(1);
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="{{ route('admin.dashboard') }}"
                style="color: var(--gold-accent);">
                JARSAN<span class="text-white fw-light">ADMIN</span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list fs-1" style="color: var(--gold-accent);"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}"
                            href="{{ route('admin.services.index') }}">Pricelist</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.barbers*') ? 'active' : '' }}"
                            href="{{ route('admin.barbers.index') }}">Barberman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.reservations*') ? 'active' : '' }}"
                            href="{{ route('admin.reservations.index') }}">Reservasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.about*') ? 'active' : '' }}"
                            href="{{ route('admin.about.index') }}">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}"
                            href="{{ route('admin.contacts.index') }}">Pesan</a>
                    </li>

                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-outline-warning rounded-0 px-4 w-100 w-lg-auto"
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

    <footer class="text-center mt-auto border-top border-secondary py-4" style="background-color: #000;">
        <div class="container">
            <small class="text-secondary text-uppercase">&copy; 2025 Jarsan Barbershop. All Rights Reserved.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>