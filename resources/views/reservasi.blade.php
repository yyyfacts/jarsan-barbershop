@extends('layouts.app')

@section('title', 'Reservasi - Jarsan Barbershop')

@section('content')
<section class="py-5 bg-white">
    <div class="container text-dark">
        <h2 class="fw-bold text-center mb-4">Formulir Reservasi</h2>
        <p class="text-center text-muted mb-5">
            Isi data berikut untuk melakukan reservasi di Jarsan Barbershop
        </p>

        {{-- Pesan sukses setelah reservasi berhasil --}}
        @if(session('success'))
        <div class="alert alert-success text-center fw-semibold shadow-sm rounded-3">
            ✅ {{ session('success') }}
        </div>
        @endif

        <div class="d-flex justify-content-center">
            <div class="card shadow-lg border-0 rounded-4 p-4" style="max-width: 650px; width: 100%;">
                <form action="{{ url('/reservasi') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Masukkan nama Anda" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label fw-semibold">Nomor Telepon</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="08xxxxxxxxxx"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label for="date" class="form-label fw-semibold">Tanggal Reservasi</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="time" class="form-label fw-semibold">Jam Reservasi</label>
                            <select name="time" id="time" class="form-select" required>
                                <option value="">-- Pilih Jam --</option>
                                {{-- Buat jam dari 13:00 - 21:00 setiap 30 menit --}}
                                @php
                                $start = strtotime('13:00');
                                $end = strtotime('21:00');
                                for ($t = $start; $t <= $end; $t +=30 * 60) { $time=date('H:i', $t);
                                    echo "<option value='$time'>$time</option>" ; } @endphp </select>
                        </div>

                        <div class="col-12">
                            <label for="service_id" class="form-label fw-semibold">Pilih Layanan</label>
                            <select name="service_id" id="service_id" class="form-select" required>
                                <option value="">-- Pilih Layanan --</option>
                                @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }} - Rp
                                    {{ number_format($service->price, 0, ',', '.') }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="notes" class="form-label fw-semibold">Catatan Tambahan (Opsional)</label>
                            <textarea name="notes" id="notes" class="form-control" rows="3"
                                placeholder="Tulis permintaan khusus..."></textarea>
                        </div>

                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-dark px-5 py-2 fw-semibold rounded-pill">
                                Kirim Reservasi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection