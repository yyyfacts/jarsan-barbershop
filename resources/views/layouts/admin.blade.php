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
    /* CSS VARIABLES UNTUK TEMA */
    :root {
        --bg-body: #F4F6F9;
        --bg-card: #FFFFFF;
        --bg-input: #FFFFFF;
        --text-main: #333333;
        --text-muted: #6c757d;
        --border-color: #e9ecef;
        --gold-primary: #C5A028;
        --gold-hover: #b08d21;
        --table-hover: #f8f9fa;
    }

    [data-theme="dark"] {
        --bg-body: #121212;
        --bg-card: #1E1E1E;
        --bg-input: #2C2C2C;
        --text-main: #E0E0E0;
        --text-muted: #A0A0A0;
        --border-color: #333333;
        --gold-primary: #D4AF37;
        --gold-hover: #F4CF57;
        --table-hover: #252525;
    }

    body {
        background-color: var(--bg-body);
        color: var(--text-main);
        font-family: 'Inter', sans-serif;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .navbar-custom {
        background-color: var(--bg-card);
        border-bottom: 1px solid var(--border-color);
        padding: 12px 0;
    }

    .nav-link {
        color: var(--text-muted) !important;
        font-weight: 500;
        transition: 0.2s;
    }

    .nav-link:hover,
    .nav-link.active {
        color: var(--gold-primary) !important;
        font-weight: 600;
    }

    .card,
    .modal-content {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        color: var(--text-main);
    }

    .form-control,
    .form-select {
        background-color: var(--bg-input);
        border: 1px solid var(--border-color);
        color: var(--text-main);
    }

    .form-control:focus {
        border-color: var(--gold-primary);
        box-shadow: none;
    }

    .table {
        color: var(--text-main);
        --bs-table-bg: transparent;
        --bs-table-border-color: var(--border-color);
    }

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

    .theme-toggle {
        cursor: pointer;
        padding: 8px;
        color: var(--text-main);
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}">
                @php
                // LOGIKA AMAN: Jika tabel belum ada, pakai default agar tidak error
                $appName = 'Jarsan Barbershop';
                $logoSrc = 'https://ui-avatars.com/api/?name=Jarsan&background=C5A028&color=fff';

                try {
                if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $set = \App\Models\Setting::first();
                if ($set) {
                $appName = $set->app_name;
                if ($set->logo_path) {
                $logoSrc = $set->logo_path;
                }
                }
                }
                } catch (\Exception $e) {
                // Diamkan error jika database bermasalah
                }
                @endphp
                <img src="{{ $logoSrc }}" width="40" height="40"
                    class="rounded-circle object-fit-cover border border-secondary">
                <div class="d-flex flex-column">
                    <span class="fw-bold fs-5" style="line-height: 1; color: var(--text-main);">{{ $appName }}</span>
                    <span class="small" style="font-size: 0.7rem; color: var(--text-muted);">ADMINISTRATOR</span>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list fs-2" style="color: var(--text-main);"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
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

                    <li class="nav-item">
                        <div class="theme-toggle" onclick="toggleTheme()"><i id="themeIcon"
                                class="bi bi-moon-stars-fill"></i></div>
                    </li>

                    <li class="nav-item">
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

    <footer class="text-center py-4 mt-auto border-top" style="border-color: var(--border-color) !important;">
        <small style="color: var(--text-muted);">&copy; 2025 {{ $appName }}. All Rights Reserved.</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);
    updateIcon(savedTheme);

    function toggleTheme() {
        const current = document.documentElement.getAttribute('data-theme');
        const newTheme = current === 'light' ? 'dark' : 'light';
        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateIcon(newTheme);
    }

    function updateIcon(t) {
        document.getElementById('themeIcon').className = t === 'dark' ? 'bi bi-sun-fill' : 'bi bi-moon-stars-fill';
    }
    </script>
</body>

</html>