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

                    {{-- Gradient Overlay (Agar teks judul terbaca jelas saat content di bawah) --}}
                    <div class="overlay-gradient"></div>

                    {{-- KONTEN TEKS (JUDUL, DESKRIPSI, HARGA) --}}
                    <div class="content text-center">
                        {{-- Ikon Garis Kecil (Pemanis) --}}
                        <div class="slide-indicator mb-2"></div>

                        <h4 class="fw-bold text-uppercase text-dark mb-3">{{ $service->name }}</h4>

                        {{-- Bagian ini akan tersembunyi awalnya, dan muncul saat hover --}}
                        <div class="details">
                            <p class="small mb-2 text-secondary px-2">
                                {{ $service->description ?? 'Deskripsi belum tersedia.' }}
                            </p>
                            <div class="my-3 border-top w-50 mx-auto"></div>
                            <p class="fw-semibold mb-1 text-muted small">
                                Durasi: <span class="text-dark">{{ $service->duration_minutes ?? '-' }} menit</span>
                            </p>
                            <h5 class="fw-bold text-warning mt-2 fs-4">
                                Rp {{ number_format($service->price, 0, ',', '.') }}
                            </h5>
                        </div>
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
    height: 380px;
    /* Sedikit dipertinggi agar proporsional */
    position: relative;
    overflow: hidden;
    border-radius: 18px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
    cursor: pointer;
}

.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
}

/* --- GAMBAR --- */
.service-card .card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top center;
    /* Fokus ke bagian atas gambar (wajah) */
    transition: transform 0.6s ease;
}

/* Efek Zoom Gambar saat Hover */
.service-card:hover .card-img {
    transform: scale(1.1);
}

/* --- OVERLAY GRADIENT (Agar tulisan bawah terbaca) --- */
.overlay-gradient {
    position: absolute;
    inset: 0;
    background: linear-gradient(0deg, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0) 50%);
    z-index: 1;
    pointer-events: none;
}

/* --- CONTENT BOX (ANIMASI UTAMA) --- */
.content {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 20px 15px;
    z-index: 2;
    background: rgba(255, 255, 255, 0.95);
    border-top-left-radius: 25px;
    border-top-right-radius: 25px;

    /* LOGIKA ANIMASI: */
    /* Geser ke bawah sejauh 100% dikurangi tinggi judul (~70px) */
    /* Jadi awalnya cuma Judul yang kelihatan di bawah */
    transform: translateY(calc(100% - 75px));
    transition: transform 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
}

/* Saat Card di-Hover -> Content Geser ke Atas (Posisi 0) */
.service-card:hover .content {
    transform: translateY(0);
}

/* Indikator Garis Kecil di atas Judul */
.slide-indicator {
    width: 40px;
    height: 4px;
    background-color: #ddd;
    margin: 0 auto;
    border-radius: 2px;
}

.service-card:hover .slide-indicator {
    background-color: #ffc107;
    /* Berubah kuning saat hover */
}

/* --- RESPONSIVE --- */
@media (max-width: 992px) {
    .service-card {
        height: 320px;
    }
}
</style>
@endpush