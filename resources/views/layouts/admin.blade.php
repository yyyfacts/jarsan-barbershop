<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark navbar-expand">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Jarsan</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('services.index') }}">Pricelist</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('barbers.index') }}">Barberman</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('reservations.index') }}">Reservasi</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about.edit') }}">Tentang Kami</a></li>
                <li class="nav-item">
                    <a href="{{ route('contacts.index') }}"
                        class="nav-link {{ request()->routeIs('contacts.*') ? 'active' : '' }}">
                        Hubungi Kami
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('admin.logout') }}">@csrf
                        <button class="btn btn-sm btn-warning ms-3">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    <main class="container py-4">
        @if(session('ok')) <div class="alert alert-success">{{ session('ok') }}</div>@endif
        @yield('content')
    </main>
</body>

</html>