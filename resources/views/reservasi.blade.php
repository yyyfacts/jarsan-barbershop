@extends('layouts.app')

@section('title', 'Booking Ritual')

@push('styles')
    <style>
        /* --- LUXURY THEME VARIABLES --- */
        :root {
            --bg-dark: #0a0a0a;
            --card-bg: #121212;
            --luxury-gold: #D4AF37;
            --gold-dim: rgba(212, 175, 55, 0.2);
            --text-white: #ffffff;
            --border-color: #333;
        }

        /* BACKGROUND HALAMAN */
        body {
            background-color: var(--bg-dark) !important;
            background-image: radial-gradient(circle at 50% 0%, #1a1a1a 0%, #0a0a0a 70%);
        }

        /* JUDUL SECTION */
        .section-title {
            color: var(--luxury-gold);
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            text-align: center;
            margin-bottom: 30px;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-size: 1.2rem;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 1px;
            background-color: var(--luxury-gold);
        }

        /* --- CARD SELECTION STYLE --- */
        .selection-input {
            display: none;
        }

        .selection-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-color);
            border-radius: 0;
            padding: 20px 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .selection-card:hover {
            border-color: var(--luxury-gold);
            background: rgba(212, 175, 55, 0.05);
            transform: translateY(-5px);
        }

        .selection-input:checked+.selection-card {
            border: 1px solid var(--luxury-gold);
            background: linear-gradient(to bottom, rgba(212, 175, 55, 0.1), rgba(0, 0, 0, 0));
            box-shadow: 0 0 15px rgba(212, 175, 55, 0.15);
        }

        .selection-input:checked+.selection-card::after {
            content: '\F26E';
            font-family: 'bootstrap-icons';
            position: absolute;
            top: 10px;
            right: 10px;
            color: var(--luxury-gold);
            font-size: 1.2rem;
        }

        /* GAMBAR BARBER */
        .barber-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #333;
            margin-bottom: 10px;
            transition: 0.3s;
            filter: grayscale(100%);
        }

        .selection-input:checked+.selection-card .barber-img {
            border-color: var(--luxury-gold);
            filter: grayscale(0%);
        }

        /* TOMBOL DETAIL */
        .btn-detail {
            font-size: 0.7rem;
            letter-spacing: 1px;
            color: var(--luxury-gold);
            border: 1px solid var(--luxury-gold);
            background: transparent;
            padding: 5px 15px;
            margin-top: 10px;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
            z-index: 10;
            position: relative;
        }

        .btn-detail:hover {
            background: var(--luxury-gold);
            color: #000;
        }

        /* GAMBAR SERVICE */
        .service-img {
            width: 100%;
            height: 140px;
            object-fit: cover;
            margin-bottom: 15px;
            filter: brightness(0.8);
            border: 1px solid #333;
        }

        .selection-input:checked+.selection-card .service-img {
            filter: brightness(1);
            border-color: var(--luxury-gold);
        }

        /* --- TIME SLOTS --- */
        .time-slot-label {
            display: block;
            background-color: transparent;
            color: var(--text-white);
            padding: 12px 0;
            border: 1px solid #444;
            text-align: center;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s;
            font-size: 0.9rem;
            letter-spacing: 1px;
        }

        .time-slot-label:hover {
            border-color: var(--luxury-gold);
            color: var(--luxury-gold);
        }

        .selection-input:checked+.time-slot-label {
            background-color: var(--luxury-gold);
            border-color: var(--luxury-gold);
            color: #000;
            font-weight: 700;
            box-shadow: 0 0 15px rgba(212, 175, 55, 0.4);
        }

        /* --- DATE INPUT --- */
        .date-luxury {
            background: transparent;
            border: none;
            border-bottom: 2px solid #444;
            color: var(--luxury-gold);
            padding: 15px;
            width: 100%;
            font-size: 1.5rem;
            text-align: center;
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            border-radius: 0;
        }

        .date-luxury:focus {
            background: transparent;
            border-bottom-color: var(--luxury-gold);
            color: var(--luxury-gold);
            box-shadow: none;
        }

        .date-luxury::-webkit-calendar-picker-indicator {
            filter: invert(1) sepia(100%) saturate(1000%) hue-rotate(0deg) brightness(1.2) contrast(1);
            cursor: pointer;
        }

        /* --- STICKY SUMMARY --- */
        .booking-summary {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(10px);
            border-top: 1px solid var(--luxury-gold);
            padding: 20px 0;
            z-index: 1050;
            display: none;
            animation: slideUp 0.3s ease-out;
        }

        @keyframes slideUp {
            from {
                transform: translateY(100%);
            }

            to {
                transform: translateY(0);
            }
        }

        /* --- MODAL DETAIL --- */
        .modal-content-luxury {
            background-color: #121212;
            border: 1px solid var(--luxury-gold);
            color: white;
            border-radius: 0;
        }

        .modal-header-luxury {
            border-bottom: 1px solid #333;
        }

        .modal-body-luxury {
            padding: 2rem;
        }

        .schedule-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #222;
            font-size: 0.9rem;
        }

        .schedule-row:last-child {
            border-bottom: none;
        }

        .text-gold-dim {
            color: rgba(212, 175, 55, 0.8);
        }

        .form-control-luxury {
            background: transparent;
            border: 1px solid #444;
            color: white;
            padding: 15px;
            border-radius: 0;
        }

        .form-control-luxury:focus {
            background: transparent;
            border-color: var(--luxury-gold);
            color: white;
            box-shadow: none;
        }

        /* ULASAN STYLE */
        .review-item {
            background: #1a1a1a;
            border: 1px solid #333;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            text-align: left;
        }

        .review-user {
            font-weight: bold;
            color: var(--luxury-gold);
            font-size: 0.85rem;
        }

        .review-text {
            font-size: 0.8rem;
            color: #ccc;
            font-style: italic;
        }
    </style>
@endpush

@section('content')
    <div class="container pb-5" style="margin-top: 100px; margin-bottom: 120px;">

        <div class="text-center mb-5" data-aos="fade-down">
            <h5 class="text-gold letter-spacing-2 mb-2 fw-bold">PREMIUM RESERVATION</h5>
            <h2 class="display-4 fw-bold text-white">BOOK YOUR SLOT</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success bg-transparent border border-success text-white text-center mb-5 rounded-0">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('reservasi.store') }}" method="POST" id="bookingForm">
            @csrf

            {{-- 1. PILIH TANGGAL --}}
            <div class="mb-5" data-aos="fade-up">
                <h4 class="section-title">01. PILIH TANGGAL</h4>
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <input type="date" name="date" class="form-control date-luxury" min="{{ date('Y-m-d') }}" required
                            id="dateInput">
                        <div class="text-center mt-2 text-white-50 small">Klik tanggal untuk mengubah</div>
                    </div>
                </div>
            </div>

            {{-- 2. PILIH BARBER --}}
            <div class="mb-5" data-aos="fade-up">
                <h4 class="section-title">02. PILIH BARBER</h4>
                <div class="row g-3 justify-content-center">
                    {{-- Opsi Any Barber --}}
                    <div class="col-6 col-md-3 col-lg-2">
                        <input type="radio" name="barber_id" id="barber_null" value="" class="selection-input" checked
                            onchange="updateSummary()">
                        <label for="barber_null" class="selection-card">
                            <div
                                class="barber-img d-flex align-items-center justify-content-center bg-dark text-white border-secondary">
                                <i class="bi bi-shuffle fs-2 text-white-50"></i>
                            </div>
                            <h6 class="text-white fw-bold mb-1 small">ANY BARBER</h6>
                            <small class="text-white-50" style="font-size: 0.7rem;">Pilih Acak</small>
                        </label>
                    </div>

                    {{-- Loop Barber --}}
                    @foreach($barbers as $barber)
                        @php
                            // Prioritaskan photo_path (Base64) sesuai admin controller, fallback ke default
                            $imgSrc = $barber->photo_path ??
                                'https://ui-avatars.com/api/?name=' . urlencode($barber->name) . '&background=D4AF37&color=000';

                            // Data Jadwal (JSON)
                            $scheduleJson = json_encode($barber->schedule ?? []);

                            // Data Review (Ambil 5 terbaru via relasi)
                            $reviews = $barber->reviews->sortByDesc('created_at')->take(5)->values();
                            $reviewsJson = json_encode($reviews);

                            // Hitung Rating
                            $avgRating = $barber->reviews->avg('rating') ?? 0;
                            $ratingCount = $barber->reviews->count();
                            $avgRatingFormat = number_format($avgRating, 1);
                        @endphp

                        <div class="col-6 col-md-3 col-lg-2">
                            <input type="radio" name="barber_id" id="barber_{{ $barber->id }}" value="{{ $barber->id }}"
                                class="selection-input" data-name="{{ $barber->name }}" onchange="updateSummary()">
                            <label for="barber_{{ $barber->id }}" class="selection-card pb-1">

                                <img src="{{ $imgSrc }}" class="barber-img" alt="{{ $barber->name }}">
                                <h6 class="text-white fw-bold mb-0 small text-uppercase">{{ Str::limit($barber->name, 10) }}
                                </h6>

                                {{-- TOMBOL LIHAT DETAIL (Mengirim Data ke JS) --}}
                                <button type="button" class="btn-detail" onclick="event.stopPropagation(); showBarberDetail(
                                                '{{ $barber->name }}', 
                                                '{{ $imgSrc }}', 
                                                '{{ $barber->bio ?? 'Profesional Barber at Jarsan' }}', 
                                                {{ $scheduleJson }}, 
                                                {{ $reviewsJson }}, 
                                                '{{ $avgRatingFormat }}', 
                                                {{ $ratingCount }}
                                            )">
                                    Lihat Detail
                                </button>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- 3. PILIH SERVICE --}}
            <div class="mb-5" data-aos="fade-up">
                <h4 class="section-title">03. PILIH LAYANAN</h4>
                <div class="row g-4">
                    @foreach($services as $service)
                        <div class="col-6 col-md-4 col-lg-3">
                            <input type="radio" name="service_id" id="service_{{ $service->id }}" value="{{ $service->id }}"
                                class="selection-input" data-name="{{ $service->name }}" data-price="{{ $service->price }}"
                                onchange="updateSummary()" required>
                            <label for="service_{{ $service->id }}" class="selection-card p-0 pb-3">
                                <div
                                    style="width: 100%; height: 140px; overflow: hidden; margin-bottom: 15px; position: relative;">
                                    <img src="{{ $service->image_path ?? asset('images/default-service.jpg') }}"
                                        class="service-img m-0 border-0" style="width: 100%; height: 100%;"
                                        alt="{{ $service->name }}"
                                        onerror="this.src='https://via.placeholder.com/300x200/000000/FFFFFF?text=PREMIUM'">
                                </div>
                                <div class="px-3 w-100">
                                    <h6 class="text-white fw-bold mb-2 text-uppercase"
                                        style="font-size: 0.85rem; letter-spacing: 1px;">{{ $service->name }}</h6>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <span class="text-gold fw-bold border border-warning px-2 py-1"
                                            style="font-size: 0.8rem; border-color: var(--luxury-gold) !important;">
                                            Rp {{ number_format($service->price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- 4. PILIH WAKTU (30 MENITAN) --}}
            <div class="mb-5" data-aos="fade-up">
                <h4 class="section-title">04. PILIH WAKTU</h4>
                <div class="row g-2 justify-content-center">
                    @php
                        $start = strtotime('10:00');
                        $end = strtotime('21:00');
                    @endphp

                    {{-- LOOPING PER 30 MENIT (+1800 detik) --}}
                    @for ($t = $start; $t <= $end; $t += 1800) @php $timeVal = date('H:i', $t); @endphp <div
                            class="col-4 col-md-2">
                            <input type="radio" name="time" id="time_{{ $timeVal }}" value="{{ $timeVal }}"
                                class="selection-input" onchange="updateSummary()" required>
                            <label for="time_{{ $timeVal }}" class="time-slot-label">{{ $timeVal }}</label>
                        </div>
                    @endfor
                </div>
            </div>

            {{-- 5. KONTAK --}}
            <div class="mb-5" data-aos="fade-up">
                <h4 class="section-title">05. KONFIRMASI</h4>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                        <div class="mb-3">
                            <label class="text-gold small fw-bold letter-spacing-2 mb-2">NOMOR WHATSAPP</label>
                            <input type="text" name="phone" class="form-control form-control-luxury"
                                placeholder="Contoh: 08123456789" required>
                        </div>
                        <div class="mb-3">
                            <label class="text-gold small fw-bold letter-spacing-2 mb-2">CATATAN (OPSIONAL)</label>
                            <textarea name="notes" class="form-control form-control-luxury" rows="2"
                                placeholder="Pesan khusus untuk barber..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SUMMARY BAR (STICKY) --}}
            <div class="booking-summary" id="summaryBar">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-white-50 d-block mb-1 letter-spacing-1" style="font-size: 0.7rem;">ESTIMASI
                                TOTAL</small>
                            <h3 class="text-gold fw-bold m-0" id="totalPrice"
                                style="font-family: 'Playfair Display', serif;">Rp 0
                            </h3>
                            <small class="text-white fst-italic" id="summaryText" style="opacity: 0.8;">Menunggu
                                pilihan...</small>
                        </div>
                        <button type="submit" class="btn btn-gold-luxury px-5 py-3 fw-bold rounded-0"
                            style="letter-spacing: 2px;">CONFIRM BOOKING</button>
                    </div>
                </div>
            </div>

        </form>
    </div>

    {{-- MODAL DETAIL BARBER (DINAMIS) --}}
    <div class="modal fade" id="barberDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content modal-content-luxury">
                <div class="modal-header modal-header-luxury">
                    <h5 class="modal-title fw-bold text-gold letter-spacing-1" id="modalBarberName">Barber Name</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body modal-body-luxury text-center">

                    <div class="row">
                        {{-- KOLOM KIRI: FOTO, BIO, RATING --}}
                        <div class="col-md-5 border-end border-secondary">
                            <img src="" id="modalBarberImg" class="rounded-circle border border-warning mb-3 shadow"
                                style="width: 150px; height: 150px; object-fit: cover; border-width: 3px !important; border-color: var(--luxury-gold) !important;">

                            <h5 class="fw-bold text-white mb-1" id="modalBarberName2">Name</h5>
                            <p class="text-white-50 small fst-italic mb-3" id="modalBarberBio">Bio...</p>

                            <div id="ratingBox" class="mb-3 p-2 bg-dark border border-secondary rounded">
                            </div>
                        </div>

                        {{-- KOLOM KANAN: JADWAL & ULASAN --}}
                        <div class="col-md-7 text-start ps-md-4">
                            <h6 class="text-gold border-bottom border-secondary pb-2 mb-3 fw-bold">JADWAL KERJA MINGGU INI
                            </h6>

                            <div id="scheduleContainer" class="bg-dark p-3 border border-secondary mb-4 rounded">
                                {{-- Jadwal akan diisi lewat Javascript --}}
                            </div>

                            <h6 class="text-gold border-bottom border-secondary pb-2 mb-3 fw-bold">ULASAN TERBARU</h6>
                            <div class="reviews-container" style="max-height: 150px; overflow-y: auto;">
                                {{-- Ulasan akan diisi lewat Javascript --}}
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-outline-light w-100 mt-4 rounded-0" data-bs-dismiss="modal">TUTUP</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // --- 1. LOGIC MODAL DETAIL BARBER (DINAMIS) ---
        function showBarberDetail(name, imgSrc, bio, schedule, reviews, avgRating, ratingCount) {
            // A. Set Info Dasar
            document.getElementById('modalBarberName').innerText = name;
            document.getElementById('modalBarberName2').innerText = name;
            document.getElementById('modalBarberImg').src = imgSrc;
            document.getElementById('modalBarberBio').innerText = bio;

            // B. Render Rating Bintang
            let starsHtml = '';
            for (let i = 1; i <= 5; i++) {
                if (i <= Math.round(avgRating)) {
                    starsHtml += '<i class="bi bi-star-fill"></i> ';
                } else {
                    starsHtml += '<i class="bi bi-star text-secondary"></i> ';
                }
            }

            const ratingBox = document.getElementById('ratingBox');
            if (ratingBox) {
                ratingBox.innerHTML = `
                    <div class="text-warning fs-5">${starsHtml}</div>
                    <small class="text-white fw-bold">${avgRating} / 5.0</small> <br>
                    <small class="text-white-50" style="font-size: 0.7rem;">Berdasarkan ${ratingCount} Ulasan</small>
                `;
            }

            // C. Render Jadwal Kerja
            const scheduleContainer = document.getElementById('scheduleContainer');
            scheduleContainer.innerHTML = ''; // Reset konten lama

            const days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            days.forEach(day => {
                // Ambil data dari JSON schedule, default 'OFF' jika kosong
                let time = schedule && schedule[day] ? schedule[day] : 'OFF';

                // Styling warna: Merah jika OFF, Emas Pudar jika Kerja
                let timeClass = time === 'OFF' ? 'text-danger fw-bold' : 'text-gold-dim';

                scheduleContainer.innerHTML += `
                    <div class="schedule-row">
                        <span>${day}</span> <span class="${timeClass}">${time}</span>
                    </div>`;
            });

            // D. Render Ulasan User
            const reviewsContainer = document.querySelector('.reviews-container');
            reviewsContainer.innerHTML = ''; // Reset konten lama

            if (reviews && reviews.length > 0) {
                reviews.forEach(review => {
                    // Ambil nama user dari relasi, atau default 'Customer'
                    let userName = review.user ? review.user.name : 'Customer';
                    let comment = review.comment ? review.comment : 'Memberikan rating tanpa komentar.';

                    reviewsContainer.innerHTML += `
                        <div class="review-item">
                            <div class="d-flex justify-content-between">
                                <span class="review-user">${userName}</span>
                                <span class="text-warning small"><i class="bi bi-star-fill"></i> ${review.rating}</span>
                            </div>
                            <div class="review-text">"${comment}"</div>
                        </div>`;
                });
            } else {
                reviewsContainer.innerHTML = '<p class="text-white-50 small text-center fst-italic mt-3">Belum ada ulasan.</p>';
            }

            // Tampilkan Modal
            var myModal = new bootstrap.Modal(document.getElementById('barberDetailModal'));
            myModal.show();
        }

        // --- 2. LOGIC SUMMARY BAR ---
        function updateSummary() {
            const summaryBar = document.getElementById('summaryBar');
            const priceLabel = document.getElementById('totalPrice');
            const summaryText = document.getElementById('summaryText');

            const selectedService = document.querySelector('input[name="service_id"]:checked');
            const selectedBarber = document.querySelector('input[name="barber_id"]:checked');
            const selectedTime = document.querySelector('input[name="time"]:checked');
            const selectedDate = document.getElementById('dateInput').value;

            if (selectedService) {
                summaryBar.style.display = 'block';

                // Format Harga
                const price = parseInt(selectedService.getAttribute('data-price'));
                priceLabel.innerText = 'Rp ' + price.toLocaleString('id-ID');

                // Format Teks Ringkasan
                let text = selectedService.getAttribute('data-name');

                if (selectedBarber && selectedBarber.value !== "") {
                    text += ' with ' + selectedBarber.getAttribute('data-name');
                } else {
                    text += ' with Any Barber';
                }

                if (selectedTime && selectedDate) {
                    text += ' at ' + selectedTime.value;
                }

                summaryText.innerText = text;
            }
        }
    </script>
@endpush