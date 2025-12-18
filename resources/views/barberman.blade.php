@extends('layouts.app')

@section('title', 'Barberman - Jarsan Barbershop')

@section('content')

    {{-- ================= HERO SECTION ================= --}}
    <section class="hero-barber text-center text-white d-flex align-items-center justify-content-center position-relative"
        style="background: url('{{ asset('images/banner.webp') }}') center/cover no-repeat; height: 70vh;">
        <div class="overlay position-absolute w-100 h-100" style="background: rgba(0,0,0,0.6);"></div>
        <div class="position-relative z-2">
            <h1 class="fw-bold display-5 mb-3 text-warning animate-fade">BARBERMAN JARSAN</h1>
            <p class="lead text-light animate-fade-delay">
                Kenali barber profesional jarsan yang siap memberikan hasil terbaik untuk Anda.
            </p>
        </div>
    </section>

    {{-- ================= TEAM SECTION ================= --}}
    <section class="py-5" style="background-color: #f5f5f5;">
        <div class="container">
            <div class="text-center mb-5">
                <p class="text-muted fs-6">
                    Setiap barber di <strong>Jarsan Barbershop</strong> berpengalaman dan berkomitmen memberikan hasil
                    terbaik.
                </p>
            </div>

            <div class="row g-4 justify-content-center">
                @forelse ($barbers as $barber)
                    @if ($barber->is_active)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="barber-card shadow-sm bg-white rounded-4 overflow-hidden text-center hover-up h-100 p-3">
                                {{-- Foto --}}
                                <div class="barber-photo mb-3">
                                    <img src="{{ $barber->photo_path ? asset('storage/' . $barber->photo_path) : asset('images/default-barber.jpg') }}"
                                        class="rounded-4 shadow-sm" alt="{{ $barber->name }}"
                                        style="width: 100%; max-width: 220px; height: 260px; object-fit: cover;">
                                </div>

                                {{-- Info --}}
                                <h5 class="fw-bold text-dark mb-1">{{ $barber->name }}</h5>
                                <p class="text-warning fw-semibold small mb-2">{{ $barber->specialty ?? 'Spesialis belum diisi' }}
                                </p>

                                @if ($barber->bio)
                                    <p class="text-muted small mb-2">{{ Str::limit($barber->bio, 80) }}</p>
                                @endif

                                <span class="badge bg-success rounded-pill px-3 py-2 mt-2">Aktif</span>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="text-center text-muted">Belum ada barber yang aktif.</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ================= CUSTOM STYLES ================= --}}
    <style>
        /* Animations */
        .animate-fade {
            animation: fadeIn 1s ease-in-out forwards;
            opacity: 0;
        }

        .animate-fade-delay {
            animation: fadeIn 1.5s ease-in-out forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }

            from {
                opacity: 0;
                transform: translateY(20px);
            }
        }

        /* Hover Effect */
        .hover-up {
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .hover-up:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        /* Underline */
        .underline {
            width: 80px;
            height: 4px;
            background-color: #ffc107;
            border-radius: 2px;
        }

        /* Photo styling */
        .barber-photo img {
            transition: all 0.4s ease;
        }

        .barber-photo img:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.2);
        }
    </style>

@endsection