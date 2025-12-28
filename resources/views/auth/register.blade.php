@extends('layouts.app')

@section('title', 'Join Jarsan Elite')

@section('content')
<div class="register-container d-flex align-items-center justify-content-center"
    style="min-height: 90vh; padding: 50px 0;">
    <div class="container" style="max-width: 550px;">
        <div class="glass-card p-5 shadow-lg" data-aos="fade-up">
            <div class="text-center mb-5">
                <h3 class="display-6 fw-bold text-white mb-2">JOIN THE ELITE</h3>
                <p class="text-white opacity-75 small">Layanan grooming premium untuk <span class="fw-bold"
                        style="color: var(--luxury-gold)">Semua Kalangan</span>.</p>
                <div class="mx-auto" style="width: 50px; height: 3px; background: var(--luxury-gold);"></div>
            </div>

            <form action="{{ route('register.process') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label small fw-bold text-white">FULL NAME</label>
                    <input type="text" name="name"
                        class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 p-2 px-0"
                        style="box-shadow: none;" placeholder="Your Full Name" required>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-bold text-white">EMAIL ADDRESS</label>
                    <input type="email" name="email"
                        class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 p-2 px-0"
                        style="box-shadow: none;" placeholder="example@email.com" required>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-bold text-white">CREATE PASSWORD</label>
                    <input type="password" name="password"
                        class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 p-2 px-0"
                        style="box-shadow: none;" placeholder="Min. 8 Characters" required>
                </div>

                <div class="mb-5">
                    <label class="form-label small fw-bold text-white">CONFIRM PASSWORD</label>
                    <input type="password" name="password_confirmation"
                        class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 p-2 px-0"
                        style="box-shadow: none;" placeholder="Repeat Password" required>
                </div>

                <button type="submit" class="btn btn-gold-luxury w-100 py-3 mb-4">Create Membership</button>

                <div class="text-center">
                    <p class="text-white small">Sudah menjadi anggota? <a href="{{ route('login') }}"
                            class="fw-bold text-decoration-none" style="color: var(--luxury-gold) !important;">Login di
                            sini</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection