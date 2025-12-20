@extends('layouts.app')

@section('title', 'Pricelist - Jarsan Barbershop')

@section('content')
{{-- HERO / BANNER --}}
<section class="hero-banner d-flex align-items-center text-center text-white position-relative w-100"
    style="background: url('{{ asset('images/banner.webp') }}') center/cover no-repeat; height: 60vh;">

    <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.7); z-index: 1;">
    </div>

    <div class="position-relative z-2 w-100" style="z-index: 2;">
        <h1 class="fw-bold display-5 mb-3 text-shadow">Daftar Harga Layanan</h1>
        <p class="lead mb-0 text-shadow">Nikmati perawatan rambut terbaik dengan hasil profesional</p>
    </div>
</section>

{{-- PRICELIST --}}
<section class="py-5" style="background-color: #f5f5f5;">
    <div class="container text-center">
        <h2 class="fw-bold mb-5 text-warning text-uppercase">Jarsan Barbershop Service</h2>

        <div class="row g-4 justify-content-center">
            {{-- Loop data dinamis dari database --}}
            @forelse ($services as $service)
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="service-card position-relative rounded-4 overflow-hidden shadow-lg bg-white">

                    {{-- TAMPILKAN GAMBAR BASE64 --}}
                    @if ($service->image_path)
                    <img src="{{ $service->image_path }}" alt="{{ $service->name }}" class="card-img"
                        onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
                    @else
                    <img src="https://via.placeholder.com/400x300?text=No+Image" alt="Default Image" class="card-img">
                    @endif

                    <div class="overlay-gradient"></div>
                    <div class="content text-center">
                        <h4 class="fw-bold text-uppercase text-dark">{{ $service->name }}</h4>
                        <p class="small mb-2 text-secondary">
                            {{ $service->description ?? 'Deskripsi belum tersedia.' }}
                        </p>
                        <p class="fw-semibold mb-1" style="color: #ffcc00;">
                            Durasi: {{ $service->duration_minutes ?? '-' }} menit
                        </p>
                        <h5 class="fw-bold" style="color: #ffcc00;">
                            Rp {{ number_format($service->price, 0, ',', '.') }}
                        </h5>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-secondary">Belum ada layanan tersedia saat ini.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
<section class="py-5 bg-warning text-center text-dark">
    <div class="container">
        <h3 class="fw-bold mb-3">Ingin tampil lebih keren?</h3>
        <p class="mb-4">Pesan jadwal cukurmu sekarang dan rasakan pengalaman berbeda di Jarsan Barbershop.</p>
        <a href="{{ url('/reservasi') }}" class="btn btn-dark fw-semibold rounded-pill px-5 py-2 shadow-sm">
            Reservasi Sekarang
        </a>
    </div>
</section>
@endsection

@push('styles')
<style>
/* --- HERO BANNER --- */
.hero-banner {
    background-position: center;
    background-size: cover;
    transition: background-size 1s ease;
}

.hero-banner:hover {
    background-size: 110%;
}

.text-shadow {
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.6);
}

/* --- SERVICE CARD --- */
.service-card {
    height: 340px;
    position: relative;
    overflow: hidden;
    border-radius: 18px;
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.service-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.service-card .card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 0.4s ease, filter 0.4s ease;
}

.service-card:hover .card-img {
    transform: scale(1.05);
    filter: brightness(1.05);
}

/* --- OVERLAY --- */
.overlay-gradient {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(255, 255, 255, 0.05) 20%, rgba(0, 0, 0, 0.6) 100%);
    z-index: 1;
}

/* --- CONTENT --- */
.content {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 20px 10px;
    z-index: 2;
    background: rgba(255, 255, 255, 0.95);
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}

.content h4 {
    font-size: 1.1rem;
    margin-bottom: 0.3rem;
}

.content p {
    font-size: 0.9rem;
    line-height: 1.4;
    margin-bottom: 0.3rem;
}

/* --- RESPONSIVE --- */
@media (max-width: 992px) {
    .service-card {
        height: 300px;
    }
}

@media (max-width: 768px) {
    .service-card {
        height: 270px;
    }
}
</style>
@endpush