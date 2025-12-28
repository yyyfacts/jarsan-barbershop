@extends('layouts.app')

@section('title', 'Booking Ritual')

@section('content')
<section class="py-5"
    style="min-height: 90vh; background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('{{ asset('images/banner-login.webp') }}') center/cover;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="glass-card p-5" data-aos="zoom-in">
                    <div class="text-center mb-5">
                        <h2 class="display-5 fw-bold text-white">BOOK YOUR SLOT</h2>
                        <div class="mx-auto" style="width: 60px; height: 3px; background: var(--luxury-gold);"></div>
                    </div>

                    @if(session('success'))
                    <div class="alert alert-success bg-success border-0 text-white text-center mb-4 rounded-0">
                        {{ session('success') }}</div>
                    @endif

                    <form action="{{ route('reservasi.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label small text-gold fw-bold">NAMA LENGKAP</label>
                                <input type="text" name="name"
                                    class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 px-0"
                                    placeholder="Gentleman Name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-gold fw-bold">NOMOR TELEPON</label>
                                <input type="text" name="phone"
                                    class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 px-0"
                                    placeholder="08XXXXXXXXXX" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-gold fw-bold">TANGGAL RITUAL</label>
                                <input type="date" name="date"
                                    class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 px-0 invert-calendar"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-gold fw-bold">PILIH JAM</label>
                                <select name="time"
                                    class="form-select bg-transparent border-0 border-bottom border-secondary text-white rounded-0 px-0"
                                    required style="cursor: pointer;">
                                    <option class="bg-dark" value="">-- Pilih Jam --</option>
                                    @php
                                    $start = strtotime('13:00');
                                    $end = strtotime('21:00');
                                    for ($t = $start; $t <= $end; $t +=30 * 60) { $time=date('H:i', $t);
                                        echo "<option class='bg-dark' value='$time'>$time WIB</option>" ; } @endphp
                                        </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small text-gold fw-bold">PILIH LAYANAN</label>
                                <select name="service_id"
                                    class="form-select bg-transparent border-0 border-bottom border-secondary text-white rounded-0 px-0"
                                    required>
                                    <option class="bg-dark" value="">-- Pilih Menu Perawatan --</option>
                                    @foreach($services as $service)
                                    <option class="bg-dark" value="{{ $service->id }}">{{ $service->name }} - Rp
                                        {{ number_format($service->price) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small text-gold fw-bold">CATATAN KHUSUS (OPSIONAL)</label>
                                <textarea name="notes"
                                    class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 px-0"
                                    rows="2" placeholder="Contoh: Fade gaya klasik"></textarea>
                            </div>
                            <div class="col-12 text-center mt-5">
                                <button type="submit" class="btn btn-gold w-100 py-3">KONFIRMASI BOOKING</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Agar ikon kalender berwarna putih di dark mode */
.invert-calendar::-webkit-calendar-picker-indicator {
    filter: invert(1);
    cursor: pointer;
}

.form-control:focus,
.form-select:focus {
    background: transparent;
    border-color: var(--luxury-gold);
    box-shadow: none;
}
</style>
@endsection