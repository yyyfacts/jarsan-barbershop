@extends('layouts.app')

@section('title', 'Dashboard Saya')

@section('content')
<div class="container py-5">

    {{-- HEADER DASHBOARD --}}
    <div class="row align-items-center mb-5">
        <div class="col-md-8">
            <h5 class="text-muted">Selamat Datang,</h5>
            <h2 class="fw-bold display-5">{{ Auth::user()->name }} 👋</h2>
            <p class="text-muted">Kelola jadwal potong rambutmu di sini.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('reservasi') }}" class="btn btn-dark rounded-pill px-4 py-3 fw-bold shadow">
                + Buat Reservasi Baru
            </a>
        </div>
    </div>

    {{-- KARTU STATUS --}}
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 bg-primary text-white h-100">
                <div class="card-body p-4">
                    <h2 class="fw-bold">0</h2>
                    <small>Total Booking</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-warning">Status Terkini</h5>
                    <small class="text-muted">Belum ada jadwal aktif.</small>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection