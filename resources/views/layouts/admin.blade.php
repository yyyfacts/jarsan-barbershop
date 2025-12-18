<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Jarsan</title>
    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
    body {
        background-color: #f8f9fa;
        font-family: 'Poppins', sans-serif;
    }

    /* Header Hitam */
    .admin-header {
        background-color: #212529;
        color: white;
        padding: 15px 0;
    }

    /* Menu Link */
    .admin-nav .nav-link {
        color: #adb5bd;
        font-weight: 500;
        margin-left: 15px;
        transition: 0.3s;
        font-size: 0.95rem;
    }

    .admin-nav .nav-link:hover,
    .admin-nav .nav-link.active {
        color: #fff;
    }

    /* Tombol Logout Kuning */
    .btn-logout {
        background-color: #ffc107;
        color: #000;
        font-weight: bold;
        border: none;
        padding: 5px 20px;
    }

    .btn-logout:hover {
        background-color: #e0a800;
    }

    /* Card Dashboard */
    .card-dashboard {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    /* Tabel */
    .table th {
        background-color: #212529;
        color: white;
        text-align: center;
    }

    .table td {
        vertical-align: middle;
        text-align: center;
    }
    </style>
</head>

<body>

    <div class="admin-header shadow-sm sticky-top">
        <div class="container d-flex justify-content-between align-items-center">

            <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none">
                <h4 class="m-0 fw-bold">Admin Jarsan</h4>
            </a>

            <div class="d-flex align-items-center">
                <nav class="d-none d-md-flex admin-nav me-4">
                    <a href="{{ route('admin.services') }}"
                        class="nav-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}">Pricelist</a>
                    <a href="{{ route('admin.barbers.index') }}"
                        class="nav-link {{ request()->routeIs('admin.barbers*') ? 'active' : '' }}">Barberman</a>
                    <a href="{{ route('admin.reservations') }}"
                        class="nav-link {{ request()->routeIs('admin.reservations*') ? 'active' : '' }}">Reservasi</a>
                    <a href="{{ route('admin.about.edit') }}"
                        class="nav-link {{ request()->routeIs('admin.about*') ? 'active' : '' }}">Tentang Kami</a>
                    <a href="{{ route('admin.contacts') }}"
                        class="nav-link {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}">Hubungi Kami</a>
                </nav>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-sm btn-logout rounded-1">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container mt-5 mb-5">

        {{-- Alert Sukses --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>