@extends('layouts.app')

@section('title', 'Login Member')

@section('content')
<div class="login-container d-flex align-items-center justify-content-center"
    style="min-height: 90vh; padding: 40px 0;">
    <div class="container">
        <div class="row g-0 glass-card shadow-lg overflow-hidden" data-aos="zoom-in">

            <div class="col-md-6 d-none d-md-block position-relative">
                <div
                    style="background: url('{{ asset('images/banner-login.webp') }}') center/cover; height: 100%; width: 100%; filter: grayscale(30%) brightness(0.7);">
                </div>
                <div class="position-absolute top-0 start-0 w-100 h-100"
                    style="background: linear-gradient(to right, rgba(10,10,10,0.9), transparent);"></div>
                <div class="position-absolute top-50 start-50 translate-middle text-center w-75">
                    <img src="{{ $setting->logo_path ?? asset('images/logo.png') }}" class="mb-4"
                        style="width: 130px; filter: drop-shadow(0 0 15px var(--luxury-gold));">
                    <h2 class="display-5 fw-bold text-white mb-2">{{ $setting->app_name ?? 'JARSAN' }}</h2>
                    <p class="text-white opacity-75 letter-spacing-2 small fw-bold">ESTABLISHED 2025</p>
                </div>
            </div>

            <div class="col-md-6 p-5 d-flex flex-column justify-content-center" style="background: var(--matte-black);">
                <div class="mb-5">
                    <h3 class="display-6 fw-bold text-white">AUTHENTICATE</h3>
                    <div style="width: 60px; height: 4px; background: var(--luxury-gold);"></div>
                </div>

                <form action="{{ route('login.process') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-white" style="letter-spacing: 2px;">EMAIL
                            ADDRESS</label>
                        <input type="email" name="email"
                            class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 p-2 px-0"
                            style="box-shadow: none;" placeholder="gentleman@jarsan.com" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-white" style="letter-spacing: 2px;">PRIVATE KEY
                            (PASSWORD)</label>
                        <input type="password" name="password"
                            class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 p-2 px-0"
                            style="box-shadow: none;" placeholder="********" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember">
                            <label class="form-check-label small text-white opacity-75" for="remember">Keep me
                                verified</label>
                        </div>
                        <a href="#" class="small text-white text-decoration-none fw-bold"
                            style="color: var(--luxury-gold) !important;">Forgot Key?</a>
                    </div>

                    <button type="submit" class="btn btn-gold-luxury w-100 py-3 mb-4 fs-5">Initialize Login</button>

                    <a href="{{ route('google.login') }}"
                        class="btn w-100 border border-secondary text-white rounded-0 py-2 d-flex align-items-center justify-content-center gap-2 mb-4">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" width="20">
                        <span class="small fw-bold">CONTINUE WITH GOOGLE</span>
                    </a>

                    <p class="text-center text-white small mt-4">
                        New Member? <a href="{{ route('register') }}"
                            class="fw-bold text-decoration-none border-bottom border-warning"
                            style="color: var(--luxury-gold) !important;">Join the Elite Club</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection