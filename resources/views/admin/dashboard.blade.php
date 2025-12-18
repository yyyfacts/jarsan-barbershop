@extends('layouts.admin')

@section('content')
<div class="text-center mb-5">
    <h2 class="fw-bold">Dashboard Admin</h2>
</div>

<div class="row g-4 justify-content-center">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 text-center">
            <h5 class="text-muted">Reservasi Hari Ini</h5>
            <h1 class="fw-bold display-4">2</h1>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 text-center">
            <h5 class="text-muted">Total Layanan</h5>
            <h1 class="fw-bold display-4">4</h1>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 text-center">
            <h5 class="text-muted">Total Barber</h5>
            <h1 class="fw-bold display-4">1</h1>
        </div>
    </div>
</div>
@endsection