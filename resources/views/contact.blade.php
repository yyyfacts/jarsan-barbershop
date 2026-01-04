@extends('layouts.app')

@section('title', 'Contact Studio')

@section('content')
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Italiana&family=Manrope:wght@200;400;700&display=swap"
    rel="stylesheet">
<style>
:root {
    --gold: #D4AF37;
    --gold-dim: #8a701e;
    --black: #050505;
    --glass: rgba(20, 20, 20, 0.7);
}

body {
    background-color: var(--black);
    color: #fff;
    font-family: 'Manrope', sans-serif;
    overflow-x: hidden;
}

/* --- 1. BACKGROUND NOISE --- */
.noise-bg {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('https://grainy-gradients.vercel.app/noise.svg');
    opacity: 0.05;
    z-index: -1;
    pointer-events: none;
}

/* --- 2. MARQUEE (TEKS BERGERAK) - ABU-ABU --- */
.marquee-container {
    overflow: hidden;
    white-space: nowrap;
    position: absolute;
    top: 5%;
    left: 0;
    width: 100%;
    color: rgba(255, 255, 255, 0.1);
    font-size: 12rem;
    font-family: 'Italiana', serif;
    line-height: 1;
    z-index: -1;
    pointer-events: none;
    user-select: none;
}

.marquee-content {
    display: inline-block;
    animation: marquee 40s linear infinite;
}

@keyframes marquee {
    0% {
        transform: translateX(0);
    }

    100% {
        transform: translateX(-50%);
    }
}

/* --- 3. CUSTOM FORM INPUT --- */
.input-group-luxury {
    position: relative;
    margin-bottom: 3rem;
}

.input-luxury {
    width: 100%;
    background: transparent;
    border: none;
    border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    padding: 15px 0;
    color: #fff;
    font-size: 1.2rem;
    font-family: 'Italiana', serif;
    transition: 0.4s ease;
}

.input-luxury:focus {
    outline: none;
    border-bottom-color: var(--gold);
    background: linear-gradient(to bottom, transparent 95%, rgba(212, 175, 55, 0.1) 100%);
}

.label-luxury {
    position: absolute;
    top: 15px;
    left: 0;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 2px;
    color: rgba(255, 255, 255, 0.4);
    pointer-events: none;
    transition: 0.4s;
}

.input-luxury:focus~.label-luxury,
.input-luxury:valid~.label-luxury {
    top: -20px;
    color: var(--gold);
    font-size: 0.7rem;
}

/* BUTTON */
.btn-gold-outline {
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: var(--gold);
    background: transparent;
    padding: 20px 50px;
    font-family: 'Manrope', sans-serif;
    text-transform: uppercase;
    letter-spacing: 3px;
    font-size: 0.8rem;
    transition: 0.4s;
    cursor: pointer;
}

.btn-gold-outline:hover {
    border-color: var(--gold);
    background: var(--gold);
    color: var(--black);
    box-shadow: 0 0 30px rgba(212, 175, 55, 0.3);
}

/* --- 4. VISUAL KANAN --- */
.visual-wrapper {
    position: relative;
    height: 100%;
    min-height: 500px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.hero-frame {
    width: 80%;
    height: 500px;
    position: relative;
    overflow: hidden;
    border-radius: 200px 200px 0 0;
    border: 1px solid rgba(212, 175, 55, 0.3);
    animation: floatImage 6s ease-in-out infinite;
}

.hero-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: grayscale(100%);
    transition: 0.5s;
}

.hero-frame:hover .hero-img {
    filter: grayscale(0%);
    transform: scale(1.1);
}

.rotating-badge {
    position: absolute;
    bottom: 50px;
    right: -20px;
    width: 150px;
    height: 150px;
    background: rgba(212, 175, 55, 0.05);
    border-radius: 50%;
    animation: rotateBadge 10s linear infinite;
    border: 1px dashed var(--gold);
    display: flex;
    align-items: center;
    justify-content: center;
}

.rotating-badge::after {
    content: 'EST 2024';
    color: var(--gold);
    font-size: 0.7rem;
    letter-spacing: 2px;
    font-weight: bold;
}

@keyframes floatImage {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-20px);
    }
}

@keyframes rotateBadge {
    from {
        transform: rotate(0deg);
    }

    to {
        transform: rotate(360deg);
    }
}

/* --- 5. MAP & OVERLAP --- */
.overlap-section {
    position: relative;
    margin-top: 50px;
}

.map-frame {
    width: 100%;
    height: 70vh;
    filter: grayscale(100%) invert(90%) contrast(120%);
    transition: 1s;
    overflow: hidden;
    background: #1a1a1a;
}

.map-frame:hover {
    filter: grayscale(0%) invert(0%);
}

.map-frame iframe {
    width: 100% !important;
    height: 100% !important;
    border: none !important;
}

.floating-card {
    background: rgba(18, 18, 18, 0.9);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    padding: 3rem;
    position: absolute;
    right: 10%;
    bottom: -50px;
    width: 450px;
    box-shadow: 0 20px 80px rgba(0, 0, 0, 0.8);
    border-top: 3px solid var(--gold);
    z-index: 10;
}

@media (max-width: 991px) {
    .marquee-container {
        font-size: 6rem;
        top: 10%;
    }

    .visual-wrapper {
        display: none;
    }

    .floating-card {
        position: relative;
        right: 0;
        bottom: 0;
        width: 100%;
        margin-top: -50px;
    }
}
</style>
@endpush

<div class="noise-bg"></div>

<div class="marquee-container">
    <div class="marquee-content">
        RESERVATION &nbsp; • &nbsp; CONTACT &nbsp; • &nbsp; MOOD CUT &nbsp; • &nbsp; STYLE &nbsp; • &nbsp;
        RESERVATION &nbsp; • &nbsp; CONTACT &nbsp; • &nbsp; MOOD CUT &nbsp; • &nbsp; STYLE &nbsp; • &nbsp;
    </div>
</div>

<div class="container" style="padding-top: 150px; padding-bottom: 80px;">
    <div class="row align-items-center">

        {{-- KOLOM KIRI: FORMULIR --}}
        <div class="col-lg-6 mb-5" data-aos="fade-right">
            <span class="text-gold small letter-spacing-3 text-uppercase d-block mb-3">Est. 2024 • Kroya</span>

            {{-- JUDUL DINAMIS: DIISI OLEH ADMIN --}}
            <h1 class="display-2 font-luxury text-white mb-4" style="line-height: 1.1;">
                {!! nl2br(e($config->page_title ?? "Let's Craft Your Style")) !!}
            </h1>

            {{-- SUBTITLE DINAMIS: DIISI OLEH ADMIN --}}
            <p class="text-white-50 mb-5 fs-5 fw-light" style="max-width: 450px;">
                {{ $config->page_subtitle ?? 'Kami siap mendengarkan preferensi gaya Anda.' }}
            </p>

            @if(session('success'))
            <div class="p-3 mb-5 border border-success text-success bg-transparent d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="mt-4 pe-lg-5">
                @csrf
                <div class="input-group-luxury">
                    <input type="text" name="name" class="input-luxury" required autocomplete="off">
                    <label class="label-luxury">Your Name</label>
                </div>

                <div class="input-group-luxury">
                    <input type="email" name="email" class="input-luxury" required autocomplete="off">
                    <label class="label-luxury">Email Address</label>
                </div>

                <div class="input-group-luxury">
                    <textarea name="message" class="input-luxury" rows="1" required style="resize: none; height: auto;"
                        oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                    <label class="label-luxury">Your Message</label>
                </div>

                <button type="submit" class="btn-gold-outline mt-3">
                    Send Message
                </button>
            </form>
        </div>

        {{-- KOLOM KANAN: VISUAL ANIMATION --}}
        <div class="col-lg-6 d-none d-lg-block" data-aos="fade-left">
            <div class="visual-wrapper">
                <div class="hero-frame">
                    <img src="https://images.unsplash.com/photo-1503951914205-22f2ca1c6c08?q=80&w=2070&auto=format&fit=crop"
                        alt="Barber Art" class="hero-img">
                </div>
                <div class="rotating-badge"></div>
            </div>
        </div>

    </div>
</div>

{{-- SECTION MAP & INFO --}}
<div class="container-fluid px-0 overlap-section position-relative">
    <div class="map-frame">
        @if(!empty($config->maps_link))
        {!! $config->maps_link !!}
        @else
        <div class="d-flex align-items-center justify-content-center h-100 text-white-50">
            <small>MAPS LOCATION NOT SET</small>
        </div>
        @endif
    </div>

    <div class="floating-card" data-aos="fade-up" data-aos-delay="200">
        <h3 class="font-luxury text-white mb-5">Studio Info</h3>
        <div class="row g-4">
            <div class="col-12">
                <small class="text-white-50 text-uppercase letter-spacing-2">Address</small>
                <p class="text-white fs-5 mt-1 font-luxury lh-sm">
                    {!! nl2br(e($config->address ?? 'Alamat belum diisi.')) !!}
                </p>
            </div>
            <div class="col-6">
                <small class="text-white-50 text-uppercase letter-spacing-2">Whatsapp</small>
                <p class="text-white mt-1">{{ $config->whatsapp ?? '-' }}</p>
            </div>
            <div class="col-6">
                <small class="text-white-50 text-uppercase letter-spacing-2">Email</small>
                <p class="text-white mt-1">{{ $config->email ?? '-' }}</p>
            </div>
            <div class="col-12 border-top border-secondary pt-4 mt-4 border-opacity-25">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-gold text-uppercase letter-spacing-2">Open Today</small>
                    <span class="text-white font-luxury fs-5">
                        {{ \Carbon\Carbon::now()->isWeekend() ? ($config->hours_sat_sun ?? '-') : ($config->hours_mon_fri ?? '-') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="height: 100px; background: var(--black);"></div>

@endsection