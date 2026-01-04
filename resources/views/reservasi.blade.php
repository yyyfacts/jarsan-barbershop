@extends('layouts.app')

@section('title', 'Premium Booking Ritual')

@push('styles')
<link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap"
    rel="stylesheet">
<style>
/* --- ULTIMATE LUXURY VARIABLES --- */
:root {
    --base-dark: #050505;
    --surface-dark: #111111;
    --accent-gold: #D4AF37;
    --accent-gold-bright: #F2D06B;
    --glass-white: rgba(255, 255, 255, 0.03);
    --glass-border: rgba(255, 255, 255, 0.08);
    --text-dim: #a0a0a0;
    --gold-gradient: linear-gradient(135deg, #D4AF37 0%, #B8860B 100%);
}

body {
    background-color: var(--base-dark) !important;
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: #ffffff;
    letter-spacing: -0.01em;
}

/* --- DECORATIVE BACKGROUND --- */
.bg-ritual {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background:
        radial-gradient(circle at 50% -20%, rgba(212, 175, 55, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 0% 100%, rgba(212, 175, 55, 0.05) 0%, transparent 30%);
    z-index: -1;
}

/* --- SECTION TITLES --- */
.ritual-title {
    font-family: 'Playfair Display', serif;
    font-size: 3.5rem;
    font-weight: 700;
    background: linear-gradient(to bottom, #fff 40%, var(--accent-gold) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.step-header {
    text-align: center;
    margin-bottom: 50px;
}

.step-number {
    font-family: 'Playfair Display', serif;
    color: var(--accent-gold);
    font-style: italic;
    font-size: 1.2rem;
    display: block;
    margin-bottom: 5px;
}

.step-label {
    text-transform: uppercase;
    letter-spacing: 4px;
    font-size: 0.9rem;
    font-weight: 700;
    color: #ffffff;
}

/* --- LUXURY CARDS --- */
.selection-card {
    background: var(--glass-white);
    border: 1px solid var(--glass-border);
    backdrop-filter: blur(10px);
    transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
    cursor: pointer;
    height: 100%;
    position: relative;
    overflow: hidden;
}

.selection-card:hover {
    border-color: var(--accent-gold);
    background: rgba(212, 175, 55, 0.05);
    transform: translateY(-10px);
}

.selection-input:checked+.selection-card {
    border-color: var(--accent-gold);
    background: rgba(212, 175, 55, 0.08);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), 0 0 20px rgba(212, 175, 55, 0.1);
}

/* BARBER IMAGE STYLING */
.barber-wrapper {
    position: relative;
    width: 100px;
    height: 100px;
    margin: 0 auto 15px;
}

.barber-img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    filter: grayscale(100%);
    border: 2px solid var(--glass-border);
    transition: 0.5s;
}

.selection-input:checked+.selection-card .barber-img {
    filter: grayscale(0%);
    border-color: var(--accent-gold);
    box-shadow: 0 0 15px var(--accent-gold);
}

/* --- SERVICE GRID --- */
.service-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, transparent 60%);
}

/* --- TIME SLOTS --- */
.time-slot-label {
    background: var(--glass-white);
    border: 1px solid var(--glass-border);
    padding: 18px;
    text-align: center;
    transition: 0.3s;
    font-weight: 600;
    letter-spacing: 1px;
}

.selection-input:checked+.time-slot-label {
    background: var(--gold-gradient);
    color: #000;
    border-color: transparent;
}

/* BOOKED STATE */
.time-slot-label.booked {
    background: #1a0505 !important;
    border-color: #330000 !important;
    color: #444 !important;
    text-decoration: line-through;
    opacity: 0.5;
    cursor: not-allowed;
}

/* --- SUMMARY BAR --- */
.luxury-summary {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background: rgba(5, 5, 5, 0.9);
    backdrop-filter: blur(20px);
    border-top: 1px solid var(--accent-gold);
    padding: 25px 0;
    z-index: 2000;
    display: none;
    animation: slideUp 0.5s cubic-bezier(0.23, 1, 0.32, 1);
}

.btn-ritual {
    background: var(--gold-gradient);
    color: #000;
    font-weight: 800;
    letter-spacing: 3px;
    padding: 18px 45px;
    border: none;
    transition: 0.4s;
    border-radius: 0;
}

.btn-ritual:hover {
    transform: scale(1.05);
    box-shadow: 0 0 30px rgba(212, 175, 55, 0.4);
}

/* --- CUSTOM ALERT --- */
.alert-success-luxury {
    background: rgba(212, 175, 55, 0.1);
    border: 1px solid var(--accent-gold);
    padding: 40px;
    text-align: center;
    margin-bottom: 60px;
}

input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(0.7) sepia(1) saturate(5) hue-rotate(10deg);
    cursor: pointer;
}
</style>
@endpush

@section('content')
<div class="bg-ritual"></div>

<div class="container pb-5" style="margin-top: 150px; margin-bottom: 180px;">

    {{-- HEADER --}}
    <div class="text-center mb-5" data-aos="fade-down">
        <h2 class="ritual-title mb-3">The Ritual</h2>
        <p class="text-gold letter-spacing-5 fw-light small">RESERVE YOUR TIME AT JARSAN</p>
    </div>

    @if(session('success'))
    <div class="alert-success-luxury" data-aos="zoom-in">
        <h3 class="fw-bold mb-3">APPOINTMENT SECURED</h3>
        <p class="text-white-50 mb-4">{{ session('success') }}</p>
        <a href="{{ route('reservasi.history') }}" class="btn-check-status px-5 py-3">VIEW MY STATUS</a>
    </div>
    @endif

    <form action="{{ route('reservasi.store') }}" method="POST" id="bookingForm">
        @csrf

        {{-- 01. DATE --}}
        <div class="mb-5 py-5" data-aos="fade-up">
            <div class="step-header">
                <span class="step-number">I.</span>
                <h4 class="step-label">Select Date</h4>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <input type="date" name="date" class="form-control date-luxury" min="{{ date('Y-m-d') }}" required
                        id="dateInput" onchange="checkAvailableSlots()">
                </div>
            </div>
        </div>

        {{-- 02. BARBER --}}
        <div class="mb-5 py-5" data-aos="fade-up">
            <div class="step-header">
                <span class="step-number">II.</span>
                <h4 class="step-label">Choose Your Artist</h4>
            </div>
            <div class="row g-4 justify-content-center">
                {{-- ANY BARBER --}}
                <div class="col-6 col-md-3 col-lg-2">
                    <input type="radio" name="barber_id" id="barber_null" value="" class="selection-input d-none"
                        checked onchange="checkAvailableSlots()">
                    <label for="barber_null"
                        class="selection-card p-4 text-center d-flex flex-column align-items-center justify-content-center">
                        <div class="barber-wrapper">
                            <div class="barber-img d-flex align-items-center justify-content-center bg-dark">
                                <i class="bi bi-stars fs-1 text-gold"></i>
                            </div>
                        </div>
                        <h6 class="text-white fw-bold mb-1 small mt-2">Any Artist</h6>
                        <small class="text-white-50">Auto-Select</small>
                    </label>
                </div>

                @foreach($barbers as $barber)
                @php
                $imgSrc = $barber->photo_path ?? 'https://ui-avatars.com/api/?name=' . urlencode($barber->name);
                $scheduleJson = json_encode($barber->schedule ?? []);
                $reviewsJson = json_encode($barber->reviews->sortByDesc('created_at')->take(5)->values());
                $avgRating = number_format($barber->reviews->avg('rating') ?? 0, 1);
                @endphp
                <div class="col-6 col-md-3 col-lg-2">
                    <input type="radio" name="barber_id" id="barber_{{ $barber->id }}" value="{{ $barber->id }}"
                        class="selection-input d-none" data-name="{{ $barber->name }}" onchange="checkAvailableSlots()">
                    <label for="barber_{{ $barber->id }}" class="selection-card p-4 text-center h-100">
                        <div class="barber-wrapper">
                            <img src="{{ $imgSrc }}" class="barber-img">
                        </div>
                        <h6 class="text-white fw-bold mb-2 small text-uppercase">{{ Str::limit($barber->name, 12) }}
                        </h6>
                        <button type="button" class="btn-detail bg-transparent border-0 text-gold small p-0"
                            onclick="event.stopPropagation(); showBarberDetail('{{ $barber->name }}', '{{ $imgSrc }}', '{{ $barber->bio ?? 'Premier Barber' }}', {{ $scheduleJson }}, {{ $reviewsJson }}, '{{ $avgRating }}', {{ $barber->reviews->count() }})">
                            <u>View Details</u>
                        </button>
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        {{-- 03. SERVICE --}}
        <div class="mb-5 py-5" data-aos="fade-up">
            <div class="step-header">
                <span class="step-number">III.</span>
                <h4 class="step-label">Select Treatment</h4>
            </div>
            <div class="row g-4">
                @foreach($services as $service)
                <div class="col-6 col-md-4 col-lg-3">
                    <input type="radio" name="service_id" id="service_{{ $service->id }}" value="{{ $service->id }}"
                        class="selection-input d-none" data-name="{{ $service->name }}"
                        data-price="{{ $service->price }}" onchange="updateSummary()" required>
                    <label for="service_{{ $service->id }}" class="selection-card p-0 h-100">
                        <div style="height: 160px; position: relative;">
                            <img src="{{ $service->image_path ?? asset('images/default-service.jpg') }}"
                                class="w-100 h-100 object-fit-cover">
                            <div class="service-overlay"></div>
                        </div>
                        <div class="p-4">
                            <h6 class="text-white fw-bold mb-1 letter-spacing-1">{{ strtoupper($service->name) }}</h6>
                            <span class="text-gold fw-bold small">IDR
                                {{ number_format($service->price, 0, ',', '.') }}</span>
                        </div>
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        {{-- 04. TIME --}}
        <div class="mb-5 py-5" data-aos="fade-up">
            <div class="step-header">
                <span class="step-number">IV.</span>
                <h4 class="step-label">Appointment Time</h4>
            </div>
            <div class="row g-3 justify-content-center">
                @php
                $start = strtotime('10:00');
                $end = strtotime('21:00');
                @endphp
                @for ($t = $start; $t <= $end; $t +=1800) @php $timeVal=date('H:i', $t); $cleanTime=str_replace(':', ''
                    , $timeVal); @endphp <div class="col-4 col-md-2">
                    <input type="radio" name="time" id="time_{{ $cleanTime }}" value="{{ $timeVal }}"
                        class="selection-input d-none time-radio" onchange="updateSummary()" required>
                    <label for="time_{{ $cleanTime }}" class="time-slot-label time-label d-block rounded-0"
                        data-time="{{ $timeVal }}">
                        {{ $timeVal }}
                    </label>
            </div>
            @endfor
        </div>
</div>

{{-- 05. CONTACT --}}
<div class="mb-5 py-5" data-aos="fade-up">
    <div class="step-header">
        <span class="step-number">V.</span>
        <h4 class="step-label">Confirmation</h4>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <input type="hidden" name="name" value="{{ Auth::user()->name }}">
            <div class="mb-4">
                <label class="text-gold small fw-bold mb-3 d-block letter-spacing-2">WHATSAPP NUMBER</label>
                <input type="text" name="phone" class="form-control form-control-luxury py-3 border-0 rounded-0"
                    style="background: var(--glass-white);" placeholder="08xxxxxxxx" required>
            </div>
            <div class="mb-0">
                <label class="text-gold small fw-bold mb-3 d-block letter-spacing-2">SPECIAL NOTES</label>
                <textarea name="notes" class="form-control form-control-luxury border-0 rounded-0"
                    style="background: var(--glass-white);" rows="3"
                    placeholder="Tell us your preferences..."></textarea>
            </div>
        </div>
    </div>
</div>

{{-- SUMMARY BAR --}}
<div class="luxury-summary" id="summaryBar">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center">
                    <div class="pe-5 border-end border-secondary">
                        <small class="text-gold d-block mb-1 letter-spacing-1">TOTAL PAYMENT</small>
                        <h2 class="text-white fw-bold m-0" id="totalPrice"
                            style="font-family: 'Playfair Display', serif;">Rp 0</h2>
                    </div>
                    <div class="ps-5">
                        <small class="text-white-50 d-block mb-1">SELECTED RITUAL</small>
                        <span class="text-white small fw-light" id="summaryText">...</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <button type="submit" class="btn btn-ritual">CONFIRM RESERVATION</button>
            </div>
        </div>
    </div>
</div>

</form>
</div>

{{-- MODAL DETAIL BARBER --}}
<div class="modal fade" id="barberDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-content-luxury p-4">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5 text-center border-end border-secondary">
                        <img src="" id="modalBarberImg" class="rounded-circle border border-warning mb-4 shadow"
                            style="width: 180px; height: 180px; object-fit: cover;">
                        <h2 class="fw-bold text-white mb-2" id="modalBarberName2"
                            style="font-family: 'Playfair Display';">Name</h2>
                        <p class="text-gold small fst-italic mb-4" id="modalBarberBio">Bio...</p>
                        <div id="ratingBox" class="p-3 bg-dark border border-secondary"></div>
                    </div>
                    <div class="col-md-7 ps-md-5">
                        <h6 class="text-gold border-bottom border-secondary pb-3 mb-3 fw-bold small letter-spacing-2">
                            WEEKLY SCHEDULE</h6>
                        <div id="scheduleContainer" class="mb-5"></div>
                        <h6 class="text-gold border-bottom border-secondary pb-3 mb-3 fw-bold small letter-spacing-2">
                            RECENT REVIEWS</h6>
                        <div class="reviews-container" style="max-height: 200px; overflow-y: auto;"></div>
                    </div>
                </div>
                <div class="text-end mt-4">
                    <button class="btn btn-outline-secondary border-0 text-white px-5"
                        data-bs-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// --- 1. AJAX SLOT CHECK ---
function checkAvailableSlots() {
    const date = document.getElementById('dateInput').value;
    const barberId = document.querySelector('input[name="barber_id"]:checked').value;
    updateSummary();
    if (!date) return;

    fetch(`/reservasi/check-slots?date=${date}&barber_id=${barberId}`)
        .then(res => res.json())
        .then(booked => {
            document.querySelectorAll('.time-radio').forEach(el => el.disabled = false);
            document.querySelectorAll('.time-label').forEach(el => el.classList.remove('booked'));

            booked.forEach(time => {
                const clean = time.substring(0, 5).replace(':', '');
                const input = document.getElementById('time_' + clean);
                const label = document.querySelector(`label[for="time_${clean}"]`);
                if (input && label) {
                    input.disabled = true;
                    label.classList.add('booked');
                }
            });
        });
}

// --- 2. SUMMARY LOGIC ---
function updateSummary() {
    const bar = document.getElementById('summaryBar');
    const svc = document.querySelector('input[name="service_id"]:checked');
    const bbr = document.querySelector('input[name="barber_id"]:checked');
    const tme = document.querySelector('input[name="time"]:checked');
    const dte = document.getElementById('dateInput').value;

    if (svc) {
        bar.style.display = 'block';
        document.getElementById('totalPrice').innerText = 'Rp ' + parseInt(svc.getAttribute('data-price'))
            .toLocaleString('id-ID');
        let txt = svc.getAttribute('data-name');
        if (bbr && bbr.value) txt += ' by ' + bbr.getAttribute('data-name');
        if (dte && tme) txt += ' at ' + dte + ' / ' + tme.value;
        document.getElementById('summaryText').innerText = txt;
    }
}

// --- 3. DETAIL MODAL ---
function showBarberDetail(name, imgSrc, bio, schedule, reviews, avgRating, ratingCount) {
    document.getElementById('modalBarberName2').innerText = name;
    document.getElementById('modalBarberImg').src = imgSrc;
    document.getElementById('modalBarberBio').innerText = bio;

    let stars = '';
    for (let i = 1; i <= 5; i++) stars +=
        `<i class="bi bi-star${i <= Math.round(avgRating) ? '-fill' : ''} text-warning mx-1"></i>`;
    document.getElementById('ratingBox').innerHTML =
        `${stars} <br><small class="text-white-50">${avgRating} / 5.0 from ${ratingCount} clients</small>`;

    const sched = document.getElementById('scheduleContainer');
    sched.innerHTML = '';
    ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'].forEach(day => {
        let time = schedule && schedule[day] ? schedule[day] : 'OFF';
        sched.innerHTML +=
            `<div class="d-flex justify-content-between mb-2 small"><span class="text-white-50">${day}</span><span class="${time === 'OFF' ? 'text-danger fw-bold' : 'text-white'}">${time}</span></div>`;
    });

    const revs = document.querySelector('.reviews-container');
    revs.innerHTML = reviews.length > 0 ? '' : '<p class="text-white-50 small">Wait for the first review.</p>';
    reviews.forEach(r => {
        revs.innerHTML +=
            `<div class="bg-dark p-3 mb-2 rounded border-start border-warning"><div class="d-flex justify-content-between mb-1"><span class="text-gold small fw-bold">${r.user ? r.user.name : 'Client'}</span><span class="small">★ ${r.rating}</span></div><p class="m-0 text-white-50 small fst-italic">"${r.comment || ''}"</p></div>`;
    });

    new bootstrap.Modal(document.getElementById('barberDetailModal')).show();
}

document.addEventListener('DOMContentLoaded', checkAvailableSlots);
</script>
@endpush