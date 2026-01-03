@extends('layouts.app')

@section('title', 'Service Menu')

@section('content')
<style>
/* --- PRICELIST HERO --- */
.hero-pricelist {
    height: 60vh;
    background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(10, 10, 10, 1)),
    url('{{ asset('images/banner.webp') }}') center/cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

/* --- SERVICE CARD REDESIGN --- */
.luxury-service-card {
    background: var(--matte-black);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 0;
    overflow: hidden;
    transition: 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
    height: 100%;
    position: relative;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
}

.luxury-service-card:hover {
    border-color: var(--luxury-gold);
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(212, 175, 55, 0.1);
}

.service-img-wrapper {
    height: 250px;
    overflow: hidden;
    position: relative;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.service-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: 1s ease;
    filter: grayscale(30%);
}

.luxury-service-card:hover .service-img-wrapper img {
    transform: scale(1.1);
    filter: grayscale(0%);
}

.service-info {
    padding: 30px;
    text-align: center;
}

.service-info h4 {
    color: #ffffff;
    font-weight: 700;
    letter-spacing: 1px;
    margin-bottom: 15px;
    font-family: var(--font-heading);
}

/* Deskripsi text putih transparan */
.service-info p {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.9rem;
    height: 50px;
    overflow: hidden;
    line-height: 1.6;
}

.service-price {
    font-size: 1.5rem;
    color: var(--luxury-gold);
    font-weight: 800;
    font-family: var(--font-heading);
    margin-top: 20px;
    display: block;
    text-shadow: 0 0 10px rgba(212, 175, 55, 0.3);
}

.duration-tag {
    background: rgba(212, 175, 55, 0.1);
    color: var(--luxury-gold);
    padding: 5px 15px;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 2px;
    display: inline-block;
    margin-bottom: 15px;
    border: 1px solid var(--gold-accent);
}
</style>

{{-- BAGIAN HERO (ATAS) --}}
<section class="hero-pricelist">
    <div class="container text-center" data-aos="zoom-out">
        {{-- DINAMIS: Subtitle --}}
        <h5 class="text-gold letter-spacing-2 mb-2">
            {{ $pageConfig->pricelist_subtitle ?? 'EXCLUSIVE TREATMENTS' }}
        </h5>

        {{-- DINAMIS: Title --}}
        <h1 class="display-3 fw-bold text-white mb-2">
            {{ $pageConfig->pricelist_title ?? 'SERVICE MENU' }}
        </h1>

        <div class="mx-auto" style="width: 60px; height: 3px; background: var(--luxury-gold); margin-top: 20px;"></div>

        {{-- DINAMIS: Description --}}
        <p class="lead text-white mt-4 opacity-75">
            {{ $pageConfig->pricelist_description ?? 'Layanan perawatan rambut terbaik untuk hasil pengerjaan profesional dan presisi.' }}
        </p>
    </div>
</section>

{{-- BAGIAN DAFTAR LAYANAN (LOOPING) --}}
<section class="py-5" style="background: var(--deep-charcoal)">
    <div class="container py-5">
        <div class="row g-4 justify-content-center">
            @forelse ($services as $service)
            <div class="col-md-6 col-lg-4 col-xl-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="luxury-service-card">
                    <div class="service-img-wrapper">
                        {{-- Menggunakan placeholder gelap jika gambar tidak ada --}}
                        <img src="{{ $service->image_path ?? 'https://placehold.co/400x300/1a1a1a/FFF?text=JARSAN+Service' }}"
                            alt="{{ $service->name }}">
                    </div>
                    <div class="service-info">
                        <span class="duration-tag text-uppercase">{{ $service->duration_minutes ?? '-' }} MINS
                            SESSION</span>
                        <h4 class="text-uppercase">{{ $service->name }}</h4>
                        <p>{{ $service->description ?? 'Nikmati layanan grooming premium dengan sentuhan handuk hangat dan pijatan relaksasi.' }}
                        </p>
                        <span class="service-price">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-scissors display-1 text-white-50 mb-3"></i>
                <p class="text-white opacity-50 fs-5 fst-italic">Belum ada menu layanan yang tersedia saat ini.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- BAGIAN CTA (BAWAH) --}}
<section class="py-5 position-relative overflow-hidden"
    style="background: var(--matte-black); border-top: 1px solid var(--luxury-gold);">
    <div class="position-absolute top-0 start-0 w-100 h-100"
        style="background: radial-gradient(circle at right, rgba(212, 175, 55, 0.15) 0%, transparent 50%);"></div>

    <div class="container py-4 text-center position-relative" style="z-index: 2;">

        {{-- DINAMIS: CTA Title --}}
        <h2 class="fw-bold text-white mb-3 display-5">
            {{ $pageConfig->pricelist_cta_title ?? 'INGIN TAMPIL LEBIH BERANI?' }}
        </h2>

        {{-- DINAMIS: CTA Text --}}
        <p class="text-white-50 mb-5 fs-5">
            {{ $pageConfig->pricelist_cta_text ?? 'Pesan jadwal pengerjaan Anda sekarang dan rasakan pengalaman grooming eksekutif.' }}
        </p>

        @auth
        <a href="{{ route('reservasi') }}" class="btn btn-gold-luxury btn-lg px-5 py-3 rounded-0 fw-bold shadow-lg">
            BOOK YOUR SLOT NOW
        </a>
        @else
        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-5 py-3 rounded-0 fw-bold hover-gold">
            LOGIN TO BOOKING
        </a>
        @endauth
    </div>
</section>
@endsection