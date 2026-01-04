@extends('layouts.app')

@section('title', 'The Booking Ritual')

@push('styles')
{{-- 1. LIBRARY TAMBAHAN (Flatpickr untuk Kalender Mewah & Animate.css) --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<style>
/* =========================================
       1. CORE LUXURY VARIABLES
       ========================================= */
:root {
    --bg-deep: #050505;
    --bg-glass: rgba(20, 20, 20, 0.6);
    --gold-primary: #D4AF37;
    --gold-light: #F2D06B;
    --gold-glow: rgba(212, 175, 55, 0.25);
    --text-main: #ffffff;
    --text-muted: #888888;
    --border-subtle: rgba(255, 255, 255, 0.1);
    --danger-red: #ff3b3b;
}

/* BACKGROUND & TYPOGRAPHY */
body {
    background-color: var(--bg-deep) !important;
    background-image:
        radial-gradient(circle at 15% 50%, rgba(212, 175, 55, 0.08), transparent 25%),
        radial-gradient(circle at 85% 30%, rgba(212, 175, 55, 0.05), transparent 25%);
    color: var(--text-main);
    font-family: 'Plus Jakarta Sans', sans-serif;
    overflow-x: hidden;
}

h1,
h2,
h3,
h4,
h5 {
    font-family: 'Playfair Display', serif;
}

/* =========================================
       2. FLATPICKR CUSTOMIZATION (KALENDER)
       ========================================= */
.flatpickr-calendar {
    background: #111 !important;
    border: 1px solid var(--gold-primary) !important;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.8) !important;
}

.flatpickr-day.selected,
.flatpickr-day.startRange,
.flatpickr-day.endRange,
.flatpickr-day.selected.inRange,
.flatpickr-day.startRange.inRange,
.flatpickr-day.endRange.inRange,
.flatpickr-day:hover,
.flatpickr-day:focus {
    background: var(--gold-primary) !important;
    border-color: var(--gold-primary) !important;
    color: #000 !important;
    font-weight: bold;
}

.flatpickr-months .flatpickr-month {
    background: var(--gold-primary) !important;
    color: #000 !important;
    fill: #000 !important;
}

.flatpickr-current-month .flatpickr-monthDropdown-months .flatpickr-monthDropdown-month {
    background-color: #000 !important;
}

.flatpickr-weekday {
    color: var(--gold-primary) !important;
}

/* INPUT STYLE */
.input-luxury {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid var(--border-subtle);
    color: var(--gold-primary);
    padding: 15px;
    text-align: center;
    font-size: 1.2rem;
    letter-spacing: 1px;
    width: 100%;
    transition: 0.3s;
    border-radius: 8px;
}

.input-luxury:focus {
    outline: none;
    border-color: var(--gold-primary);
    box-shadow: 0 0 20px var(--gold-glow);
    background: rgba(0, 0, 0, 0.5);
}

/* =========================================
       3. GLASSMORPHISM CARDS (BARBER & SERVICE)
       ========================================= */
.selection-input {
    display: none;
}

.glass-card {
    background: var(--bg-glass);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid var(--border-subtle);
    border-radius: 12px;
    padding: 20px;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

/* Hover Effect */
.glass-card:hover {
    transform: translateY(-8px);
    border-color: var(--gold-primary);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
}

.glass-card:hover .barber-img {
    filter: grayscale(0%);
    transform: scale(1.1);
    border-color: var(--gold-primary);
}

/* Selected State */
.selection-input:checked+.glass-card {
    border: 1px solid var(--gold-primary);
    background: linear-gradient(160deg, rgba(212, 175, 55, 0.1), rgba(0, 0, 0, 0.8));
    box-shadow: 0 0 25px var(--gold-glow);
}

.selection-input:checked+.glass-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--gold-primary), transparent);
}

/* Centang Emas */
.selection-input:checked+.glass-card::after {
    content: '\F26E';
    /* Bootstrap Icon Check */
    font-family: 'bootstrap-icons';
    position: absolute;
    top: 10px;
    right: 10px;
    color: var(--gold-primary);
    font-size: 1.2rem;
    filter: drop-shadow(0 0 5px var(--gold-primary));
    animation: rubberBand 0.8s;
}

/* BARBER IMAGE */
.barber-avatar-container {
    position: relative;
    margin-bottom: 15px;
}

.barber-img {
    width: 85px;
    height: 85px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #444;
    filter: grayscale(100%);
    transition: 0.4s ease;
}

.selection-input:checked+.glass-card .barber-img {
    filter: grayscale(0%);
    border-color: var(--gold-primary);
    box-shadow: 0 0 15px var(--gold-primary);
}

/* SERVICE IMAGE */
.service-img-wrapper {
    width: 100%;
    height: 140px;
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 15px;
    position: relative;
}

.service-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: 0.5s;
    filter: sepia(50%) brightness(0.7);
}

.selection-input:checked+.glass-card .service-img {
    filter: sepia(0%) brightness(1);
    transform: scale(1.05);
}

/* =========================================
       4. TIME SLOTS (ANIMATED & STATUS)
       ========================================= */
.time-slot {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid var(--border-subtle);
    color: white;
    padding: 12px 0;
    text-align: center;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
    font-weight: 600;
    letter-spacing: 1px;
}

.time-slot:hover {
    border-color: var(--gold-primary);
    color: var(--gold-primary);
    background: rgba(212, 175, 55, 0.05);
}

.selection-input:checked+.time-slot {
    background: linear-gradient(45deg, var(--gold-primary), var(--gold-light));
    color: #000;
    border-color: transparent;
    font-weight: 800;
    transform: scale(1.05);
    box-shadow: 0 0 20px var(--gold-glow);
}

/* SLOT PENUH (MERAH) */
.time-slot.booked {
    background: rgba(50, 0, 0, 0.6) !important;
    border-color: rgba(255, 0, 0, 0.3) !important;
    color: #666 !important;
    cursor: not-allowed;
    text-decoration: line-through;
    opacity: 0.6;
}

/* =========================================
       5. MODAL DETAIL BARBER (HERO STYLE)
       ========================================= */
.modal-content-luxury {
    background: #0f0f0f;
    border: 1px solid var(--gold-primary);
    box-shadow: 0 0 50px rgba(0, 0, 0, 0.9);
}

.modal-hero {
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), #0f0f0f), url('https://source.unsplash.com/random/800x400/?barbershop,texture');
    background-size: cover;
    padding: 40px 20px 20px;
    text-align: center;
    border-bottom: 1px solid var(--border-subtle);
}

.modal-avatar {
    width: 130px;
    height: 130px;
    border-radius: 50%;
    border: 3px solid var(--gold-primary);
    box-shadow: 0 0 20px var(--gold-glow);
    object-fit: cover;
    margin-top: -20px;
    background: #000;
}

.modal-body-custom {
    padding: 30px;
}

.schedule-badge {
    background: rgba(255, 255, 255, 0.05);
    padding: 8px 12px;
    border-radius: 6px;
    margin-bottom: 5px;
    display: flex;
    justify-content: space-between;
    font-size: 0.85rem;
}

/* =========================================
       6. ALERT & BUTTONS
       ========================================= */
.alert-gold {
    background: rgba(212, 175, 55, 0.1);
    border: 1px solid var(--gold-primary);
    color: var(--text-main);
    position: relative;
    overflow: hidden;
}

.alert-gold::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--gold-primary);
}

.btn-status-luxury {
    display: inline-block;
    margin-top: 15px;
    padding: 10px 25px;
    background: transparent;
    border: 1px solid var(--gold-primary);
    color: var(--gold-primary);
    text-decoration: none;
    font-weight: bold;
    letter-spacing: 1px;
    transition: 0.3s;
}

