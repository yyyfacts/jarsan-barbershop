@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
{{-- HERO / BANNER SECTION --}}
<section 
    class="hero-banner d-flex align-items-center text-center text-white position-relative w-100"
    style="background: url('{{ asset('images/banner.webp') }}') center/cover no-repeat; height: 85vh;">
    
    {{-- Overlay Gelap --}}
    <div class="overlay position-absolute top-0 start-0 w-100 h-100" 
        style="background: rgba(0,0,0,0.6); z-index: 1;"></div>

    {{-- Teks di Atas Banner --}}
    <div class="position-relative z-2 w-100" style="z-index: 2;">
        <h1 class="fw-bold display-4 mb-3 text-shadow">Quality, Over Quantity</h1>
        <p class="lead mb-4 text-shadow">
            Rasakan pengalaman potong rambut premium di <strong>Jarsan Barbershop</strong>.
        </p>
        <a href="reservasi" class="btn btn-outline-light btn-lg text-white shadow-sm px-5 py-2 btn-reservasi">
            Reservasi Sekarang
        </a>
    </div>
</section>

{{-- LAYANAN --}}
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="fw-bold mb-4 text-uppercase">Layanan Kami</h2>
        
        <div class="row g-4 justify-content-center">
            <div class="col-md-4 col-sm-6">
                <div class="card service-card border-0 shadow-lg h-100">
                    <img src="{{ asset('images/haircut.jpg') }}" class="card-img-top" alt="Potong Rambut">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Haircut</h5>
                        <p class="card-text text-muted">Potongan modern, klasik, atau sesuai gaya kamu — semua dengan presisi tinggi dan profesionalisme barber terbaik.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card service-card border-0 shadow-lg h-100">
                    <img src="{{ asset('images/coloring.webp') }}" class="card-img-top" alt="Hair Coloring">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Hair Coloring</h5>
                        <p class="card-text text-muted">Transformasi warna rambutmu dengan produk premium untuk hasil yang menawan dan tahan lama.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- BARBERMAN --}}
<section class="py-5 bg-dark">
    <div class="container text-center text-white">
        <h2 class="fw-bold mb-5 text-uppercase">Barberman</h2>

        <div class="row g-4 justify-content-center">
            <div class="col-md-3 col-sm-6">
                <div class="card barber-card border-0 shadow bg-light text-black">
                    <img src="{{ asset('images/barber1.jpg') }}" class="card-img-top" alt="Barberman 1">
                    <div class="card-body">
                        <h5 class="fw-bold">Rizky</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card barber-card border-0 shadow bg-light text-black">
                    <img src="{{ asset('images/barber2.jpg') }}" class="card-img-top" alt="Barberman 2">
                    <div class="card-body">
                        <h5 class="fw-bold">Agus</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card barber-card border-0 shadow bg-light text-black">
                    <img src="{{ asset('images/barber3.jpg') }}" class="card-img-top" alt="Barberman 3">
                    <div class="card-body">
                        <h5 class="fw-bold">Fahri</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- TESTIMONI --}}
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="fw-bold mb-4 text-uppercase">Apa Kata Pelanggan Kami</h2>
        <blockquote class="blockquote mx-auto" style="max-width: 700px;">
            <p class="mb-3 fst-italic fs-5 text-muted">
                “Pelayanan luar biasa! Barber-nya ramah dan hasil potongannya top banget.”
            </p>
            <footer class="blockquote-footer">Andi, Pelanggan Setia</footer>
        </blockquote>
    </div>
</section>
@endsection

@push('styles')
<style>
/* Banner */
.hero-banner {
    background-position: center;
    background-size: cover;
    transition: background-size 1s ease;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}
.hero-banner:hover {
    background-size: 110%;
}
.text-shadow {
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.6);
}

/* Tombol elegan putih transparan */
.btn-reservasi {
    border: 2px solid #fff;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
    backdrop-filter: blur(5px);
}
.btn-reservasi:hover {
    background-color: #fff;
    color: #000000ff !important;
    transform: scale(1.05);
}

/* Service Cards */
.service-card {
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.service-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}
.service-card img {
    height: 250px;
    object-fit: cover;
}

/* Barberman Cards */
.barber-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: .75rem;
    overflow: hidden;
}
.barber-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 25px rgba(255,255,255,0.15);
}
.barber-card img {
    height: 320px;
    object-fit: cover;
}
.text-light-emphasis {
    color: rgba(255,255,255,0.75);
}
</style>
@endpush
