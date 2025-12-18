@extends('layouts.admin')

@section('content')
<div class="text-center mb-5">
    <h2 class="fw-bold">Dashboard Admin</h2>
</div>

<div class="row justify-content-center g-4">
    <div class="col-md-4">
        <div class="card card-dashboard p-4 text-center">
            <h5 class="text-muted mb-3">Reservasi Hari Ini</h5>
            <h1 class="fw-bold display-4">{{ $reservasiHariIni ?? 0 }}</h1>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-dashboard p-4 text-center">
            <h5 class="text-muted mb-3">Total Layanan</h5>
            <h1 class="fw-bold display-4">{{ $totalLayanan ?? 0 }}</h1>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-dashboard p-4 text-center">
            <h5 class="text-muted mb-3">Total Barber</h5>
            <h1 class="fw-bold display-4">{{ $totalBarber ?? 0 }}</h1>
        </div>
    </div>
</div>
@endsection