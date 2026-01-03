@extends('layouts.app')

@section('title', 'The Artists - Jarsan')

@section('content')
    @push('styles')
        <style>
            /* --- CARD STYLING --- */
            .barber-card {
                background: #0f0f0f;
                /* Matte Black */
                border: 1px solid rgba(255, 255, 255, 0.1);
                transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
                overflow: hidden;
                position: relative;
            }

            .barber-card:hover {
                border-color: var(--luxury-gold);
                transform: translateY(-10px);
                box-shadow: 0 10px 40px rgba(212, 175, 55, 0.15);
            }

            /* --- IMAGE EFFECT --- */
            .barber-img-container {
                height: 320px;
                position: relative;
                overflow: hidden;
            }

            .barber-img-container img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                filter: grayscale(100%);
                transition: filter 0.5s ease, transform 0.5s ease;
            }

            .barber-card:hover .barber-img-container img {
                filter: grayscale(0%);
                transform: scale(1.05);
            }

            /* --- BADGE SPESIALISASI --- */
            .barber-badge {
                position: absolute;
                top: 20px;
                right: 0;
                background: linear-gradient(90deg, var(--luxury-gold), #b8952b);
                color: #000;
                padding: 5px 15px;
                font-weight: 700;
                font-size: 0.75rem;
                clip-path: polygon(10% 0, 100% 0, 100% 100%, 0% 100%);
                box-shadow: -5px 5px 10px rgba(0, 0, 0, 0.5);
                z-index: 2;
            }

            /* --- JADWAL MINI --- */
            .schedule-box {
                background: rgba(255, 255, 255, 0.05);
                border-radius: 8px;
                padding: 10px;
                margin-top: 15px;
                font-size: 0.8rem;
            }
        </style>
    @endpush

    <section class="py-5 mt-5" style="background-color: #050505;">
        <div class="container py-5 text-center">
            <h5 class="text-gold letter-spacing-5 mb-2 fw-bold" data-aos="fade-down">MEET THE ARTISTS</h5>
            <h2 class="display-4 fw-bold text-white mb-5" style="font-family: 'Playfair Display', serif;"
                data-aos="fade-up">
                MASTER OF <span class="fst-italic text-gold">PRECISION</span>
            </h2>

            <div class="row g-4 justify-content-center">
                @forelse($barbers as $barber)
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="barber-card h-100 rounded-3">

                            {{-- IMAGE CONTAINER --}}
                            <div class="barber-img-container">
                                {{-- Fallback image pakai UI Avatars agar tidak error jika tidak ada foto --}}
                                <img src="{{ $barber->photo_path ?? 'https://ui-avatars.com/api/?name=' . urlencode($barber->name) . '&background=random&size=500' }}"
                                    alt="{{ $barber->name }}">

                                <div class="barber-badge text-uppercase">
                                    {{ $barber->specialty ?? 'Professional' }}
                                </div>
                            </div>

                            {{-- CARD BODY --}}
                            <div class="card-body p-4 text-start">
                                <h4 class="text-white fw-bold mb-1" style="font-family: 'Playfair Display', serif;">
                                    {{ $barber->name }}
                                </h4>

                                {{-- BIO SINGKAT --}}
                                <p class="text-white-50 small mb-3 border-bottom border-secondary pb-3"
                                    style="min-height: 40px;">
                                    {{ Str::limit($barber->bio, 60) ?? 'Expert barber ready to style.' }}
                                </p>

                                {{-- JADWAL HARI INI (PHP Logic) --}}
                                @php
                                    // Mendapatkan hari ini dalam Bahasa Indonesia
                                    $daysMap = [
                                        'Sun' => 'Minggu',
                                        'Mon' => 'Senin',
                                        'Tue' => 'Selasa',
                                        'Wed' => 'Rabu',
                                        'Thu' => 'Kamis',
                                        'Fri' => 'Jumat',
                                        'Sat' => 'Sabtu'
                                    ];
                                    $today = $daysMap[date('D')];
                                    $todaySchedule = $barber->schedule[$today] ?? 'OFF';
                                @endphp

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge bg-dark text-white border border-secondary">
                                        <i class="bi bi-calendar-event me-1 text-gold"></i> {{ $today }}
                                    </span>

                                    @if($todaySchedule && strtoupper($todaySchedule) !== 'OFF')
                                        <span class="text-success small fw-bold">
                                            <i class="bi bi-clock me-1"></i> {{ $todaySchedule }}
                                        </span>
                                    @else
                                        <span class="text-danger small fw-bold">
                                            <i class="bi bi-x-circle me-1"></i> LIBUR
                                        </span>
                                    @endif
                                </div>

                                {{-- TOMBOL BOOKING --}}
                                <a href="{{ route('reservasi') }}" class="btn btn-outline-warning w-100 btn-sm rounded-0">
                                    BOOK NOW
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 py-5">
                        <div class="text-muted fst-italic">
                            <i class="bi bi-info-circle me-2"></i> Belum ada artist yang bergabung.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection