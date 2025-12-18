<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Jarsan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
    body {
        background-color: #f8f9fa;
    }

    .admin-header {
        background-color: #212529;
        color: white;
        padding: 15px 0;
    }

    .nav-link {
        color: #ccc;
        font-weight: 500;
        transition: 0.3s;
    }

    .nav-link:hover,
    .nav-link.active {
        color: #fff;
    }

    .btn-logout {
        background-color: #ffc107;
        color: #000;
        font-weight: bold;
        border: none;
    }

    .btn-logout:hover {
        background-color: #e0a800;
    }
    </style>
</head>

<body>

    <div class="admin-header shadow-sm sticky-top">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h4 class="m-0 fw-bold me-4">Admin Panel</h4>
                <nav class="d-none d-md-block">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link d-inline mx-2">Dashboard</a>
                    <a href="{{ route('admin.services') }}" class="nav-link d-inline mx-2">Layanan</a>
                    <a href="{{ route('admin.reservations') }}" class="nav-link d-inline mx-2">Reservasi</a>
                    <a href="{{ route('admin.contacts') }}" class="nav-link d-inline mx-2">Pesan</a>
                </nav>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-sm btn-logout px-3 rounded-pill">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="container mt-4 mb-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>