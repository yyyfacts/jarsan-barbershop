@extends('layouts.app')

@section('title', 'Login Member')

@push('styles')
<style>
/* Custom style untuk placeholder input agar berwarna putih terang */
::placeholder {
    color: rgba(255, 255, 255, 0.7) !important;
    opacity: 1;
}

/* Input autofill fix untuk background gelap */
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
        <div class="row g-0 shadow-lg rounded-0 overflow-hidden" data-aos="zoom-in"
            style="border: 1px solid var(--gold-accent);">

            {{-- BAGIAN GAMBAR KIRI (Tampilan Tetap Sama) --}}
            <div class="col-lg-6 d-none d-lg-block position-relative">
                <div
                    style="background: url('{{ asset('images/banner-login.webp') }}') center/cover; height: 100%; width: 100%; filter: grayscale(50%) sepia(20%);">
                </div>
                <div class="position-absolute top-0 start-0 w-100 h-100"
                    style="background: linear-gradient(to right, rgba(10,10,10,0.95), rgba(10,10,10,0.4));"></div>
                <div class="position-absolute top-50 start-50 translate-middle text-center w-100 px-4">
                    @if($setting && $setting->logo_path)
                    <img src="{{ $setting->logo_path }}" class="mb-4 rounded-circle"
                        style="width: 120px; border: 3px solid var(--luxury-gold); padding: 5px;">
                    @endif
                    <h2 class="display-5 fw-bold text-white mb-2">{{ $setting->app_name ?? 'JARSAN' }}</h2>
                    <div style="width: 50px; height: 2px; background: var(--luxury-gold); margin: 20px auto;"></div>
                    {{-- Teks diubah jadi lebih standar --}}
                    <p class="text-gold letter-spacing-2 fw-bold">MEMBER LOGIN AREA</p>
                </div>
            </div>

            {{-- BAGIAN FORM KANAN --}}
            <div class="col-lg-6 p-5 bg-matte d-flex flex-column justify-content-center">
                <div class="mb-5">
                    {{-- Judul diganti bahasa Indonesia yang ramah --}}
                    <h3 class="luxury-font text-white fw-bold">SELAMAT DATANG</h3>
                    <p class="text-white small">Silakan masuk dengan akun Anda untuk melanjutkan.</p>
                </div>

                <form action="{{ route('login.process') }}" method="POST">
                    @csrf

                    {{-- Input Email --}}
                    <div class="mb-4 position-relative">
                        <label class="form-label small text-gold fw-bold letter-spacing-2">ALAMAT EMAIL</label>
                        {{-- Placeholder diganti standar --}}
                        <input type="email" name="email"
                            class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 ps-0 py-2"
                            placeholder="nama@email.com" required>
                        <i class="bi bi-envelope position-absolute bottom-0 end-0 pb-2 text-white"></i>
                    </div>

                    {{-- Input Password --}}
                    <div class="mb-4 position-relative">
                        <label class="form-label small text-gold fw-bold letter-spacing-2">PASSWORD</label>
                        {{-- Placeholder diganti dots standar --}}
                        <input type="password" name="password"
                            class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 ps-0 py-2"
                            placeholder="••••••••" required>
                        <i class="bi bi-key position-absolute bottom-0 end-0 pb-2 text-white"></i>
                    </div>

                    {{-- Checkbox & Lupa Password --}}
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <div class="form-check">
                            <input class="form-check-input bg-transparent border-secondary" type="checkbox"
                                id="remember" name="remember">
                            <label class="form-check-label small text-white" for="remember">Ingat Saya</label>
                        </div>
                        <a href="#" class="small text-gold text-decoration-none fw-bold hover-underline">Lupa
                            Password?</a>
                    </div>

                    {{-- Tombol Login --}}
                    <button type="submit" class="btn btn-gold-luxury w-100 py-3 mb-4 fs-6 fw-bold letter-spacing-1">
                        MASUK SEKARANG
                    </button>

                    {{-- Separator --}}
                    <div class="position-relative text-center my-4">
                        <hr class="border-secondary">
                        <span class="position-absolute top-50 start-50 translate-middle px-3 bg-matte text-white small">
                            ATAU MASUK DENGAN
                        </span>
                    </div>

                    {{-- Google Login --}}
                    <a href="{{ route('google.login') }}"
                        class="btn w-100 border border-secondary text-white rounded-0 py-2 d-flex align-items-center justify-content-center gap-3 hover-glass">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" width="20" alt="Google">
                        <span class="small fw-bold letter-spacing-1">AKUN GOOGLE</span>
                    </a>

                    {{-- Link Register --}}
                    <p class="text-center text-white small mt-5 mb-0">
                        Belum punya akun? <a href="{{ route('register') }}"
                            class="text-gold fw-bold text-decoration-none border-bottom border-warning pb-1">
                            Daftar Member Baru
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection