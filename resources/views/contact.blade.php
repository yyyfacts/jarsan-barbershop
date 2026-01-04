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

/* --- 2. MARQUEE (DIPERBAIKI: UKURAN LEBIH KECIL & POSISI PAS) --- */
.marquee-container {
    overflow: hidden;
    white-space: nowrap;
    position: absolute;
    top: 80px;
    /* Menyesuaikan di bawah navbar */
    left: 0;
    width: 100%;
    color: rgba(255, 255, 255, 0.03);
    /* Sangat samar */
    font-size: 6rem;
    /* Ukuran diperkecil agar tidak menutupi judul */
    font-family: 'Italiana', serif;
    z-index: 0;
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

/* --- 3. KONTEN UTAMA (DIPERBAIKI: JARAK ATAS DITAMBAH) --- */
.main-contact-section {
    padding-top: 250px;
    /* Memberi ruang agar judul berada di bawah marquee */
    padding-bottom: 80px;
    position: relative;
    z-index: 10;
}

/* --- 4. FORM STYLE --- */
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

/* --- 5. ANIMASI KANAN --- */
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
    opacity: 0.15;
    animation: rotateGeo 20s linear infinite;
}

.line-1 {
    width: 320px;
    height: 320px;
    border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
}

.line-2 {
    width: 280px;
    height: 280px;
    border-radius: 50%;
    border-style: dashed;
}

@keyframes rotateGeo {
    from {
        transform: rotate(0deg);
    }

    to {
        transform: rotate(360deg);
    }
}

.btn-luxury {
    background: var(--gold);
    color: #000;
    border: none;
    padding: 15px 45px;
    font-weight: bold;
    letter-spacing: 2px;
    text-transform: uppercase;
    font-size: 0.85rem;
    transition: 0.3s;
}

.btn-luxury:hover {
    background: #fff;
    transform: translateY(-3px);
}

/* --- 6. INFO BOX & MAPS --- */
.info-box {
    background: var(--card-bg);
    border: 1px solid rgba(255, 255, 255, 0.05);
    padding: 2.5rem;
    height: 100%;
}

.map-wrapper {
    width: 100%;
    height: 450px;
    filter: grayscale(1) contrast(1.1) brightness(0.7);
    border: 1px solid rgba(212, 175, 55, 0.1);
    transition: 0.5s;
}

.map-wrapper:hover {
    filter: grayscale(0) brightness(1);
}

.map-wrapper iframe {
    width: 100% !important;
    height: 100% !important;
    border: none;
}
</style>
@endpush

<div class="noise-bg"></div>

{{-- MARQUEE --}}
<div class="marquee-container">
    <div class="marquee-content">
        RESERVATION &nbsp; • &nbsp; CONTACT &nbsp; • &nbsp; MOOD CUT &nbsp; • &nbsp; STYLE &nbsp; • &nbsp;
        RESERVATION &nbsp; • &nbsp; CONTACT &nbsp; • &nbsp; MOOD CUT &nbsp; • &nbsp; STYLE &nbsp; • &nbsp;
    </div>
</div>

<div class="container main-contact-section">
    <div class="row align-items-center">
        {{-- KOLOM KIRI --}}
        <div class="col-lg-6 mb-5" data-aos="fade-right">
            <span class="text-gold small letter-spacing-5 text-uppercase d-block mb-3" style="opacity: 0.8;">Studio •
                Kroya</span>

            <h1 class="display-3 font-luxury text-white mb-4" style="line-height: 1.2;">
                {!! nl2br(e($config->page_title ?? "Hubungi Kami")) !!}
            </h1>
            <p class="text-white-50 mb-5 fw-light" style="max-width: 500px; letter-spacing: 0.5px;">
                {{ $config->page_subtitle ?? 'Silakan hubungi kami untuk reservasi atau datang langsung ke lokasi.' }}
            </p>

            @if(session('success'))
            <div class="alert alert-success bg-transparent border-success text-success mb-4 rounded-0">
                <i class="bi bi-check2-circle me-2"></i> {{ session('success') }}
            </div>
            @endif

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
                <button type="submit" class="btn-luxury mt-3">Send Message</button>
            </form>
        </div>

        {{-- KOLOM KANAN --}}
        <div class="col-lg-6 d-none d-lg-block">
            <div class="visual-container">
                <div class="geo-line line-1"></div>
                <div class="geo-line line-2"></div>
                <div class="text-center">
                    <h2 class="font-luxury text-gold mb-0" style="letter-spacing: 15px; margin-left: 15px;">MOOD</h2>
                    <p class="small text-white-50 letter-spacing-10" style="margin-left: 10px;">CUT</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- INFO & MAPS --}}
<div class="container mb-5">
    <div class="row g-4">
        <div class="col-lg-4" data-aos="fade-up">
            <div class="info-box shadow-lg">
                <h4 class="font-luxury text-gold mb-5 border-bottom border-secondary border-opacity-25 pb-3">Information
                </h4>

                <div class="mb-4">
                    <small class="text-white-50 text-uppercase d-block mb-2" style="letter-spacing: 2px;">Lokasi
                        Studio</small>
                    <p class="fw-light mb-0" style="color: #eee;">{!! nl2br(e($config->address ?? 'Alamat belum
                        diatur.')) !!}</p>
                </div>

                <div class="mb-4">
                    <small class="text-white-50 text-uppercase d-block mb-2" style="letter-spacing: 2px;">WhatsApp
                        Official</small>
                    <p class="fw-light text-gold mb-0 fs-5">{{ $config->whatsapp ?? '-' }}</p>
                </div>

                <div class="mb-0">
                    <small class="text-white-50 text-uppercase d-block mb-2" style="letter-spacing: 2px;">Jam
                        Operasional</small>
                    <p class="fw-light mb-0" style="color: #eee;">
                        {{ \Carbon\Carbon::now()->isWeekend() ? ($config->hours_sat_sun ?? '-') : ($config->hours_mon_fri ?? '-') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
            <div class="map-wrapper shadow-lg">
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

<div style="height: 80px;"></div>
@endsection