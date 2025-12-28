@extends('layouts.app')
@section('title', 'Service Menu')
@section('content')
<section class="py-5 mt-5">
    <div class="container py-5">
        <h2 class="display-3 fw-bold text-white text-center mb-5" data-aos="fade-up">EXCLUSIVE SERVICES</h2>
        <div class="row g-4 justify-content-center">
            @foreach ($services as $service)
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="p-0 border border-secondary bg-dark h-100 shadow-lg position-relative">
                    <div style="height: 230px; overflow: hidden;">
                        <img src="{{ $service->image_path }}" class="w-100 h-100 object-fit-cover">
                    </div>
                    <div class="p-4">
                        <div class="mb-2"><span
                                class="badge border border-warning text-gold bg-transparent">{{ $service->duration_minutes }}
                                MINS</span></div>
                        <h4 class="text-white fw-bold mb-2">{{ $service->name }}</h4>
                        <p class="text-white small mb-3 opacity-100">{{ $service->description }}</p>
                        <h3 class="text-gold fw-bold">Rp {{ number_format($service->price) }}</h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection