@extends('layouts.app')

@section('title', 'Hubungi Kami')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h5 class="text-uppercase text-primary fw-bold">Get In Touch</h5>
        <h2 class="fw-bold display-5 font-playfair">Hubungi Kami</h2>
        <p class="text-muted">Punya pertanyaan atau saran? Kami siap mendengar.</p>
    </div>

    <div class="row g-5">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-4">
                <h4 class="fw-bold mb-4"><i class="bi bi-envelope-paper me-2"></i> Kirim Pesan</h4>
                <form action="#" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Anda</label>
                        <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email / WhatsApp</label>
                        <input type="text" name="contact" class="form-control" placeholder="Email atau No WA" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pesan</label>
                        <textarea name="message" rows="5" class="form-control" placeholder="Tulis pesan Anda di sini..."
                            required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-bold">KIRIM PESAN</button>
                </form>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                <div class="bg-dark text-white p-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-geo-alt fs-3 me-3 text-primary"></i>
                        <div>
                            <h6 class="fw-bold mb-0">Lokasi Studio</h6>
                            <small>Jl. Raya Kampus No. 123, Purwokerto</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-whatsapp fs-3 me-3 text-success"></i>
                        <div>
                            <h6 class="fw-bold mb-0">WhatsApp</h6>
                            <small>0882-3256-0561</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-instagram fs-3 me-3 text-danger"></i>
                        <div>
                            <h6 class="fw-bold mb-0">Instagram</h6>
                            <small>@jarsan.barbershop</small>
                        </div>
                    </div>
                </div>

                <div class="map-container flex-grow-1">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.270928733238!2d109.247!3d-7.424!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMjUnMjYuNCJTIDEwOcKwMTQnNDkuMiJF!5e0!3m2!1sen!2sid!4v1620000000000!5m2!1sen!2sid"
                        width="100%" height="100%" style="border:0; min-height: 350px;" allowfullscreen=""
                        loading="lazy">
                    </iframe>
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

.form-control:focus {
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    border-color: #0d6efd;
}
</style>
@endpush