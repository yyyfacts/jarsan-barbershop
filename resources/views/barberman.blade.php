@extends('layouts.app')

@section('title', 'The Artists - Jarsan')

@section('content')
<style>
.barber-card {
    background: var(--matte-black);
    border: 1px solid rgba(255, 255, 255, 0.05);
    transition: 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
    overflow: hidden;
}

.barber-card:hover {
    border-color: var(--luxury-gold);
    transform: translateY(-10px);
    box-shadow: 0 10px 40px rgba(212, 175, 55, 0.1);
}

.barber-img-container {
    position: relative;
    filter: grayscale(100%);
    transition: 0.5s;
}

.barber-card:hover .barber-img-container {
    filter: grayscale(0%);
}

.barber-badge {
    position: absolute;
    bottom: 0;
    left: 0;
    background: var(--luxury-gold);
    color: #000;
    padding: 5px 20px;
    font-weight: 700;
    font-size: 0.7rem;
}
</style>

<section class="py-5 mt-5">
    <div class="container py-5 text-center">
        <h5 class="text-gold letter-spacing-5 mb-2" data-aos="fade-down">MEET THE ARTISTS</h5>
        <h2 class="display-3 fw-bold text-white mb-5" data-aos="fade-up">DIBALIK PRESISI</h2>

        <div class="row g-4 justify-content-center">
            @forelse($barbers as $barber)
            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="barber-card h-100">
                    <div class="barber-img-container" style="height: 350px;">
                        <img src="{{ $barber->photo_path ?? asset('images/default-barber.jpg') }}"
                            class="w-100 h-100 object-fit-cover">
                        <div class="barber-badge text-uppercase">{{ $barber->specialty ?? 'Senior Barber' }}</div>
                    </div>
                    <div class="card-body p-4">
                        <h4 class="text-white fw-bold mb-2">{{ $barber->name }}</h4>
                        <p class="text-muted small lh-base">
                            {{ $barber->bio ?? 'Siap memberikan potongan rambut terbaik untuk Anda.' }}
                        </p>
                        <div class="mt-4 d-flex justify-content-center gap-3">
                            <a href="#" class="text-gold"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="text-gold"><i class="bi bi-twitter-x"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Belum ada tim barber yang ditambahkan.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection