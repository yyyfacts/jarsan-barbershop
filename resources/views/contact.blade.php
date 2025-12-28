@extends('layouts.app')
@section('title', 'Contact Us')
@section('content')
<div class="container py-5 mt-5">
    <div class="row g-5">
        <div class="col-lg-6" data-aos="fade-right">
            <h2 class="display-4 fw-bold text-white mb-5">HUBUNGI KAMI</h2>
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="fw-bold text-gold mb-2">NAMA LENGKAP</label>
                    <input type="text" name="name" class="form-control bg-dark border-warning text-white p-3 rounded-0"
                        placeholder="Nama Anda" required>
                </div>
                <div class="mb-4">
                    <label class="fw-bold text-gold mb-2">EMAIL</label>
                    <input type="email" name="email"
                        class="form-control bg-dark border-warning text-white p-3 rounded-0"
                        placeholder="email@contoh.com" required>
                </div>
                <div class="mb-5">
                    <label class="fw-bold text-gold mb-2">PESAN</label>
                    <textarea name="message" rows="4"
                        class="form-control bg-dark border-warning text-white p-3 rounded-0"
                        placeholder="Apa yang bisa kami bantu?"></textarea>
                </div>
                <button type="submit" class="btn btn-gold-luxury w-100 py-3 fw-bold fs-5">KIRIM PESAN</button>
            </form>
        </div>

        <div class="col-lg-6" data-aos="fade-left">
            <div class="p-4 border border-warning h-100 bg-dark">
                <h4 class="text-gold mb-4 fw-bold">LOKASI & KONTAK</h4>
                <p class="text-white mb-3 fw-bold"><i class="bi bi-geo-alt text-warning me-2"></i> Jl. Jarsan No. 123,
                    Barbershop City</p>
                <p class="text-white mb-3 fw-bold"><i class="bi bi-telephone text-warning me-2"></i> 0882 3256 0561</p>
                <div class="mt-4" style="height: 350px;">
                    <iframe src="https://maps.app.goo.gl/8gQvtK6WFDr4TGLTA?g_st=aw" width="100%" height="100%"
                        style="border:1px solid #D4AF37;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection