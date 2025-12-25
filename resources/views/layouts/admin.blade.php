<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Jarsan - Premium Barbershop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@400;600;700&display=swap"
        rel="stylesheet">

    <style>
    :root {
        --bg-body: #0a0a0a;
        --bg-card: #141414;
        --bg-input: #1f1f1f;
        --text-main: #FFFFFF;
        --text-muted: #888888;
        --gold-primary: #D4AF37;
        --gold-hover: #c5a028;
        --border-color: #2a2a2a;
    }

    body {
        background-color: var(--bg-body);
        color: var(--text-main);
        font-family: 'Inter', sans-serif;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    /* CUSTOM SCROLLBAR */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: var(--bg-body);
    }

    ::-webkit-scrollbar-thumb {
        background: #333;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--gold-primary);
    }

    /* TYPOGRAPHY */
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Playfair Display', serif;
        color: #FFFFFF;
    }

    .text-gold {
        color: var(--gold-primary) !important;
    }

    .font-serif {
        font-family: 'Playfair Display', serif;
    }

    .small-caps {
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* NAVBAR - GLASS EFFECT */
    .navbar-custom {
        background: rgba(10, 10, 10, 0.95);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid var(--border-color);
        padding: 12px 0;
    }

    .navbar-nav .nav-link {
        color: #999 !important;
        font-size: 0.9rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 8px 16px;
        transition: all 0.3s ease;
        border-radius: 4px;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
        color: var(--gold-primary) !important;
        background: rgba(212, 175, 55, 0.1);
    }

    /* TABLES - CLEANER & COMPACT */
    .table-custom {
        --bs-table-bg: transparent;
        --bs-table-color: var(--text-main);
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-custom thead th {
        background-color: #1a1a1a;
        color: var(--gold-primary);
        font-family: 'Inter', sans-serif;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-bottom: 2px solid #333;
        padding: 16px;
    }

    .table-custom tbody td {
        padding: 16px;
        vertical-align: middle;
        border-bottom: 1px solid var(--border-color);
        color: #e0e0e0;
        font-size: 0.95rem;
    }

    .table-custom tbody tr:hover td {
        background-color: #1a1a1a;
        color: white;
    }

    /* Utilitas Lebar Kolom */
    .w-fit {
        width: 1%;
        white-space: nowrap;
    }

    /* Agar kolom fit content */
    .max-w-200 {
        max-width: 200px;
    }

    /* Untuk truncate text panjang */

    /* FORMS & MODALS */
    .form-control,
    .form-select {
        background-color: var(--bg-input);
        border: 1px solid var(--border-color);
        color: #fff !important;
        padding: 10px 15px;
        font-size: 0.9rem;
    }

    .form-control:focus {
        background-color: #252525;
        border-color: var(--gold-primary);
        box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.2);
    }

    .modal-content {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
    }

    .modal-header,
    .modal-footer {
        border-color: var(--border-color);
    }

    .btn-close {
        filter: invert(1);
        opacity: 0.5;
    }

    /* BUTTONS */
    .btn-gold {
        background-color: var(--gold-primary);
        color: #000;
        font-weight: 600;
        border: none;
        padding: 8px 24px;
        letter-spacing: 0.5px;
    }

    .btn-gold:hover {
        background-color: var(--gold-hover);
        color: #000;
    }

    .btn-icon {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: 0.2s;
    }

    .btn-icon:hover {
        background: rgba(255, 255, 255, 0.1);
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}">
                <img src="https://ui-avatars.com/api/?name=Jarsan&background=D4AF37&color=000&size=128" alt="Logo"
                    width="35" height="35" class="rounded-circle border border-dark">
                <div class="d-flex flex-column lh-1">
                    <span class="fw-bold fs-5 text-white" style="letter-spacing: -0.5px;">JARSAN</span>
                    <span class="text-gold" style="font-size: 0.65rem; letter-spacing: 2px;">ADMINISTRATOR</span>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list fs-2 text-gold"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
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

                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-outline-danger px-4 py-2 w-100 w-lg-auto"
                                style="border-radius: 4px;">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
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

    <footer class="text-center mt-auto py-4 border-top" style="border-color: #222 !important;">
        <div class="container">
            <small class="text-muted text-uppercase" style="letter-spacing: 1px; font-size: 0.7rem;">&copy; 2025 Jarsan
                Barbershop. All Rights Reserved.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>