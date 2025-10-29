@extends('layouts.app')

@section('title', 'Reservasi - Jarsan Barbershop')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-uppercase">Reservasi Barbershop</h2>
        <p class="text-muted">Pilih jadwal cukurmu dan nikmati pelayanan terbaik dari barberman kami!</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <form id="reservasiForm" action="#" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" class="form-control p-2" placeholder="Masukkan nama Anda" required>
                        </div>

                        <div class="col-md-6">
                            <label for="telepon" class="form-label">Nomor Telepon</label>
                            <input type="tel" id="telepon" name="telepon" class="form-control p-2" placeholder="08xxxxxxxxxx" required>
                        </div>

                        <div class="col-md-6">
                            <label for="tanggal" class="form-label">Tanggal Reservasi</label>
                            <input type="date" id="tanggal" name="tanggal" class="form-control p-2" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Jam Reservasi</label>
                            <div class="time-grid">
                                @php
                                    $times = [
                                        '09:00', '09:30', '10:00', '10:30',
                                        '11:00', '11:30', '12:00', '12:30',
                                        '13:00', '13:30', '14:00', '14:30',
                                        '15:00', '15:30', '16:00', '16:30', '17:00'
                                    ];
                                @endphp
                                @foreach ($times as $time)
                                    <button type="button" class="time-slot" data-time="{{ $time }}">{{ $time }}</button>
                                @endforeach
                                <input type="hidden" name="jam" id="jam">
                            </div>

                            <!-- ✅ Preview jam yang dipilih -->
                            <div id="jam-terpilih" class="mt-3 text-center text-muted fw-semibold">
                                Belum ada jam yang dipilih
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="layanan" class="form-label">Pilih Layanan</label>
                            <select id="layanan" name="layanan" class="form-select p-2" required>
                                <option value="" selected disabled>-- Pilih Layanan --</option>
                                <option>Haircut Only - Rp 20.000</option>
                                <option>Premium Haircut - Rp 25.000</option>
                                <option>Creambath - Rp 30.000</option>
                                <option>Hair Coloring - Rp 150.000</option>
                                <option>Home Service - Mulai Rp 40.000</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="catatan" class="form-label">Catatan Tambahan (Opsional)</label>
                            <textarea id="catatan" name="catatan" rows="3" class="form-control p-2" placeholder="Tulis permintaan khusus..."></textarea>
                        </div>

                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-dark w-100 py-2 rounded-3">Kirim Reservasi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .time-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
        gap: 10px;
        margin-top: 5px;
    }

    .time-slot {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 10px 0;
        text-align: center;
        background-color: #f8f9fa;
        transition: all 0.25s ease;
        cursor: pointer;
        font-weight: 500;
        user-select: none;
    }

    .time-slot:hover {
        background-color: #000;
        color: #fff;
    }

    .time-slot.selected {
        background-color: #000;
        color: #fff;
        border-color: #000;
        transform: scale(1.05);
        animation: bounce 0.3s ease;
    }

    @keyframes bounce {
        0% { transform: scale(1); }
        50% { transform: scale(1.12); }
        100% { transform: scale(1.05); }
    }

    #jam-terpilih {
        font-size: 0.95rem;
        color: #555;
        transition: color 0.3s ease;
    }

    #jam-terpilih.active {
        color: #000;
    }

    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 10px rgba(0,0,0,0.4);
        border-color: #000;
        transition: all 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #333;
        transform: translateY(-2px);
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const timeButtons = document.querySelectorAll('.time-slot');
    const jamInput = document.getElementById('jam');
    const jamPreview = document.getElementById('jam-terpilih');

    timeButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            // Hapus semua selected
            timeButtons.forEach(btn => btn.classList.remove('selected'));

            // Tambahkan selected ke yang diklik
            this.classList.add('selected');

            // Simpan nilai ke input hidden
            jamInput.value = this.dataset.time;

            // Tampilkan preview
            jamPreview.textContent = `Jam yang dipilih: ${this.dataset.time}`;
            jamPreview.classList.add('active');
        });
    });

    // Validasi sebelum submit
    document.getElementById('reservasiForm').addEventListener('submit', function(e) {
        if (!jamInput.value) {
            e.preventDefault();
            alert('Silakan pilih jam terlebih dahulu!');
        }
    });
});
</script>
@endpush
