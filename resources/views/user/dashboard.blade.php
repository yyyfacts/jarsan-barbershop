<!DOCTYPE html>
<html lang="id">

<head>
    <title>Dashboard User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
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