.btn-status-luxury:hover {
    background: var(--gold-primary);
    color: #000;
    box-shadow: 0 0 20px var(--gold-glow);
}

/* =========================================
       7. STICKY FOOTER
       ========================================= */
.sticky-bar {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background: rgba(10, 10, 10, 0.9);
    backdrop-filter: blur(15px);
    border-top: 1px solid var(--gold-primary);
    padding: 20px 0;
    z-index: 9999;
    display: none;
    animation: fadeInUp 0.5s;
}

.btn-confirm {
    background: linear-gradient(135deg, #D4AF37, #F2D06B);
    border: none;
    color: #000;
    font-weight: 900;
    padding: 12px 35px;
    letter-spacing: 2px;
    transition: 0.3s;
    box-shadow: 0 0 15px var(--gold-glow);
}

.btn-confirm:hover {
    transform: scale(1.05);
    box-shadow: 0 0 30px var(--gold-glow);
}
</style>
@endpush

@section('content')
<div class="container" style="margin-top: 100px; margin-bottom: 180px;">

    {{-- HEADER --}}
    <div class="text-center mb-5 animate__animated animate__fadeInDown">
        <h5 class="text-white-50" style="letter-spacing: 3px;">THE RITUAL</h5>
        <h1 class="display-3 fw-bold" style="color: var(--gold-primary);">BOOK YOUR SLOT</h1>
        <div
            style="width: 80px; height: 2px; background: var(--gold-primary); margin: 20px auto; box-shadow: 0 0 10px var(--gold-primary);">
        </div>
    </div>

    {{-- ALERT SUKSES --}}
    @if(session('success'))
    <div class="alert-gold p-4 mb-5 text-center animate__animated animate__zoomIn">
        <i class="bi bi-check-circle-fill fs-1 text-success mb-3 d-block"></i>
        <h4 class="fw-bold text-uppercase">Reservasi Berhasil Dikirim!</h4>
        <p class="mb-0 text-white-50">{{ session('success') }}</p>

        <a href="{{ route('reservasi.history') }}" class="btn-status-luxury">
            <i class="bi bi-hourglass-split me-2"></i> CEK STATUS PESANAN
        </a>
    </div>
    @endif

    <form action="{{ route('reservasi.store') }}" method="POST" id="bookingForm">
        @csrf

        {{-- 1. PILIH TANGGAL (FLATPICKR) --}}
        <div class="mb-5 animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
            <h4 class="section-title text-center" style="color: var(--gold-primary); letter-spacing: 2px;">01. PILIH
                TANGGAL</h4>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="position-relative">
                        <i class="bi bi-calendar-event position-absolute"
                            style="top: 18px; left: 15px; color: var(--gold-primary); z-index: 2;"></i>
                        {{-- Input ini akan diubah oleh JS menjadi Flatpickr --}}
                        <input type="text" name="date" id="datePicker" class="input-luxury ps-5"
                            placeholder="Tap to Select Date" required>
                    </div>
                    <div class="text-center mt-2 text-white-50 small fst-italic">
                        * Slot waktu akan muncul setelah tanggal dipilih
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. PILIH BARBER (GLASS CARDS) --}}
        <div class="mb-5 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
            <h4 class="section-title text-center" style="color: var(--gold-primary); letter-spacing: 2px;">02. PILIH
                ARTIST</h4>
            <div class="row g-4 justify-content-center">

                {{-- Any Barber --}}
                <div class="col-6 col-md-3 col-lg-2">
                    <input type="radio" name="barber_id" id="b_null" value="" class="selection-input" checked
                        onchange="checkAvailableSlots()">
                    <label for="b_null" class="glass-card">
                        <div class="barber-avatar-container">
                            <div
                                class="barber-img d-flex align-items-center justify-content-center bg-dark text-white border-secondary">
                                <i class="bi bi-stars fs-2 text-warning"></i>
                            </div>
                        </div>
                        <h6 class="fw-bold text-white mb-1">ANY BARBER</h6>
                        <small class="text-muted" style="font-size: 0.75rem;">Kami pilihkan yang terbaik</small>
                    </label>
                </div>

                {{-- Loop Barber --}}
                @foreach($barbers as $barber)
                @php
                $img = $barber->photo_path ??
                'https://ui-avatars.com/api/?name='.$barber->name.'&background=D4AF37&color=000';
                $sched = json_encode($barber->schedule ?? []);
                $revs = json_encode($barber->reviews->take(5));
                $rating = number_format($barber->reviews->avg('rating') ?? 0, 1);
                $ratingCount = $barber->reviews->count();
                @endphp
                <div class="col-6 col-md-3 col-lg-2">
                    <input type="radio" name="barber_id" id="b_{{ $barber->id }}" value="{{ $barber->id }}"
                        class="selection-input" data-name="{{ $barber->name }}" onchange="checkAvailableSlots()">
                    <label for="b_{{ $barber->id }}" class="glass-card">
                        <div class="barber-avatar-container">
                            <img src="{{ $img }}" class="barber-img">
                        </div>
                        <h6 class="fw-bold text-white mb-1">{{ Str::limit($barber->name, 10) }}</h6>
                        <small class="text-warning mb-2">★ {{ $rating }}</small>

                        {{-- Tombol Detail yang lebih keren --}}
                        <button type="button" class="btn btn-sm text-white-50 p-0 text-decoration-underline mt-2"
                            onclick="event.stopPropagation(); showModal('{{ $barber->name }}', '{{ $img }}', '{{ $barber->bio }}', {{ $sched }}, {{ $revs }}, '{{ $rating }}', {{ $ratingCount }})">
                            Lihat Profil
                        </button>
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        {{-- 3. PILIH SERVICE (GLASS CARDS) --}}
        <div class="mb-5 animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
            <h4 class="section-title text-center" style="color: var(--gold-primary); letter-spacing: 2px;">03. PILIH
                LAYANAN</h4>
            <div class="row g-4">
                @foreach($services as $service)
                <div class="col-6 col-md-4 col-lg-3">
                    <input type="radio" name="service_id" id="s_{{ $service->id }}" value="{{ $service->id }}"
                        class="selection-input" data-name="{{ $service->name }}" data-price="{{ $service->price }}"
                        onchange="updateSummary()" required>
                    <label for="s_{{ $service->id }}" class="glass-card p-0">
                        <div class="service-img-wrapper">
                            <img src="{{ $service->image_path ?? asset('images/default-service.jpg') }}"
                                class="service-img"
                                onerror="this.src='https://via.placeholder.com/300x200/000/fff?text=SERVICE'">
                        </div>
                        <div class="p-3 w-100 text-center">
                            <h6 class="fw-bold text-white mb-2 text-uppercase">{{ $service->name }}</h6>
                            <div class="d-inline-block border border-warning px-3 py-1 rounded-pill">
                                <span class="text-warning fw-bold small">Rp
                                    {{ number_format($service->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        {{-- 4. PILIH WAKTU (AJAX) --}}
        <div class="mb-5 animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
            <h4 class="section-title text-center" style="color: var(--gold-primary); letter-spacing: 2px;">04. PILIH
                WAKTU</h4>
            <div class="row g-3 justify-content-center">
                @for ($t = strtotime('10:00'); $t <= strtotime('21:00'); $t +=1800) @php $val=date('H:i', $t);
                    $id=str_replace(':', '' , $val); @endphp <div class="col-4 col-md-2">
                    <input type="radio" name="time" id="t_{{ $id }}" value="{{ $val }}"
                        class="selection-input time-radio" onchange="updateSummary()" required>
                    <label for="t_{{ $id }}" class="time-slot" id="label_{{ $id }}">
                        {{ $val }}
                    </label>
            </div>
            @endfor
        </div>
</div>

{{-- 5. KONFIRMASI --}}
<div class="mb-5 animate__animated animate__fadeInUp" style="animation-delay: 0.5s;">
    <h4 class="section-title text-center" style="color: var(--gold-primary); letter-spacing: 2px;">05. DATA DIRI</h4>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <input type="hidden" name="name" value="{{ Auth::user()->name }}">
            <div class="mb-4">
                <label class="text-warning fw-bold mb-2 ps-2">NOMOR WHATSAPP</label>
                <input type="text" name="phone" class="input-luxury text-start ps-3" placeholder="Contoh: 0812345xxx"
                    required>
            </div>
            <div class="mb-3">
                <label class="text-warning fw-bold mb-2 ps-2">CATATAN TAMBAHAN</label>
                <textarea name="notes" class="input-luxury text-start ps-3" rows="2"
                    placeholder="Contoh: Model Undercut, jangan terlalu pendek..."></textarea>
            </div>
        </div>
    </div>
</div>

{{-- STICKY SUMMARY BAR --}}
<div class="sticky-bar" id="summaryBar">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <div class="me-4 border-end border-secondary pe-4 d-none d-md-block">
                <small class="text-muted d-block" style="font-size: 0.7rem;">TOTAL PEMBAYARAN</small>
                <h3 class="text-white fw-bold m-0" id="priceDisplay">Rp 0</h3>
            </div>
            <div>
                <small class="text-muted d-block" style="font-size: 0.7rem;">RINGKASAN PESANAN</small>
                <span class="text-warning" id="descDisplay">Menunggu pilihan...</span>
            </div>
        </div>
        <button type="submit" class="btn-confirm rounded-pill">
            KONFIRMASI <i class="bi bi-arrow-right ms-2"></i>
        </button>
    </div>
</div>

</form>

{{-- MODAL DETAIL BARBER (HERO STYLE) --}}
<div class="modal fade" id="barberModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-luxury">
            <div class="modal-body p-0">
                <div class="modal-hero">
                    <img src="" id="mImg" class="modal-avatar">
                </div>
                <div class="modal-body-custom text-center">
                    <h3 class="text-white fw-bold mb-1" id="mName">Barber Name</h3>
                    <p class="text-gold-light fst-italic mb-3" id="mBio">Professional Barber</p>
                    <div
                        class="d-flex justify-content-center align-items-center mb-4 text-warning bg-dark p-2 rounded-pill d-inline-flex border border-secondary">
                        <span id="mRatingStars"></span>
                        <span class="ms-2 text-white small" id="mRatingText"></span>
                    </div>

                    <div class="row text-start mt-4">
                        <div class="col-12 mb-3">
                            <h6 class="text-warning border-bottom border-secondary pb-2 mb-3">JADWAL KERJA</h6>
                            <div id="mSchedule"></div>
                        </div>
                        <div class="col-12">
                            <h6 class="text-warning border-bottom border-secondary pb-2 mb-3">ULASAN PELANGGAN</h6>
                            <div id="mReviews" style="max-height: 150px; overflow-y: auto; padding-right: 5px;"></div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-outline-light w-100 mt-4 rounded-pill"
                        data-bs-dismiss="modal">TUTUP PROFIL</button>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection

@push('scripts')
{{-- 1. SCRIPT LIBRARY FLATPICKR --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
// --- INIT FLATPICKR (KALENDER MEWAH) ---
document.addEventListener('DOMContentLoaded', function() {
    flatpickr("#datePicker", {
        minDate: "today",
        dateFormat: "Y-m-d",
        disableMobile: "true",
        theme: "dark", // Tema gelap bawaan
        onChange: function(selectedDates, dateStr, instance) {
            // Saat tanggal dipilih, panggil fungsi cek slot
            checkSlots(dateStr);
        }
    });
});

// --- 2. AJAX CEK JAM MERAH ---
function checkSlots(dateVal) {
    // Ambil tanggal dari parameter (jika dari flatpickr) atau input
    const date = dateVal || document.getElementById('datePicker').value;
    const barberEl = document.querySelector('input[name="barber_id"]:checked');
    const barberId = barberEl ? barberEl.value : '';

    updateSummary();

    if (!date) return;

    // Reset tampilan slot
    document.querySelectorAll('.time-radio').forEach(el => el.disabled = false);
    document.querySelectorAll('.time-slot').forEach(el => {
        el.classList.remove('booked');
        el.innerHTML = el.getAttribute('data-time'); // Reset teks
    });

    // Panggil Backend
    fetch(`/reservasi/check-slots?date=${date}&barber_id=${barberId}`)
        .then(res => res.json())
        .then(data => {
            data.forEach(time => {
                let id = time.substring(0, 5).replace(':', '');
                let input = document.getElementById('t_' + id);
                let label = document.getElementById('label_' + id);

                if (input && label) {
                    input.disabled = true;
                    label.classList.add('booked');
                    // Opsional: Uncheck jika user sedang memilih slot ini
                    if (input.checked) {
                        input.checked = false;
                        updateSummary();
                    }
                }
            });
        })
        .catch(err => console.error(err));
}

// --- 3. UPDATE SUMMARY ---
function updateSummary() {
    const svc = document.querySelector('input[name="service_id"]:checked');
    const bar = document.getElementById('summaryBar');

    if (svc) {
        bar.style.display = 'flex';
        const price = parseInt(svc.getAttribute('data-price'));
        document.getElementById('priceDisplay').innerText = 'Rp ' + price.toLocaleString('id-ID');

        let txt = svc.getAttribute('data-name');
        const bbr = document.querySelector('input[name="barber_id"]:checked');
        if (bbr && bbr.value) txt += ' + ' + bbr.getAttribute('data-name');

        const date = document.getElementById('datePicker').value;
        const time = document.querySelector('input[name="time"]:checked');
        if (date && time) txt += ' (' + date + ' @ ' + time.value + ')';

        document.getElementById('descDisplay').innerText = txt;
    }
}

// --- 4. MODAL DETAIL (KEREN) ---
function showModal(name, img, bio, schedule, reviews, rating, count) {
    document.getElementById('mName').innerText = name;
    document.getElementById('mImg').src = img;
    document.getElementById('mBio').innerText = bio || 'Expert Barber';

    // Stars
    let stars = '';
    for (let i = 1; i <= 5; i++) {
        stars += i <= Math.round(rating) ? '<i class="bi bi-star-fill"></i> ' :
            '<i class="bi bi-star text-secondary"></i> ';
    }
    document.getElementById('mRatingStars').innerHTML = stars;
    document.getElementById('mRatingText').innerText = `(${rating} / 5.0 dari ${count} review)`;

    // Jadwal
    let schedHtml = '';
    const days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    days.forEach(d => {
        let t = schedule[d] || 'OFF';
        let color = t === 'OFF' ? 'text-danger fw-bold' : 'text-success';
        schedHtml += `<div class="schedule-badge"><span>${d}</span><span class="${color}">${t}</span></div>`;
    });
    document.getElementById('mSchedule').innerHTML = schedHtml;

    // Review
    let revHtml = '';
    if (reviews.length > 0) {
        reviews.forEach(r => {
            revHtml += `
                <div class="mb-2 pb-2 border-bottom border-secondary">
                    <div class="d-flex justify-content-between">
                        <span class="text-gold-primary small fw-bold">${r.user ? r.user.name : 'User'}</span>
                        <span class="text-warning small"><i class="bi bi-star-fill"></i> ${r.rating}</span>
                    </div>
                    <p class="text-white-50 small m-0 fst-italic">"${r.comment || ''}"</p>
                </div>`;
        });
    } else {
        revHtml = '<p class="text-center text-muted small">Belum ada ulasan.</p>';
    }
    document.getElementById('mReviews').innerHTML = revHtml;

    new bootstrap.Modal(document.getElementById('barberModal')).show();
}
</script>
@endpush