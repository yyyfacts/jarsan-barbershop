@extends('layouts.app')
@section('title', 'Booking Slot')
@section('content')
<section class="py-5 mt-5"
    style="background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('{{ asset('images/banner-login.webp') }}') center/cover;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="p-5 border border-warning bg-dark shadow-lg" data-aos="zoom-in">
                    <h2 class="text-center text-gold fw-bold mb-5">BOOK YOUR SESSION</h2>
                    @if(session('success')) <div class="alert alert-success rounded-0 mb-4">{{ session('success') }}
                    </div> @endif

                    <form action="{{ route('reservasi.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="text-gold fw-bold small">NAMA LENGKAP</label>
                                <input type="text" name="name"
                                    class="form-control bg-transparent border-0 border-bottom border-warning text-white p-2 rounded-0"
                                    placeholder="Nama Lengkap" required>
                            </div>
                            <div class="col-12">
                                <label class="text-gold fw-bold small">WHATSAPP</label>
                                <input type="text" name="phone"
                                    class="form-control bg-transparent border-0 border-bottom border-warning text-white p-2 rounded-0"
                                    placeholder="08xxxxxxxx" required>
                            </div>
                            <div class="col-md-6">
                                <label class="text-gold fw-bold small">TANGGAL</label>
                                <input type="date" name="date"
                                    class="form-control bg-transparent border-0 border-bottom border-warning text-white p-2 rounded-0"
                                    style="filter:invert(1);" required>
                            </div>
                            <div class="col-md-6">
                                <label class="text-gold fw-bold small">JAM</label>
                                <select name="time"
                                    class="form-select bg-transparent border-0 border-bottom border-warning text-white p-2 rounded-0">
                                    <option class="bg-dark" value="">-- Pilih --</option>
                                    @php for($i=13; $i<=21; $i++){
                                        echo "<option class='bg-dark' value='$i:00'>$i:00 WIB</option>" ; } @endphp
                                        </select>
                            </div>
                            <div class="col-12">
                                <label class="text-gold fw-bold small">LAYANAN</label>
                                <select name="service_id"
                                    class="form-select bg-transparent border-0 border-bottom border-warning text-white p-2 rounded-0">
                                    <option class="bg-dark" value="">-- Pilih Layanan --</option>
                                    @foreach($services as $s)<option value="{{ $s->id }}" class="bg-dark">{{ $s->name }}
                                        - Rp {{ number_format($s->price) }}</option>@endforeach
                                </select>
                            </div>
                            <div class="col-12 mt-5">
                                <button type="submit" class="btn btn-gold-luxury w-100 py-3 fs-5">CONFIRM
                                    RESERVATION</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection