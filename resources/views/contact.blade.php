@extends('layouts.app')

@section('title', 'Get in Touch')

@section('content')
@push('styles')
<link
    href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap"
    rel="stylesheet">
<style>
:root {
    --primary-gold: #D4AF37;
    --dark-bg: #121212;
    --card-bg: #1e1e1e;
}

body {
    background-color: var(--dark-bg);
    color: #fff;
}

/* TYPOGRAPHY */
.font-heading {
    font-family: 'Oswald', sans-serif;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.font-serif {
    font-family: 'Playfair Display', serif;
}

/* UNIQUE INPUT STYLE */
.floating-group {
    position: relative;
    margin-bottom: 2.5rem;
}

.modern-input {
    width: 100%;
    background: transparent;
    border: none;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    padding: 15px 0;
    color: white;
    font-size: 1.1rem;
    transition: 0.3s ease;
    border-radius: 0;
}

.modern-input:focus {
    outline: none;
    border-bottom: 2px solid var(--primary-gold);
    background: transparent;
    box-shadow: none;
}

.floating-label {
    position: absolute;
    top: 15px;
    left: 0;
    color: rgba(255, 255, 255, 0.5);
    pointer-events: none;
    transition: 0.3s ease;
    font-size: 0.9rem;
    letter-spacing: 1px;
}

/* Animasi Label saat input diisi/fokus */
.modern-input:focus~.floating-label,
.modern-input:valid~.floating-label {
    top: -10px;
    font-size: 0.75rem;
    color: var(--primary-gold);
    font-weight: bold;
}

/* BUTTON STYLE - SLIDING EFFECT */
.btn-luxury {
    background: transparent;
    color: var(--primary-gold);
    border: 1px solid var(--primary-gold);
    padding: 15px 40px;
    position: relative;
    overflow: hidden;
    transition: 0.4s;
    z-index: 1;
    font-family: 'Oswald', sans-serif;
    letter-spacing: 3px;
}

.btn-luxury::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: var(--primary-gold);
    transition: 0.4s;
    z-index: -1;
}

.btn-luxury:hover::before {
    left: 0;
}

.btn-luxury:hover {
    color: #000;
    box-shadow: 0 0 20px rgba(212, 175, 55, 0.4);
}

/* INFO CARD - OFFSET DESIGN */
.info-card-wrapper {
    background: var(--card-bg);
    padding: 3rem;
    position: relative;
    border-left: 5px solid var(--primary-gold);
    box-shadow: 0 10px 50px rgba(0, 0, 0, 0.5);
    /* Membuat card sedikit naik ke atas menimpa elemen lain */
    margin-top: -50px;
    z-index: 10;
}

.info-item {
    margin-bottom: 2rem;
    padding-left: 1rem;
    border-left: 1px solid rgba(255, 255, 255, 0.1);
    transition: 0.3s;
}

.info-item:hover {
    border-left: 1px solid var(--primary-gold);
    padding-left: 1.5rem;
}

/* MAP STYLING */
.map-container-stylish {
    position: relative;
    height: 100%;
    min-height: 500px;
    filter: grayscale(100%) contrast(1.2);
    transition: 0.5s;
}

.map-container-stylish:hover {
    filter: grayscale(0%);
}

/* DECORATION */
.big-watermark {
    position: absolute;
    font-size: 10rem;
    font-weight: 900;
    color: rgba(255, 255, 255, 0.03);
    z-index: 0;
    top: -50px;
    right: 0;
    line-height: 0.8;
    pointer-events: none;
    overflow: hidden;
}
</style>
@endpush

{{-- HERO SECTION --}}
<div class="container-fluid px-0 position-relative"
    style="background: #0a0a0a; padding-top: 100px; padding-bottom: 100px;">
    <div class="container position-relative">
        <div class="big-watermark font-heading">CONTACT</div>

        <div class="row">
            <div class="col-lg-7" data-aos="fade-up">
                <h5 class="text-gold font-heading mb-3">Get In Touch</h5>
                <h1 class="display-3 fw-bold font-serif mb-4">
                    {{ $config->page_title ?? 'Ready for a New Look?' }}
                </h1>
                <p class="text-white-50 fs-5 mb-5" style="max-width: 500px;">
                    {{ $config->page_subtitle ?? 'Jangan ragu untuk berkonsultasi atau memesan jadwal potong rambut Anda hari ini.' }}
                </p>

                @if(session('success'))
                <div class="alert alert-success bg-dark border-success text-success mb-5 rounded-0">
                    <i class="bi bi-check-lg me-2"></i> {{ session('success') }}
                </div>
                @endif

                {{-- FORMULIR MINIMALIS --}}
                <form action="{{ route('contact.store') }}" method="POST" class="pe-lg-5">
                    @csrf

                    <div class="floating-group">
                        <input type="text" name="name" class="modern-input" required autocomplete="off">
                        <label class="floating-label">FULL NAME</label>
                    </div>

                    <div class="floating-group">
                        <input type="email" name="email" class="modern-input" required autocomplete="off">
                        <label class="floating-label">EMAIL ADDRESS</label>
                    </div>

                    <div class="floating-group">
                        <textarea name="message" class="modern-input" rows="1" required
                            style="resize: none; height: auto;"
                            oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                        <label class="floating-label">YOUR MESSAGE</label>
                    </div>

                    <button type="submit" class="btn btn-luxury mt-3">
                        SEND MESSAGE <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </form>
            </div>

            {{-- BAGIAN KANAN (MAP SEBAGAI BACKGROUND/SIDE) --}}
            <div class="col-lg-5 d-none d-lg-block position-relative">
                <div
                    style="position: absolute; right: 0; top: 0; bottom: 0; width: 1px; background: linear-gradient(to bottom, transparent, var(--primary-gold), transparent);">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SECTION MAP & INFO YANG UNIK --}}
<div class="container-fluid px-0">
    <div class="row g-0">
        {{-- KOLOM MAP (FULL HEIGHT) --}}
        <div class="col-lg-7 order-2 order-lg-1">
            <div class="map-container-stylish">
                <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                    src="{{ $config->maps_link ?? 'https://maps.google.com' }}" style="border:0; min-height: 600px;">
                </iframe>
            </div>
        </div>

        {{-- KOLOM INFO (OVERLAP) --}}
        <div class="col-lg-5 order-1 order-lg-2 position-relative bg-dark d-flex align-items-center">
            <div class="info-card-wrapper w-100 mx-lg-0 mx-auto" style="max-width: 500px; margin-left: -50px;">

                <h3 class="font-serif text-white mb-5">Visit Our Studio</h3>

                {{-- Address --}}
                <div class="info-item">
                    <h6 class="text-gold font-heading mb-1">LOCATION</h6>
                    <p class="text-white-50 mb-0">
                        {!! nl2br(e($config->address ?? 'Lokasi belum diatur.')) !!}
                    </p>
                </div>

                {{-- WhatsApp --}}
                <div class="info-item">
                    <h6 class="text-gold font-heading mb-1">CONTACT</h6>
                    <p class="text-white mb-0 fs-5 font-serif">{{ $config->whatsapp ?? '-' }}</p>
                    <p class="text-white-50 small">{{ $config->email ?? '-' }}</p>
                </div>

                {{-- Hours --}}
                <div class="info-item border-0">
                    <h6 class="text-gold font-heading mb-3">OPENING HOURS</h6>

                    <div
                        class="d-flex justify-content-between mb-2 pb-2 border-bottom border-secondary border-opacity-25">
                        <span class="text-white">Weekdays</span>
                        <span class="text-white fw-bold">{{ $config->hours_mon_fri ?? 'Closed' }}</span>
                    </div>
                    <div
                        class="d-flex justify-content-between mb-2 pb-2 border-bottom border-secondary border-opacity-25">
                        <span class="text-white">Weekend</span>
                        <span class="text-white fw-bold">{{ $config->hours_sat_sun ?? 'Closed' }}</span>
                    </div>

                    <div class="mt-3 p-3"
                        style="background: rgba(212, 175, 55, 0.1); border-left: 3px solid var(--primary-gold);">
                        <small class="text-gold d-block fw-bold mb-1">SESI MALAM (NIGHT OWL)</small>
                        <span class="text-white">{{ $config->hours_night ?? '19.30 - 22.00' }}</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection