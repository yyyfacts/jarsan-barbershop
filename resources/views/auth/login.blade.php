@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 90vh;">
    <div class="container" style="max-width: 1000px;">
        <div class="row g-0 shadow-lg border border-secondary overflow-hidden" data-aos="zoom-in">
            <div class="col-lg-6 d-none d-lg-block position-relative">
                <div
                    style="background: url('{{ asset('images/banner-login.webp') }}') center/cover; height: 100%; filter: brightness(0.4);">
                </div>
                <div class="position-absolute top-50 start-50 translate-middle text-center w-100 px-4">
                    <img src="{{ $setting->logo_path ?? asset('images/logo.png') }}" class="mb-4 rounded-circle"
                        style="width: 120px; border: 2px solid var(--luxury-gold);">
                    <h2 class="display-5 fw-bold text-white">{{ $setting->app_name ?? 'JARSAN' }}</h2>
                    <p class="text-gold letter-spacing-2 fw-bold">AUTHENTICATE GENTLEMEN</p>
                </div>
            </div>
            <div class="col-lg-6 p-5 bg-matte">
                <h3 class="fw-bold text-white mb-4">LOGIN ACCESS</h3>
                <form action="{{ route('login.process') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label fw-bold text-white">EMAIL ADDRESS</label>
                        <input type="email" name="email"
                            class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 px-0"
                            placeholder="gentleman@example.com" required style="box-shadow: none;">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold text-white">PRIVATE KEY (PASSWORD)</label>
                        <input type="password" name="password"
                            class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 px-0"
                            placeholder="••••••••" required style="box-shadow: none;">
                    </div>
                    <button type="submit" class="btn btn-gold-luxury w-100 py-3 mt-4">INITIALIZE LOGIN</button>

                    <p class="text-center text-white mt-5">
                        New Member? <a href="/register" class="text-gold fw-bold text-decoration-none">Create
                            Account</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection