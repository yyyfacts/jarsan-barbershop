@extends('layouts.app')

@section('title', 'Join Elite Club')

@section('content')
<div class="d-flex align-items-center justify-content-center py-5"
    style="min-height: 90vh; background: url('{{ asset('images/banner.webp') }}') center/cover no-repeat fixed;">
    <div class="overlay" style="position: absolute; inset: 0; background: rgba(10,10,10,0.85);"></div>

    <div class="container position-relative z-2" style="max-width: 550px;">
        <div class="glass-card p-5 shadow-lg" data-aos="fade-up" style="border-top: 3px solid var(--luxury-gold);">

            <div class="text-center mb-5">
                @if($setting && $setting->logo_path)
                <img src="{{ $setting->logo_path }}" class="mb-3 rounded-circle"
                    style="width: 80px; border: 2px solid var(--luxury-gold); padding: 3px;">
                @endif
                <h3 class="luxury-font text-white fw-bold mb-2">JOIN THE ELITE</h3>
                <p class="text-white opacity-75 small">Daftar untuk menikmati layanan grooming premium bagi <span
                        class="text-gold fw-bold">Semua Kalangan</span>.</p>
            </div>

            <form action="{{ route('register.process') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 mb-4">
                        <label class="form-label small text-gold fw-bold letter-spacing-2">FULL NAME</label>
                        <input type="text" name="name"
                            class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 ps-0 py-2"
                            placeholder="Nama Lengkap Anda" required>
                    </div>

                    <div class="col-12 mb-4">
                        <label class="form-label small text-gold fw-bold letter-spacing-2">EMAIL ADDRESS</label>
                        <input type="email" name="email"
                            class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 ps-0 py-2"
                            placeholder="contoh@email.com" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label small text-gold fw-bold letter-spacing-2">PASSWORD</label>
                        <input type="password" name="password"
                            class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 ps-0 py-2"
                            placeholder="Min. 8 Karakter" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label small text-gold fw-bold letter-spacing-2">CONFIRM</label>
                        <input type="password" name="password_confirmation"
                            class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 ps-0 py-2"
                            placeholder="Ulangi Password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-gold-luxury w-100 py-3 my-4 fs-6">CREATE MEMBERSHIP</button>

                <div class="text-center">
                    <p class="text-muted small mb-0">Sudah memiliki akun? <a href="{{ route('login') }}"
                            class="text-gold fw-bold text-decoration-none">Login di sini</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection