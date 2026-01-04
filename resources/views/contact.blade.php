@extends('layouts.app')

@section('title', 'Contact Studio')

@section('content')
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Italiana&family=Manrope:wght@200;400;700&display=swap"
    rel="stylesheet">
<style>
:root {
    --gold: #D4AF37;
    --black: #050505;
    --card-bg: #0f0f0f;
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

/* --- 2. MARQUEE (SANGAT GELAP/SAMAR) --- */
.marquee-container {
    overflow: hidden;
    white-space: nowrap;
    position: absolute;
    top: 10%;
    left: 0;
    width: 100%;
    /* Diubah menjadi 0.04 agar lebih gelap/samar */
    color: rgba(255, 255, 255, 0.04);
    font-size: 10rem;
    font-family: 'Italiana', serif;
    z-index: -1;
    pointer-events: none;
}

.marquee-content {
    display: inline-block;
    animation: marquee 50s linear infinite;
}

@keyframes marquee {
    0% {
        transform: translateX(0);
    }

    100% {
        transform: translateX(-50%);
    }
}

/* --- 3. FORM STYLE --- */
.input-group-luxury {
    position: relative;
    margin-bottom: 2.5rem;
}

.input-luxury {
    width: 100%;
    background: transparent;
    border: none;
    border-bottom: 1px solid rgba(212, 175, 55, 0.2);
    padding: 12px 0;
    color: #fff;
    font-size: 1.1rem;
    transition: 0.4s;
}

.input-luxury:focus {
    outline: none;
    border-bottom-color: var(--gold);
}

.label-luxury {
    position: absolute;
    top: 12px;
    left: 0;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 2px;
    color: rgba(255, 255, 255, 0.4);
    transition: 0.4s;
}

.input-luxury:focus~.label-luxury,
.input-luxury:valid~.label-luxury {
    top: -20px;
    color: var(--gold);
    font-size: 0.65rem;
}

/* --- 4. ANIMASI KANAN BARU (GEOMETRIC LINES) --- */
.visual-container {
    position: relative;
    height: 400px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.geo-line {
    position: absolute;
    border: 1px solid var(--gold);
    opacity: 0.2;
    animation: rotateGeo 15s linear infinite;
}

.line-1 {
    width: 300px;
    height: 300px;
    border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
}

.line-2 {
    width: 250px;
    height: 250px;
    border-radius: 50%;
    border-style: dashed;
    animation-duration: 20s;
}

@keyframes rotateGeo {
    from {
        transform: rotate(0deg);
    }

    to {
        transform: rotate(360deg);
    }
}

/* --- 5. INFO BOX & MAPS (DIPISAH) --- */
.info-box {
    background: var(--card-bg);
    border: 1px solid rgba(255, 255, 255, 0.05);
    padding: 2.5rem;
    height: 100%;
}

.map-wrapper {
    width: 100%;
    height: 450px;
    filter: grayscale(1) contrast(1.2) brightness(0.8);
    border: 1px solid rgba(212, 175, 55, 0.1);
    transition: 0.5s;
}

.map-wrapper:hover {
    filter: grayscale(0) brightness(1);
}

.map-wrapper iframe {
    width: 100%;
    height: 100%;
    border: none;
}

.btn-luxury {
    background: var(--gold);
    color: #000;
    border: none;
    padding: 15px 40px;
    font-weight: bold;
    letter-spacing: 2px;
    text-transform: uppercase;
    font-size: 0.8rem;
    transition: 0.3s;
}

.btn-luxury:hover {
    background: #fff;
    transform: translateY(-3px);
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

<div class="container" style="padding-top: 120px; padding-bottom: 60px;">
    <div class="row align-items-center">
        {{-- KOLOM KIRI: FORMULIR --}}
        <div class="col-lg-6 mb-5" data-aos="fade-right">
            <h1 class="display-3 font-luxury text-white mb-4">
                {!! nl2br(e($config->page_title ?? "Contact Us")) !!}
            </h1>
            <p class="text-white-50 mb-5 fw-light">
                {{ $config->page_subtitle ?? 'Get in touch for appointments or inquiries.' }}
            </p>

            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="input-group-luxury">
                    <input type="text" name="name" class="input-luxury" required autocomplete="off">
                    <label class="label-luxury">Full Name</label>
                </div>
                <div class="input-group-luxury">
                    <input type="email" name="email" class="input-luxury" required autocomplete="off">
                    <label class="label-luxury">Email Address</label>
                </div>
                <div class="input-group-luxury">
                    <textarea name="message" class="input-luxury" rows="1" required style="resize: none;"
                        oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                    <label class="label-luxury">Message</label>
                </div>
                <button type="submit" class="btn-luxury">Send Message</button>
            </form>
        </div>

        {{-- KOLOM KANAN: ANIMASI GEOMETRIS --}}
        <div class="col-lg-6 d-none d-lg-block">
            <div class="visual-container">
                <div class="geo-line line-1"></div>
                <div class="geo-line line-2"></div>
                <div class="text-center">
                    <h2 class="font-luxury text-gold" style="letter-spacing: 10px;">MOOD</h2>
                    <p class="small text-white-50 letter-spacing-5">CUT</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SECTION BARU: INFO & MAPS (RAPI & TERPISAH) --}}
<div class="container mb-5">
    <div class="row g-4">
        {{-- INFO BOX --}}
        <div class="col-lg-4" data-aos="fade-up">
            <div class="info-box">
                <h4 class="font-luxury text-gold mb-4">Information</h4>

                <div class="mb-4">
                    <small class="text-white-50 text-uppercase d-block mb-1" style="letter-spacing: 2px;">Studio
                        Location</small>
                    <p class="fw-light">{!! nl2br(e($config->address ?? 'Address not set.')) !!}</p>
                </div>

                <div class="mb-4">
                    <small class="text-white-50 text-uppercase d-block mb-1"
                        style="letter-spacing: 2px;">WhatsApp</small>
                    <p class="fw-light text-gold">{{ $config->whatsapp ?? '-' }}</p>
                </div>

                <div class="mb-0">
                    <small class="text-white-50 text-uppercase d-block mb-1" style="letter-spacing: 2px;">Today's
                        Schedule</small>
                    <p class="fw-light">
                        {{ \Carbon\Carbon::now()->isWeekend() ? ($config->hours_sat_sun ?? '-') : ($config->hours_mon_fri ?? '-') }}
                    </p>
                </div>
            </div>
        </div>

        {{-- MAP BOX --}}
        <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
            <div class="map-wrapper">
                @if(!empty($config->maps_link))
                {!! $config->maps_link !!}
                @else
                <div class="d-flex align-items-center justify-content-center h-100 bg-dark">
                    <small class="text-white-50">LOCATION MAP NOT AVAILABLE</small>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div style="height: 60px;"></div>
@endsection