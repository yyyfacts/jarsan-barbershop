<!DOCTYPE html>
<html lang="id">

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
    :root {
        --bg-body: #F4F6F9;
        /* Abu-abu sangat muda (Background Halaman) */
        --bg-card: #FFFFFF;
        /* Putih (Background Kartu/Tabel) */
        --text-main: #333333;
        /* Hitam (Teks Utama) */
        --text-muted: #6c757d;
        /* Abu-abu (Teks Sekunder) */
        --gold-primary: #C5A028;
        /* Emas yang lebih hidup/cerah */
        --gold-hover: #b08d21;
        --border-color: #e9ecef;
        /* Garis batas tipis */
    }

    body {
        background-color: var(--bg-body);
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
        color: #1a1a1a;
        /* Hitam hampir pekat */
        font-weight: 700;
    }

    /* NAVBAR */
    .navbar-custom {
        background-color: #FFFFFF;
        border-bottom: 1px solid #ddd;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 12px 0;
    }

    .navbar-nav .nav-link {
        color: #555 !important;
        font-weight: 500;
        padding: 8px 15px;
        border-radius: 5px;
        transition: all 0.2s;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
        color: var(--gold-primary) !important;
        background-color: #f8f9fa;
        font-weight: 600;
    }

    /* CARDS & TABLES */
    .card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        /* Bayangan halus */
    }

    .table thead th {
        background-color: #f8f9fa;
        color: #555;
        font-weight: 600;
        border-bottom: 2px solid #ddd;
        text-transform: uppercase;
        font-size: 0.8rem;
        padding: 15px;
    }

    .table tbody td {
        padding: 15px;
        vertical-align: middle;
        color: #333;
        border-bottom: 1px solid #eee;
    }

    .table-hover tbody tr:hover {
        background-color: #fafafa;
    }

    /* BUTTONS & INPUTS */
    .btn-gold {
        background-color: var(--gold-primary);
        color: #fff;
        border: none;
        padding: 8px 20px;
        font-weight: 500;
    }

    .btn-gold:hover {
        background-color: var(--gold-hover);
        color: #fff;
    }

    .form-control,
    .form-select {
        background-color: #fff;
        border: 1px solid #ced4da;
        color: #333;
    }

    .form-control:focus {
        border-color: var(--gold-primary);
        box-shadow: 0 0 0 0.2rem rgba(197, 160, 40, 0.25);
    }

    /* FOOTER */
    footer {
        background-color: #fff;
        border-top: 1px solid #ddd;
        margin-top: auto;
        padding: 20px 0;
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}">
                @php
                // Contoh logika sederhana mengambil logo. Sesuaikan dengan controller Anda.
                $settings = \App\Models\Setting::first();
                $logoUrl = $settings && $settings->logo_path ? asset($settings->logo_path) :
                'https://ui-avatars.com/api/?name=Jarsan+B&background=C5A028&color=fff';
                @endphp
                <img src="{{ $logoUrl }}" alt="Logo" width="40" height="40"
                    class="rounded-circle object-fit-cover shadow-sm">
                <div class="d-flex flex-column">
                    <span class="fw-bold fs-5 text-dark" style="line-height: 1;">JARSAN</span>
                    <span class="text-muted small" style="font-size: 0.7rem; letter-spacing: 1px;">BARBERSHOP</span>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
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
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}"
                            href="{{ route('admin.settings.index') }}">Pengaturan</a></li>

                    <li class="nav-item ms-lg-2">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-outline-danger px-4 rounded-pill">Logout</button>
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
            <small class="text-muted">&copy; 2025 Jarsan Barbershop Management. All Rights Reserved.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>