@extends('layouts.app')

@section('title', 'Reservasi Online')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-dark text-white text-center py-4">
                    <h3 class="fw-bold mb-0 font-playfair">Formulir Reservasi</h3>
                    <p class="mb-0 small text-white-50">Amankan jadwalmu dalam 30 detik</p>
                </div>
                <div class="card-body p-5 bg-light">

                    <form id="reservasiForm" action="{{-- route('reservasi.store') --}}" method="POST">
                        @csrf
                        <div class="row g-4">
                            {{-- Nama --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="bi bi-person"></i></span>
                                    <input type="text" name="nama" class="form-control border-start-0 ps-0"
                                        placeholder="Contoh: Budi Santoso" required>
                                </div>
                            </div>

                            {{-- No HP --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nomor WhatsApp</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="bi bi-whatsapp"></i></span>
                                    <input type="tel" name="telepon" class="form-control border-start-0 ps-0"
                                        placeholder="0812xxxx" required>
                                </div>
                            </div>

                            {{-- Tanggal --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tanggal Booking</label>
                                <input type="date" name="tanggal" class="form-control" required
                                    min="{{ date('Y-m-d') }}">
                            </div>

                            {{-- Layanan --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Pilih Layanan</label>
                                <select name="layanan" class="form-select" required>
                                    <option value="" selected disabled>-- Pilih Paket --</option>
                                    <option value="Haircut Only">Haircut Only - Rp 20.000</option>
                                    <option value="Premium Cut">Premium Cut - Rp 25.000</option>
                                    <option value="Coloring">Hair Coloring - Rp 150.000</option>
                                    <option value="Home Service">Home Service</option>
                                </select>
                            </div>

                            {{-- JAM BOOKING (Grid System) --}}
                            <div class="col-12">
                                <label class="form-label fw-bold d-block mb-2">Pilih Jam Kedatangan</label>
                                <div class="time-grid">
                                    @foreach (['09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00', '17:00',
                                    '19:00', '20:00'] as $time)
                                    <button type="button" class="time-slot" data-time="{{ $time }}">{{ $time }}</button>
                                    @endforeach
                                    {{-- Input tersembunyi untuk menyimpan jam yang dipilih ke Controller --}}
                                    <input type="hidden" name="jam" id="jam" required>
                                </div>
                                <div id="jam-feedback" class="mt-2 text-primary fw-bold small" style="display: none;">
                                    <i class="bi bi-check-circle-fill"></i> Jam dipilih: <span id="jam-text"></span>
                                </div>
                            </div>

                            {{-- Catatan --}}
                            <div class="col-12">
                                <label class="form-label fw-bold">Catatan Khusus (Opsional)</label>
                                <textarea name="catatan" class="form-control" rows="2"
                                    placeholder="Contoh: Tolong jangan terlalu pendek sampingnya"></textarea>
                            </div>

                            {{-- Tombol --}}
                            <div class="col-12 mt-4">
                                <button type="submit"
                                    class="btn btn-dark w-100 py-3 fw-bold rounded-pill shadow hover-up">
                                    KIRIM RESERVASI <i class="bi bi-send-fill ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.font-playfair {
    font-family: 'Playfair Display', serif;
}

.form-control,
.form-select {
    padding: 0.75rem;
    border-radius: 8px;
}

.input-group-text {
    border-radius: 8px 0 0 8px;
}

.form-control:focus,
.form-select:focus {
    box-shadow: none;
    border-color: #000;
}

/* Time Grid Styling */
.time-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
    gap: 10px;
}

.time-slot {
    background: #fff;
    border: 1px solid #ced4da;
    padding: 10px;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 0.9rem;
}

.time-slot:hover {
    border-color: #000;
    background: #f8f9fa;
}

.time-slot.active {
    background: #000;
    color: #fff;
    border-color: #000;
    transform: scale(1.05);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.hover-up:hover {
    transform: translateY(-3px);
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const timeSlots = document.querySelectorAll('.time-slot');
    const jamInput = document.getElementById('jam');
    const feedbackBox = document.getElementById('jam-feedback');
    const feedbackText = document.getElementById('jam-text');

    timeSlots.forEach(slot => {
        slot.addEventListener('click', function() {
            // Reset semua class active
            timeSlots.forEach(s => s.classList.remove('active'));

            // Tambahkan class active ke yang diklik
            this.classList.add('active');

            // Masukkan nilai ke input hidden
            const val = this.getAttribute('data-time');
            jamInput.value = val;

            // Tampilkan feedback visual
            feedbackBox.style.display = 'block';
            feedbackText.textContent = val;
        });
    });

    // Validasi Form sebelum submit
    document.getElementById('reservasiForm').addEventListener('submit', function(e) {
        if (!jamInput.value) {
            e.preventDefault();
            alert('Mohon pilih jam kedatangan terlebih dahulu!');
            document.querySelector('.time-grid').scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});
</script>
@endpush