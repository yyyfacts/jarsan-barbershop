<!DOCTYPE html>
<html lang="id">

<head>
    <title>{{ $setting->app_name ?? 'Dashboard User' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5 text-center">
        <div class="mb-4">
            @if(!empty($setting->logo_path))
            <img src="{{ $setting->logo_path }}" alt="Logo" style="max-height: 100px; width: auto;">
            @else
            <h2 class="fw-bold">{{ $setting->app_name ?? 'Jarsan Barbershop' }}</h2>
            @endif
        </div>

        <h1>Selamat Datang, {{ auth()->user()->name }}!</h1>
        <p>Anda berhasil login sebagai User Biasa.</p>

        <a href="{{ route('reservasi') }}" class="btn btn-primary">Booking Sekarang</a>

        <form action="{{ route('logout') }}" method="POST" class="mt-3">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
    </div>
</body>

</html>