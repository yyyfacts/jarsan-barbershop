@extends('layouts.app')
@section('title', 'Master Barbers')
@section('content')
<section class="py-5 mt-5">
    <div class="container py-5 text-center">
        <h2 class="display-3 fw-bold text-white mb-5" data-aos="fade-up">MEET THE ARTISTS</h2>
        <div class="row g-4 justify-content-center">
            @foreach($barbers as $barber)
            <div class="col-lg-3 col-md-6" data-aos="zoom-in">
                <div class="border border-secondary bg-dark shadow-lg h-100">
                    <div style="height: 350px; overflow: hidden;">
                        <img src="{{ $barber->photo_path }}" class="w-100 h-100 object-fit-cover" style="filter: none;">
                    </div>
                    <div class="p-4">
                        <h4 class="text-white fw-bold mb-1">{{ $barber->name }}</h4>
                        <span class="badge bg-warning text-dark mb-3 px-3">{{ $barber->specialty }}</span>
                        <p class="text-white opacity-100 small">
                            {{ $barber->bio ?? 'Siap memberikan pengerjaan terbaik.' }}</p>
                        <div class="mt-3 d-flex justify-content-center gap-3">
                            <i class="bi bi-instagram text-gold fs-5"></i>
                            <i class="bi bi-twitter-x text-gold fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection