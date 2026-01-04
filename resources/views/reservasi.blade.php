@extends('layouts.app')

@section('title', 'Booking Ritual')

@push('styles')
<style>
/* 1. VARIABEL WARNA (Tema Gelap & Emas) */
:root {
    --bg-main: #050505;
    /* Hitam Pekat */
    --bg-card: #141414;
    /* Abu Sangat Gelap */
    --gold: #D4AF37;
    /* Emas Mewah */
    --gold-dim: rgba(212, 175, 55, 0.2);
    --text-white: #ffffff;
    --border-dark: #333333;
}

/* 2. GLOBAL RESET */
body {
    background-color: var(--bg-main) !important;
    color: var(--text-white) !important;
    font-family: sans-serif;
}

h1,
h2,
h3,
h4,
h5,
h6 {
    color: var(--text-white);
}

/* 3. INPUT FORM (Dark Mode Style) */
.form-control {
    background-color: transparent !important;
    border: 1px solid var(--border-dark) !important;
    color: #fff !important;
    border-radius: 0;
    padding: 15px;
}

.form-control:focus {
    border-color: var(--gold) !important;
    box-shadow: 0 0 10px var(--gold-dim);
}

/* Fix Warna Kalender agar Putih */
input[type="date"] {
    color-scheme: dark;
    /* Fitur browser modern untuk kalender gelap */
}

::-webkit-calendar-picker-indicator {
    filter: invert(1);
    /* Memutihkan icon kalender */
    cursor: pointer;
}

/* 4. CARD SELECTION (Barber & Service) */
.selection-input {
    display: none;
}

.selection-card {
    background: var(--bg-card);
    border: 1px solid var(--border-dark);
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: 0.3s;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.selection-card:hover {
    border-color: var(--gold);
    transform: translateY(-5px);
}

.selection-input:checked+.selection-card {
    border: 2px solid var(--gold);
    background: rgba(212, 175, 55, 0.1);
    box-shadow: 0 0 15px var(--gold-dim);
}

.barber-img {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #555;
    margin-bottom: 10px;
    filter: grayscale(100%);
    transition: 0.3s;
}

.selection-input:checked+.selection-card .barber-img {
    filter: grayscale(0%);
    border-color: var(--gold);
}

/* 5. TOMBOL SLOT WAKTU (Merah jika Full) */
.time-slot {
    background: transparent;
    border: 1px solid #444;
    color: white;
    padding: 15px 0;
    text-align: center;
    cursor: pointer;
    display: block;
    transition: 0.2s;
    font-weight: bold;
}

.time-slot:hover {
    border-color: var(--gold);
    color: var(--gold);
}

.selection-input:checked+.time-slot {
    background: var(--gold);
    color: black;
    border-color: var(--gold);
}

/* Style Slot Penuh/Booked */
.time-slot.booked {
    background: #330000 !important;
    /* Merah Gelap */
    border-color: #ff0000 !important;
    color: #777 !important;
    text-decoration: line-through;
    cursor: not-allowed;
    position: relative;
}

.time-slot.booked::after {
    content: 'FULL';
    font-size: 0.6rem;
    color: red;
    display: block;
}

/* 6. MODAL (Pop-up Detail) - HARUS GELAP */
.modal-content {
    background-color: #1a1a1a !important;
    /* Latar Belakang Modal Gelap */
    border: 1px solid var(--gold);
    color: white !important;
}

.modal-header {
    border-bottom: 1px solid #333;
}

.modal-footer {
    border-top: 1px solid #333;
}

.btn-close {
    filter: invert(1);
    /* Tombol close jadi putih */
}

/* Tabel Jadwal di Modal */
.schedule-row {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid #333;
}

/* Ulasan di Modal */
.review-box {
    background: #000;
    padding: 10px;
    border-left: 3px solid var(--gold);
    margin-bottom: 10px;
}

/* 7. SUMMARY BAR (Bawah) */
.sticky-summary {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background: rgba(0, 0, 0, 0.95);
    border-top: 2px solid var(--gold);
    padding: 20px 0;
    z-index: 9999;
    display: none;
    /* Default hide */
}

.btn-gold {
    background: var(--gold);
    color: black;
    font-weight: bold;
    border: none;
    padding: 10px 30px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.btn-gold:hover {
    background: #fff;
}

/* Tombol Cek Status */
.btn-status-outline {
    border: 1px solid var(--gold);
    color: var(--gold);
    background: transparent;
    padding: 10px 20px;
    text-decoration: none;
    display: inline-block;
    margin-top: 15px;
}

.btn-status-outline:hover {
    background: var(--gold);
    color: black;
}
</style>
@endpush

@section('content')
<div class="container" style="margin-top: 100px; margin-bottom: 150px;">

    {{-- HEADER --}}
    <div class="text-center mb-5">
        <h5 class="text-warning ls-2">PREMIUM RESERVATION</h5>
        <h2 class="fw-bold text-white display-4">BOOK YOUR SLOT</h2>
        <hr style="width: 50px; border: 2px solid var(--gold); margin: 20px auto; opacity: 1;">
    </div>

    {{-- ALERT SUKSES + TOMBOL CEK STATUS --}}
    @if(session('success'))
    <div class="alert border border-success bg-dark text-white text-center p-4 mb-5">
        <h4 class="text-success fw-bold"><i class="bi bi-check-circle"></i> RESERVASI DITERIMA!</h4>
        <p>{{ session('success') }}</p>
        <a href="{{ route('reservasi.history') }}" class="btn-status-outline">
            CEK STATUS PEMESANAN
        </a>
    </div>
    @endif

    <form action="{{ route('reservasi.store') }}" method="POST">
        @csrf

        {{-- 1. PILIH TANGGAL --}}
        <div class="mb-5">
            <h4 class="text-warning text-center mb-4">01. PILIH TANGGAL</h4>
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <input type="date" name="date" id="dateInput" class="form-control text-center fs-4"
                        min="{{ date('Y-m-d') }}" required onchange="checkSlots()">
                    <div class="text-center text-muted small mt-2">Pilih tanggal untuk melihat jam tersedia</div>
                </div>
            </div>
        </div>

        {{-- 2. PILIH BARBER --}}
        <div class="mb-5">
            <h4 class="text-warning text-center mb-4">02. PILIH ARTIST</h4>
            <div class="row g-3 justify-content-center">
                {{-- Any Barber --}}
                <div class="col-6 col-md-3 col-lg-2">
                    <input type="radio" name="barber_id" id="b_null" value="" class="selection-input" checked
                        onchange="checkSlots()">
                    <label for="b_null" class="selection-card">
                        <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center mb-2"
                            style="width: 80px; height: 80px;">
                            <i class="bi bi-shuffle fs-1 text-white"></i>
                        </div>
                        <h6 class="fw-bold text-white mb-0">ANY BARBER</h6>
                        <small class="text-muted">Rekomendasi</small>
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
                @endphp
                <div class="col-6 col-md-3 col-lg-2">
                    <input type="radio" name="barber_id" id="b_{{ $barber->id }}" value="{{ $barber->id }}"
                        class="selection-input" data-name="{{ $barber->name }}" onchange="checkSlots()">
                    <label for="b_{{ $barber->id }}" class="selection-card">
                        <img src="{{ $img }}" class="barber-img">
                        <h6 class="fw-bold text-white mb-1">{{ Str::limit($barber->name, 10) }}</h6>

                        {{-- Tombol Detail --}}
                        <button type="button" class="btn btn-sm btn-outline-warning rounded-0 mt-2"
                            onclick="event.stopPropagation(); showModal('{{ $barber->name }}', '{{ $img }}', '{{ $barber->bio }}', {{ $sched }}, {{ $revs }}, '{{ $rating }}')">
                            DETAIL
                        </button>
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        {{-- 3. PILIH SERVICE --}}
        <div class="mb-5">
            <h4 class="text-warning text-center mb-4">03. PILIH LAYANAN</h4>
            <div class="row g-4">
                @foreach($services as $service)
                <div class="col-6 col-md-4 col-lg-3">
                    <input type="radio" name="service_id" id="s_{{ $service->id }}" value="{{ $service->id }}"
                        class="selection-input" data-name="{{ $service->name }}" data-price="{{ $service->price }}"
                        onchange="updateSummary()" required>
                    <label for="s_{{ $service->id }}" class="selection-card p-0 overflow-hidden">
                        <img src="{{ $service->image_path ?? asset('images/default-service.jpg') }}" class="w-100"
                            style="height: 140px; object-fit: cover;"
                            onerror="this.src='https://via.placeholder.com/300x200/000/fff?text=SERVICE'">
                        <div class="p-3 w-100">
                            <h6 class="fw-bold text-white mb-1">{{ $service->name }}</h6>
                            <span class="text-warning fw-bold border border-warning px-2">
                                Rp {{ number_format($service->price, 0, ',', '.') }}
                            </span>
                        </div>
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        {{-- 4. PILIH WAKTU (AJAX Logic Here) --}}
        <div class="mb-5">
            <h4 class="text-warning text-center mb-4">04. PILIH WAKTU</h4>
            <div class="row g-2 justify-content-center">
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
<div class="mb-5">
    <h4 class="text-warning text-center mb-4">05. KONFIRMASI</h4>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <input type="hidden" name="name" value="{{ Auth::user()->name }}">
            <div class="mb-3">
                <label class="text-warning fw-bold mb-2">NO WHATSAPP</label>
                <input type="text" name="phone" class="form-control text-center" placeholder="08xxxxxxxx" required>
            </div>
            <div class="mb-3">
                <label class="text-warning fw-bold mb-2">CATATAN</label>
                <textarea name="notes" class="form-control text-center" rows="2"
                    placeholder="Permintaan khusus..."></textarea>
            </div>
        </div>
    </div>
</div>

{{-- SUMMARY BAR --}}
<div class="sticky-summary" id="summaryBar">
    <div class="container d-flex justify-content-between align-items-center">
        <div>
            <small class="text-muted d-block">TOTAL BAYAR</small>
            <h3 class="text-warning fw-bold m-0" id="priceDisplay">Rp 0</h3>
            <small class="text-white" id="descDisplay">...</small>
        </div>
        <button type="submit" class="btn btn-gold">BOOKING SEKARANG</button>
    </div>
</div>

</form>

{{-- MODAL DETAIL BARBER (Dark Theme) --}}
<div class="modal fade" id="barberModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-warning" id="mName">Barber Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img src="" id="mImg" class="rounded-circle border border-warning mb-3"
                    style="width: 120px; height: 120px; object-fit: cover;">
                <p class="text-white small fst-italic" id="mBio">Bio...</p>
                <div class="text-warning fs-5 mb-3" id="mRating"></div>

                <h6 class="text-warning border-bottom border-secondary pb-2">JADWAL MINGGU INI</h6>
                <div id="mSchedule" class="mb-3 text-start small"></div>

                <h6 class="text-warning border-bottom border-secondary pb-2">ULASAN TERBARU</h6>
                <div id="mReviews" class="text-start small" style="max-height: 150px; overflow-y: auto;"></div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection

@push('scripts')
<script>
// --- 1. AJAX CEK JAM MERAH ---
function checkSlots() {
    const date = document.getElementById('dateInput').value;
    const barberEl = document.querySelector('input[name="barber_id"]:checked');
    const barberId = barberEl ? barberEl.value : '';

    updateSummary(); // Update harga/teks

    if (!date) return;

    // Reset semua slot jadi putih dulu
    document.querySelectorAll('.time-radio').forEach(el => el.disabled = false);
    document.querySelectorAll('.time-slot').forEach(el => el.classList.remove('booked'));

    // Panggil Backend
    fetch(`/reservasi/check-slots?date=${date}&barber_id=${barberId}`)
        .then(res => res.json())
        .then(data => {
            data.forEach(time => {
                // Convert 10:00 -> 1000
                let id = time.substring(0, 5).replace(':', '');
                let input = document.getElementById('t_' + id);
                let label = document.getElementById('label_' + id);

                if (input && label) {
                    input.disabled = true;
                    label.classList.add('booked');
                }
            });
        })
        .catch(err => console.error(err));
}

// --- 2. UPDATE SUMMARY ---
function updateSummary() {
    const svc = document.querySelector('input[name="service_id"]:checked');
    const bar = document.getElementById('summaryBar');

    if (svc) {
        bar.style.display = 'flex'; // Munculkan bar
        const price = parseInt(svc.getAttribute('data-price'));
        document.getElementById('priceDisplay').innerText = 'Rp ' + price.toLocaleString('id-ID');

        // Update teks deskripsi
        let txt = svc.getAttribute('data-name');
        const bbr = document.querySelector('input[name="barber_id"]:checked');
        if (bbr && bbr.value) txt += ' + ' + bbr.getAttribute('data-name');

        const date = document.getElementById('dateInput').value;
        const time = document.querySelector('input[name="time"]:checked');
        if (date && time) txt += ' (' + date + ' @ ' + time.value + ')';

        document.getElementById('descDisplay').innerText = txt;
    }
}

// --- 3. MODAL DETAIL ---
function showModal(name, img, bio, schedule, reviews, rating) {
    document.getElementById('mName').innerText = name;
    document.getElementById('mImg').src = img;
    document.getElementById('mBio').innerText = bio || 'Barber Profesional';
    document.getElementById('mRating').innerText = '★ ' + rating + ' / 5.0';

    // Jadwal
    let schedHtml = '';
    const days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    days.forEach(d => {
        let t = schedule[d] || 'OFF';
        let color = t === 'OFF' ? 'text-danger' : 'text-white';
        schedHtml +=
            `<div class="d-flex justify-content-between"><span>${d}</span><span class="${color}">${t}</span></div>`;
    });
    document.getElementById('mSchedule').innerHTML = schedHtml;

    // Review
    let revHtml = '';
    if (reviews.length > 0) {
        reviews.forEach(r => {
            revHtml +=
                `<div class="review-box"><span class="text-warning fw-bold">${r.user ? r.user.name : 'User'}</span><br>"${r.comment || ''}"</div>`;
        });
    } else {
        revHtml = '<p class="text-center text-muted">Belum ada ulasan.</p>';
    }
    document.getElementById('mReviews').innerHTML = revHtml;

    new bootstrap.Modal(document.getElementById('barberModal')).show();
}
</script>
@endpush