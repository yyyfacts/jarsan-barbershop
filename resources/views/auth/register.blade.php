@extends('layouts.app')

@section('title', 'Daftar Akun Baru')

@push('styles')
<style>
/* Styling khusus untuk Placeholder agar terlihat di background gelap */
::placeholder {
    color: rgba(255, 255, 255, 0.7) !important;
    opacity: 1;
}

/* Fix warna background autocomplete browser */
input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
input:-webkit-autofill:active {
    -webkit-box-shadow: 0 0 0 30px #121212 inset !important;
    -webkit-text-fill-color: white !important;
    transition: background-color 5000s ease-in-out 0s;
}
</style>
@endpush

@section('content')
<div class="d-flex align-items-center justify-content-center py-5" style="min-height: 90vh;">
    <div class="container">
        <div class="row g-0 shadow-lg rounded-0 overflow-hidden" data-aos="fade-up"
            style="border: 1px solid var(--gold-accent);">

            {{-- BAGIAN KIRI: GAMBAR / BANNER --}}
            <div class="col-lg-6 d-none d-lg-block position-relative">
                <div
                    style="background: url('{{ asset('images/banner-register.webp') }}') center/cover; height: 100%; width: 100%; filter: grayscale(80%) contrast(1.2);">
                    {{-- Jika tidak ada gambar banner-register, bisa ganti pakai banner-login atau warna solid --}}
                </div>
                {{-- Overlay Gradient --}}
                <div class="position-absolute top-0 start-0 w-100 h-100"
                    style="background: linear-gradient(to right, rgba(10,10,10,0.9), rgba(10,10,10,0.3));"></div>

                <div class="position-absolute bottom-0 start-0 p-5 text-white">
                    <h2 class="display-6 fw-bold mb-3">JOIN THE ELITE CLUB</h2>
                    <p class="lead small text-white-50">Daftarkan diri Anda untuk menikmati kemudahan reservasi dan
                        layanan prioritas di {{ $setting->app_name ?? 'Jarsan Barbershop' }}.</p>
                </div>
            </div>

            {{-- BAGIAN KANAN: FORM REGISTRASI --}}
            <div class="col-lg-6 p-5 bg-matte d-flex flex-column justify-content-center">
                <div class="mb-4 text-center text-lg-start">
                    <h3 class="luxury-font text-white fw-bold">CREATE ACCOUNT</h3>
                    <p class="text-white small">Lengkapi data diri Anda untuk memulai.</p>
                </div>

                <form action="{{ route('register.process') }}" method="POST">
                    @csrf

                    {{-- NAMA LENGKAP --}}
                    <div class="mb-3 position-relative">
                        <label class="form-label small text-gold fw-bold letter-spacing-2">FULL NAME</label>
                        <input type="text" name="name"
                            class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 ps-0 py-2"
                            placeholder="Jhon Doe" required>
                        <i class="bi bi-person position-absolute bottom-0 end-0 pb-2 text-white"></i>
                    </div>

                    {{-- EMAIL --}}
                    <div class="mb-3 position-relative">
                        <label class="form-label small text-gold fw-bold letter-spacing-2">EMAIL ADDRESS</label>
                        <input type="email" name="email"
                            class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 ps-0 py-2"
                            placeholder="gentleman@email.com" required>
                        <i class="bi bi-envelope position-absolute bottom-0 end-0 pb-2 text-white"></i>
                    </div>

                    {{-- PASSWORD --}}
                    <div class="mb-3 position-relative">
                        <label class="form-label small text-gold fw-bold letter-spacing-2">PASSWORD</label>
                        <input type="password" name="password"
                            class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 ps-0 py-2"
                            placeholder="Min. 6 characters" required>
                        <i class="bi bi-lock position-absolute bottom-0 end-0 pb-2 text-white"></i>
                    </div>

                    {{-- KONFIRMASI PASSWORD --}}
                    <div class="mb-4 position-relative">
                        <label class="form-label small text-gold fw-bold letter-spacing-2">CONFIRM PASSWORD</label>
                        <input type="password" name="password_confirmation"
                            class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 ps-0 py-2"
                            placeholder="Re-type password" required>
                        <i class="bi bi-check-circle position-absolute bottom-0 end-0 pb-2 text-white"></i>
                    </div>

                    {{-- TOMBOL DAFTAR --}}
                    <button type="submit" class="btn btn-gold-luxury w-100 py-3 mb-4 fs-6">REGISTER NOW</button>

                    <div class="position-relative text-center my-4">
                        <hr class="border-secondary">
                        <span
                            class="position-absolute top-50 start-50 translate-middle px-3 bg-matte text-white small">ATAU
                            DAFTAR DENGAN</span>
                    </div>

                    {{-- GOOGLE LOGIN --}}
                    <a href="{{ route('google.login') }}"
                        class="btn w-100 border border-secondary text-white rounded-0 py-2 d-flex align-items-center justify-content-center gap-3 hover-glass">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" width="20" alt="Google">
                        <span class="small fw-bold letter-spacing-1">GOOGLE ACCOUNT</span>
                    </a>

                    <p class="text-center text-white small mt-4 mb-0">
                        Sudah memiliki akun? <a href="{{ route('login') }}"
                            class="text-gold fw-bold text-decoration-none border-bottom border-warning pb-1">Login di
                            sini</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection