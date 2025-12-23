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
        --gold-accent: #D4AF37;
        --glass-bg: rgba(20, 20, 20, 0.95);
    }

    body {
        background-color: var(--bg-dark);
        color: var(--text-main);
        font-family: 'Inter', sans-serif;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        overflow-x: hidden;
        /* Mencegah scroll horizontal pada body */
    }

    /* Typography Global Fix */
    h1,
    h2,
    h3,
    h4,
    .navbar-brand {
        font-family: 'Playfair Display', serif;
        color: var(--text-main);
    }

    /* Navbar Styling - Z-INDEX TINGGI AGAR BISA DIPENCET */
    .navbar-custom {
        background-color: #000;
        border-bottom: 1px solid var(--gold-accent);
        padding: 15px 0;
        position: sticky;
        top: 0;
        z-index: 9999;
        /* Perbaikan Utama: Memastikan menu di atas segalanya */
    }

    /* Tombol Hamburger */
    .navbar-toggler {
        border: 1px solid var(--gold-accent);
        padding: 5px 10px;
        z-index: 10000;
        /* Tombol harus paling atas */
    }

    .navbar-toggler:focus {
        box-shadow: 0 0 10px var(--gold-accent);
    }

    /* Menu Links */
    .nav-link {
        color: #B0B0B0 !important;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 10px 0;
    }

    .nav-link:hover,
    .nav-link.active {
        color: var(--gold-accent) !important;
    }

    /* Table Responsive Fix - Agar bisa digeser */
    .table-responsive {
        border-radius: 8px;
        overflow-x: auto;
        /* Wajib ada untuk scroll */
        -webkit-overflow-scrolling: touch;
        /* Smooth scroll di iPhone */
        background: var(--bg-card);
        border: 1px solid #333;
    }

    /* Agar tabel melebar dan memicu scroll */
    .table {
        width: 100%;
        margin-bottom: 0;
        color: var(--text-main);
        border-color: #333;
        white-space: nowrap;
        /* Perbaikan Utama: Memaksa teks memanjang ke samping */
    }

    .table thead {
        background-color: #000;
    }

    .table thead th {
        color: var(--gold-accent);
        border-bottom: 2px solid var(--gold-accent);
        padding: 15px;
    }

    .table tbody td {
        padding: 15px;
    }

    /* Form Controls */
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

    /* Modal Styling */
    .modal-content {
        background-color: var(--bg-card);
        border: 1px solid var(--gold-accent);
        color: white;
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

    footer {
        background-color: #000;
        padding: 25px 0;
        margin-top: auto;
        border-top: 1px solid #333;
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}" style="color: var(--gold-accent);">
                JARSAN<span class="text-white fw-light">ADMIN</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar"
                aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list" style="font-size: 1.8rem; color: var(--gold-accent);"></i>
            </button>

            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center pt-3 pt-lg-0">
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
                                style="color: var(--gold-accent); border-color: var(--gold-accent);">LOGOUT</button>
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
            <small class="text-muted text-uppercase">&copy; 2025 Jarsan Barbershop. All Rights Reserved.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>