@extends('layouts.app')

@section('title', 'Barberman - Jarsan Barbershop')

@section('content')
<section class="hero-barber text-center text-white d-flex align-items-center justify-content-center position-relative"
    style="background: url('{{ asset('images/banner.webp') }}') center/cover no-repeat; height: 60vh;">
    <div class="overlay position-absolute w-100 h-100" style="background: rgba(0,0,0,0.6);"></div>
    <div class="position-relative z-2">
        <h1 class="fw-bold display-5 mb-3">TIM PROFESIONAL KAMI</h1>
        <p class="lead">Ditangani oleh tangan-tangan ahli berpengalaman.</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4 justify-content-center">
            @forelse($barbers as $barber)
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 text-center p-3">
                    <div class="card-img-top overflow-hidden rounded-circle mx-auto mt-3"
                        style="width: 150px; height: 150px;">

                        {{-- TAMPILKAN GAMBAR DARI BASE64 --}}
                        @if($barber->photo_path)
                        <img src="{{ $barber->photo_path }}" class="w-100 h-100 object-fit-cover"
                            alt="{{ $barber->name }}">
                        @else
                        <img src="{{ asset('images/default-barber.jpg') }}" class="w-100 h-100 object-fit-cover"
                            alt="Default">
                        @endif

                    </div>
                    <div class="card-body">
                        <h5 class="fw-bold">{{ $barber->name }}</h5>
                        <p class="text-primary small fw-bold">{{ $barber->specialty ?? 'Barber' }}</p>
                        <p class="text-muted small">
                            {{ $barber->bio ?? 'Siap memberikan potongan rambut terbaik untuk Anda.' }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted fs-5">Belum ada data barberman yang ditambahkan.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection