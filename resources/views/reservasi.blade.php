@extends('layouts.app')

@section('title', 'Booking Ritual')

@push('styles')
<style>
:root {
    --metallic-red: #a80017;
    /* Merah Metalik Gelap */
    --bright-red: #dc143c;
    /* Merah Crimson Cerah untuk Hover */
}

/* Background dengan overlay merah tipis */
.bg-red-overlay {
    background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(20, 0, 0, 0.9)),
    url('{{ asset('images/banner-login.webp') }}') center/cover fixed;
}

/* Custom CSS untuk Card */
.glass-card {
    background: rgba(15, 15, 15, 0.9);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(168, 0, 23, 0.3);
    /* Border Merah Tipis */
    box-shadow: 0 0 40px rgba(168, 0, 23, 0.15);
    /* Glow Merah */
}

/* Styling Input */
.form-luxury {
    background-color: transparent !important;
    border: none;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 0;
    color: white !important;
    padding: 12px 0;
    transition: 0.4s;
}

/* Efek Focus menjadi Merah */
.form-luxury:focus {
    background-color: rgba(168, 0, 23, 0.05) !important;
    border-bottom-color: var(--metallic-red);
    box-shadow: none;
    color: white !important;
}

.form-luxury::placeholder {
    color: rgba(255, 255, 255, 0.5) !important;
}

/* Label Styling */
.label-luxury {
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 2px;
    color: var(--metallic-red);
    /* Label berwarna Merah */
    text-transform: uppercase;
}

/* Tombol Merah Metalik */
.btn-red-luxury {
    background: linear-gradient(135deg, var(--metallic-red) 0%, #600000 100%);
    border: 1px solid var(--metallic-red);
    color: white;
    transition: all 0.4s ease;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.btn-red-luxury:hover {
    background: linear-gradient(135deg, var(--bright-red) 0%, var(--metallic-red) 100%);
    box-shadow: 0 0 25px rgba(220, 20, 60, 0.6);
    /* Glow Merah Terang */
    color: white;
    border-color: var(--bright-red);
    transform: translateY(-2px);
}

/* Icon Kalender Putih */
input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
    cursor: pointer;
    opacity: 0.8;
}

input[type="date"]::-webkit-calendar-picker-indicator:hover {
    opacity: 1;
    filter: drop-shadow(0 0 5px red);
}

/* Dropdown Option */
select.form-luxury option {
    background-color: #0a0a0a;
    color: white;
    padding: 10px;
}
</style>
@endpush

@section('content')
<section class="py-5 d-flex align-items-center bg-red-overlay" style="min-height: 90vh;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="glass-card p-4 p-md-5" data-aos="zoom-in" data-aos-duration="1000">

                    <div class="text-center mb-5">
                        <h5 class="fw-bold mb-2" style="color: var(--bright-red); letter-spacing: 3px;">SECURE YOUR SEAT
                        </h5>
                        <h2 class="display-5 fw-bold text-white">BOOK YOUR SLOT</h2>
                        <div class="mx-auto mt-3"
                            style="width: 80px; height: 3px; background: var(--metallic-red); box-shadow: 0 0 10px var(--metallic-red);">
                        </div>
                    </div>

                    @if(session('success'))
                    <div class="alert bg-black border border-danger text-white text-center mb-4 rounded-0 shadow-lg">
                        <i class="bi bi-check-circle-fill me-2 text-danger"></i> {{ session('success') }}
                    </div>
                    @endif

                    <form action="{{ route('reservasi.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="label-luxury mb-2">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control form-luxury"
                                    placeholder="Masukkan nama Anda" value="{{ Auth::user()->name ?? '' }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="label-luxury mb-2">Nomor Telepon</label>
                                <input type="number" name="phone" class="form-control form-luxury"
                                    placeholder="08XXXXXXXXXX" required>
                            </div>

                            <div class="col-md-6">
                                <label class="label-luxury mb-2">Tanggal Ritual</label>
                                <input type="date" name="date" class="form-control form-luxury"
                                    min="{{ date('Y-m-d') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="label-luxury mb-2">Pilih Jam</label>
                                <select name="time" class="form-select form-luxury" required style="cursor: pointer;">
                                    <option value="" selected disabled>-- Pilih Jam --</option>
                                    @php
                                    $start = strtotime('10:00');
                                    $end = strtotime('21:00');
                                    for ($t = $start; $t <= $end; $t +=60 * 60) { $time=date('H:i', $t);
                                        echo "<option value='$time'>$time WIB</option>" ; } @endphp </select>
                            </div>

                            <div class="col-12">
                                <label class="label-luxury mb-2">Pilih Layanan</label>
                                <select name="service_id" class="form-select form-luxury" required>
                                    <option value="" selected disabled>-- Pilih Menu Perawatan --</option>
                                    @foreach($services as $service)
                                    <option value="{{ $service->id }}">
                                        {{ $service->name }} (Rp {{ number_format($service->price, 0, ',', '.') }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="label-luxury mb-2">Catatan Khusus (Opsional)</label>
                                <textarea name="notes" class="form-control form-luxury" rows="2"
                                    placeholder="Contoh: Fade gaya klasik, jangan terlalu pendek"></textarea>
                            </div>

                            <div class="col-12 text-center mt-5">
                                <button type="submit" class="btn btn-red-luxury w-100 py-3 fw-bold fs-6">
                                    KONFIRMASI BOOKING
                                </button>
                                <p class="text-white-50 small mt-3 fst-italic">
                                    <span class="text-danger">*</span> Mohon datang 10 menit sebelum jadwal yang
                                    dipilih.
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection