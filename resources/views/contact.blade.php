@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-uppercase">Hubungi Kami</h2>
        <p class="text-muted">Kami siap membantu Anda! Silakan hubungi kami melalui form atau kunjungi lokasi kami langsung.</p>
    </div>

    <div class="row g-5">
        <!-- Form Kontak -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h4 class="fw-bold mb-4">Kirim Pesan</h4>
                <form action="#" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="form-control p-2" placeholder="Masukkan nama Anda" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control p-2" placeholder="Masukkan email Anda" required>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Pesan</label>
                        <textarea id="message" name="message" rows="4" class="form-control p-2" placeholder="Tulis pesan Anda..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 py-2 rounded-3 btn-kirim">Kirim Pesan</button>
                </form>
            </div>
        </div>

        <!-- Lokasi / Google Maps -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                <div class="card-body p-0">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4732.175253708479!2d109.19451492806346!3d-7.614514466033188!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e654152607c751f%3A0xd2db077bc1144cea!2sJarsan%20Barbershop!5e1!3m2!1sid!2sid!4v1761250591023!5m2!1sid!2sid"
                        width="100%" 
                        height="475" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Kontak -->
    <div class="text-center mt-5">
        <h5 class="fw-bold mb-3">Informasi Kontak</h5>
        <p class="text-muted mb-1">
            <i class="fi fi-sr-phone-flip me-2"></i> 
            <a href="tel:+6281234567890" class="text-decoration-none text-dark">0882 3256 0561</a>
        </p>
        <p class="text-muted">
            <i class="fi fi-sr-envelope me-2"></i>
            <a href="mailto:jarsanbarbershop@gmail.com" class="text-decoration-none text-dark">jarsanbarbershop@gmail.com</a>
        </p>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Efek shadow hitam saat input fokus */
    .form-control:focus {
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.6);
        border-color: #000;
        outline: none;
        transition: all 0.3s ease;
    }

    iframe {
        border-radius: 15px;
    }

    /* Tombol elegan dengan efek hover */
    .btn-kirim {
        background-color: #000;
        color: white;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .btn-kirim:hover {
        background-color: #ffffff;
        color: #000;
        border: 1px solid #000;
        transform: scale(1.03);
    }
</style>
@endpush
