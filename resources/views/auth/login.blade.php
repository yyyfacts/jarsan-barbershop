@extends('layouts.app')

@section('title', 'Login Member')

@section('content')
<div class="d-flex align-items-center justify-content-center py-5" style="min-height: 90vh;">
    <div class="container">
        <div class="row g-0 shadow-lg rounded-0 overflow-hidden" data-aos="zoom-in"
            style="border: 1px solid var(--gold-accent);">

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
                    <p class="text-gold letter-spacing-2 fw-bold">PREMIUM MEMBER ACCESS</p>
                </div>
            </div>

            <div class="col-lg-6 p-5 bg-matte d-flex flex-column justify-content-center">
                <div class="mb-5">
                    <h3 class="luxury-font text-white fw-bold">AUTHENTICATE</h3>
                    <p class="text-muted small">Silakan masuk untuk mengakses layanan premium.</p>
                </div>

                <form action="{{ route('login.process') }}" method="POST">
                    @csrf
                    <div class="mb-4 position-relative">
                        <label class="form-label small text-gold fw-bold letter-spacing-2">EMAIL ADDRESS</label>
                        <input type="email" name="email"
                            class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 ps-0 py-2"
                            placeholder="gentleman@example.com" required>
                        <i class="bi bi-envelope position-absolute bottom-0 end-0 pb-2 text-muted"></i>
                    </div>

                    <div class="mb-4 position-relative">
                        <label class="form-label small text-gold fw-bold letter-spacing-2">PRIVATE KEY
                            (PASSWORD)</label>
                        <input type="password" name="password"
                            class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 ps-0 py-2"
                            placeholder="••••••••" required>
                        <i class="bi bi-key position-absolute bottom-0 end-0 pb-2 text-muted"></i>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <div class="form-check">
                            <input class="form-check-input bg-transparent border-secondary" type="checkbox"
                                id="remember" name="remember">
                            <label class="form-check-label small text-muted" for="remember">Ingat Saya</label>
                        </div>
                        <a href="#" class="small text-gold text-decoration-none fw-bold hover-underline">Lupa
                            Password?</a>
                    </div>

                    <button type="submit" class="btn btn-gold-luxury w-100 py-3 mb-4 fs-6">INITIALIZE LOGIN</button>

                    <div class="position-relative text-center my-4">
                        <hr class="border-secondary">
                        <span
                            class="position-absolute top-50 start-50 translate-middle px-3 bg-matte text-muted small">ATAU
                            AKSES DENGAN</span>
                    </div>

                    <a href="{{ route('google.login') }}"
                        class="btn w-100 border border-secondary text-white rounded-0 py-2 d-flex align-items-center justify-content-center gap-3 hover-glass">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" width="20" alt="Google">
                        <span class="small fw-bold letter-spacing-1">GOOGLE ACCOUNT</span>
                    </a>

                    <p class="text-center text-muted small mt-5 mb-0">
                        Belum menjadi anggota? <a href="{{ route('register') }}"
                            class="text-gold fw-bold text-decoration-none border-bottom border-warning pb-1">Daftar
                            Elite Club</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection