@extends('layouts.app')

@section('title', 'The Artists - Jarsan')

@section('content')
@push('styles')
<link
    href="https://fonts.googleapis.com/css2?family=Italiana&family=Playfair+Display:ital,wght@0,900;1,400&display=swap"
    rel="stylesheet">
<style>
:root {
    --luxury-gold: #D4AF37;
    --matte-black: #0A0A0A;
}

body {
    background-color: var(--matte-black);
}

/* --- PARALLAX TEXT BACKGROUND --- */
.bg-marquee-artist {
    position: absolute;
    top: 20%;
    left: 0;
    width: 100%;
    white-space: nowrap;
    font-size: 15rem;
    font-family: 'Italiana', serif;
    color: rgba(255, 255, 255, 0.02);
    z-index: 0;
    pointer-events: none;
    user-select: none;
}

/* --- MASTER CARD DESIGN --- */
.barber-gallery-card {
    background: #121212;
    border: 1px solid rgba(212, 175, 55, 0.1);
    position: relative;
    transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
    overflow: hidden;
}

.barber-gallery-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 3px;
    height: 0;
    background: var(--luxury-gold);
    transition: 0.6s;
}

.barber-gallery-card:hover {
    transform: translateY(-15px);
    border-color: var(--luxury-gold);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);
}

.barber-gallery-card:hover::before {
    height: 100%;
}

/* --- IMAGE OVERLAY --- */
.artist-img-frame {
    height: 400px;
    position: relative;
    clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
}

.artist-img-frame img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: grayscale(100%) contrast(1.1);
    transition: 0.8s;
}

.barber-gallery-card:hover img {
    filter: grayscale(0%) contrast(1);
    transform: scale(1.1);
}

.artist-img-frame::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 50%;
    background: linear-gradient(to top, #121212, transparent);
}

/* --- TYPOGRAPHY --- */
.artist-name {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    color: #fff;
    margin-bottom: 5px;
}

.artist-specialty {
    font-family: 'Italiana', serif;
    color: var(--luxury-gold);
    letter-spacing: 3px;
    font-size: 0.8rem;
    text-transform: uppercase;
    margin-bottom: 15px;
    display: block;
}

/* --- SCHEDULE CHIP --- */
.schedule-chip {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 8px 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 15px;
}

.status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 8px;
}

.btn-book-artist {
    background: transparent;
    border: 1px solid var(--luxury-gold);
    color: var(--luxury-gold);
    text-transform: uppercase;
    letter-spacing: 2px;
    font-weight: bold;
    padding: 12px;
    transition: 0.4s;
    width: 100%;
    margin-top: 20px;
}

.btn-book-artist:hover {
    background: var(--luxury-gold);
    color: #000;
}
</style>
@endpush

<section class="py-5 position-relative" style="overflow: hidden; min-height: 100vh;">
    {{-- TEKS JALAN BACKGROUND --}}
    <div class="bg-marquee-artist">
        ARTISTS • MASTERS • BARBERS • ARTISTS • MASTERS • BARBERS
    </div>

    <div class="container py-5 position-relative" style="z-index: 1;">
        <div class="text-center mb-5">
            <h5 class="text-gold font-heading letter-spacing-5 mb-3" data-aos="fade-down">
                {{ $pageConfig->barber_subtitle ?? 'THE MASTER HANDS' }}
            </h5>
            <h2 class="display-3 fw-bold text-white mb-5" style="font-family: 'Playfair Display', serif;"
                data-aos="fade-up">
                {!! $pageConfig->barber_title ?? 'MEET OUR <span class="fst-italic text-gold">CRAFTSMEN</span>' !!}
            </h2>
        </div>

        <div class="row g-5 justify-content-center">
            @forelse($barbers as $barber)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                <div class="barber-gallery-card">
                    {{-- IMAGE --}}
                    <div class="artist-img-frame">
                        <img src="{{ $barber->photo_path ?? 'https://ui-avatars.com/api/?name=' . urlencode($barber->name) . '&background=121212&color=D4AF37&size=500' }}"
                            alt="{{ $barber->name }}">
                    </div>

                    {{-- CONTENT --}}
                    <div class="p-4 pt-0 position-relative" style="margin-top: -30px; z-index: 2;">
                        <span class="artist-specialty">{{ $barber->specialty ?? 'Master Barber' }}</span>
                        <h3 class="artist-name">{{ $barber->name }}</h3>

                        <p class="text-white-50 small fst-italic mb-4">
                            "{{ $barber->bio ?? 'Ready to deliver the finest precision cut for your unique style.' }}"
                        </p>

                        @php
                        $daysMap = ['Sun'=>'Minggu', 'Mon'=>'Senin', 'Tue'=>'Selasa', 'Wed'=>'Rabu', 'Thu'=>'Kamis',
                        'Fri'=>'Jumat', 'Sat'=>'Sabtu'];
                        $today = $daysMap[date('D')];
                        $todaySchedule = $barber->schedule[$today] ?? 'OFF';
                        $isOff = (strtoupper($todaySchedule) === 'OFF' || !$todaySchedule);
                        @endphp

                        <div class="schedule-chip">
                            <span class="small text-white-50">Jadwal Hari Ini</span>
                            <span class="small {{ $isOff ? 'text-danger' : 'text-success' }} fw-bold">
                                <span class="status-dot"
                                    style="background: {{ $isOff ? '#ff4d4d' : '#00ff88' }}"></span>
                                {{ $isOff ? 'LIBUR' : $todaySchedule }}
                            </span>
                        </div>

                        <a href="{{ route('reservasi') }}" class="btn btn-book-artist">
                            Book This Artist
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="p-5 border border-secondary border-opacity-25 border-dashed">
                    <h4 class="text-white-50 font-serif">Our chairs are waiting for masters...</h4>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<div style="height: 100px;"></div>

@endsection