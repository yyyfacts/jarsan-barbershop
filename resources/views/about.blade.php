@extends('layouts.app')
@section('title', 'About Our Legacy')
@section('content')
<section class="py-5 mt-5">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="border border-warning p-3">
                    <img src="{{ $about->history_image ?? asset('images/banner.webp') }}" class="img-fluid"
                        style="filter: none;">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <h2 class="display-4 fw-bold text-gold mb-4">OUR HERITAGE</h2>
                <p class="fs-5 text-white lh-lg">
                    {{ $about->history ?? 'Membangun kepercayaan diri melalui presisi potong rambut sejak berdirinya Jarsan Barbershop.' }}
                </p>
                <div class="bg-dark p-4 border-start border-warning mt-4">
                    <h4 class="text-gold fw-bold">MISI KAMI</h4>
                    <p class="text-white mb-0">
                        {{ $about->mission ?? 'Melayani semua kalangan dengan kualitas eksekutif.' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection