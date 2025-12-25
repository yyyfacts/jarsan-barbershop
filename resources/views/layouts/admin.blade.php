<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Jarsan Barbershop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet">

    <style>
    /* DEFINISI VARIABEL WARNA (LIGHT MODE DEFAULT) */
    :root {
        --bg-body: #F4F6F9;
        --bg-card: #FFFFFF;
        --bg-input: #FFFFFF;
        --text-main: #333333;
        --text-muted: #6c757d;
        --border-color: #e9ecef;
        --gold-primary: #C5A028;
        --gold-hover: #b08d21;
        --shadow: 0 4px 6px rgba(0, 0, 0, 0.04);
        --table-hover: #f8f9fa;
    }

    /* DARK MODE OVERRIDES */
    [data-theme="dark"] {
        --bg-body: #121212;
        --bg-card: #1E1E1E;
        --bg-input: #2C2C2C;
        --text-main: #E0E0E0;
        --text-muted: #A0A0A0;
        --border-color: #333333;
        --gold-primary: #D4AF37;
        --gold-hover: #F4CF57;
        --shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        --table-hover: #252525;
    }

    body {
        background-color: var(--bg-body);
        color: var(--text-main);
        font-family: 'Inter', sans-serif;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        transition: background-color 0.3s, color 0.3s;
    }

    /* TYPOGRAPHY */
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Playfair Display', serif;
        color: var(--text-main);
        font-weight: 700;
    }

    /* NAVBAR */
    .navbar-custom {
        background-color: var(--bg-card);
        border-bottom: 1px solid var(--border-color);
        padding: 12px 0;
        transition: background-color 0.3s;
    }

    .navbar-nav .nav-link {
        color: var(--text-muted) !important;
        font-weight: 500;
        padding: 8px 15px;
        border-radius: 5px;
        transition: all 0.2s;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
        color: var(--gold-primary) !important;
        background-color: var(--bg-body);
        font-weight: 600;
    }

    /* COMPONENTS */
    .card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow);
        color: var(--text-main);
    }

    .modal-content {
        background-color: var(--bg-card);
        color: var(--text-main);
        border: 1px solid var(--border-color);
    }

    /* TABLE STYLING */
    .table {
        color: var(--text-main);
        --bs-table-bg: transparent;
        --bs-table-border-color: var(--border-color);
    }

    .table thead th {
        background-color: var(--bg-body);
        color: var(--text-muted);
        border-bottom: 2px solid var(--border-color);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
    }

    .table-hover tbody tr:hover {
        background-color: var(--table-hover) !important;
        color: var(--text-main);
    }

    /* FORMS */
    .form-control,
    .form-select {
        background-color: var(--bg-input);
        border: 1px solid var(--border-color);
        color: var(--text-main);
    }

    .form-control:focus {
        background-color: var(--bg-input);
        border-color: var(--gold-primary);
        color: var(--text-main);
        box-shadow: 0 0 0 0.2rem rgba(197, 160, 40, 0.25);
    }

    /* TOMBOL DARK MODE */
    .theme-toggle {
        cursor: pointer;
        padding: 8px;
        border-radius: 50%;
        transition: background 0.2s;
        color: var(--text-main);
    }

    .theme-toggle:hover {
        background-color: var(--bg-body);
    }

    /* BUTTONS */
    .btn-gold {
        background-color: var(--gold-primary);
        color: #000;
        border: none;
        font-weight: 600;
    }

    .btn-gold:hover {
        background-color: var(--gold-hover);
        color: #000;
    }

    footer {
        background-color: var(--bg-card);
        border-top: 1px solid var(--border-color);
        margin-top: auto;
        padding: 20px 0;
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}">
                @php
                $set = \App\Models\Setting::first();
                $logoSrc = ($set && $set->logo_path) ? $set->logo_path :
                'https://ui-avatars.com/api/?name=Jarsan&background=C5A028&color=fff';
                @endphp
                <img src="{{ $logoSrc }}" width="40" height="40"
                    class="rounded-circle object-fit-cover border border-secondary">
                <div class="d-flex flex-column">
                    <span class="fw-bold fs-5"
                        style="line-height: 1; color: var(--text-main);">{{ $set->app_name ?? 'JARSAN' }}</span>
                    <span class="small" style="font-size: 0.7rem; color: var(--text-muted);">ADMINISTRATOR</span>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list fs-2" style="color: var(--text-main);"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.barbers*') ? 'active' : '' }}"
                            href="{{ route('admin.barbers.index') }}">Barberman</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}"
                            href="{{ route('admin.services.index') }}">Layanan</a></li>
                    <li class="nav-item"><a
                            class="nav-link {{ request()->routeIs('admin.reservations*') ? 'active' : '' }}"
                            href="{{ route('admin.reservations.index') }}">Reservasi</a></li>

                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}"
                            href="{{ route('admin.contacts.index') }}">Pesan</a></li>

                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.about*') ? 'active' : '' }}"
                            href="{{ route('admin.about.index') }}">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}"
                            href="{{ route('admin.settings.index') }}">Pengaturan</a></li>

                    <li class="nav-item ms-lg-2">
                        <div class="theme-toggle" onclick="toggleTheme()" title="Ganti Tema">
                            <i id="themeIcon" class="bi bi-moon-stars-fill"></i>
                        </div>
                    </li>

                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-outline-danger px-3 rounded-pill w-100">Logout</button>
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
            <small style="color: var(--text-muted);">&copy; 2025 Jarsan Barbershop Management. All Rights
                Reserved.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Cek LocalStorage saat halaman dimuat
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);
    updateIcon(savedTheme);

    function toggleTheme() {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';

        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateIcon(newTheme);
    }

    function updateIcon(theme) {
        const icon = document.getElementById('themeIcon');
        if (theme === 'dark') {
            icon.classList.remove('bi-moon-stars-fill');
            icon.classList.add('bi-sun-fill');
        } else {
            icon.classList.remove('bi-sun-fill');
            icon.classList.add('bi-moon-stars-fill');
        }
    }
    </script>
</body>

</html>