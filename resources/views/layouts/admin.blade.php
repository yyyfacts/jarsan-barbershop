<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Jarsan Barbershop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
    /* Sticky Footer Setup */
    body {
        background-color: #f4f6f9;
        font-family: 'Poppins', sans-serif;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    main {
        flex: 1;
    }

    /* Navbar Styling */
    .navbar-dark {
        background-color: #1a1a1a;
    }

    .navbar-brand {
        font-weight: 700;
        letter-spacing: 1px;
    }

    .nav-link {
        font-size: 0.95rem;
        margin-right: 10px;
        color: #ccc !important;
        transition: 0.3s;
    }

    .nav-link:hover,
    .nav-link.active {
        color: #fff !important;
        font-weight: 600;
    }

    /* Responsive Table Wrapper */
    .table-responsive {
        border-radius: 8px;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        /* Smooth scroll on iOS */
        background: white;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    /* Footer Styling */
    footer {
        background-color: #1a1a1a;
        color: #adb5bd;
        padding: 20px 0;
        margin-top: auto;
        font-size: 0.9rem;
    }

    /* Mobile Adjustments */
    @media (max-width: 768px) {
        .btn-action-mobile {
            width: 100%;
            margin-bottom: 10px;
        }
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-scissors me-2"></i>Admin Jarsan
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#adminNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
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
                            href="{{ route('admin.about.index') }}">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}"
                            href="{{ route('admin.contacts.index') }}">Pesan</a>
                    </li>

                    <li class="nav-item mt-2 mt-lg-0 ms-lg-3 w-100 w-lg-auto">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-warning fw-bold w-100 rounded-pill btn-sm py-2 px-3">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

    <footer class="text-center">
        <div class="container">
            <p class="mb-0">&copy; 2025 Jarsan Barbershop Management System. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>