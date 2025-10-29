<style>
    /* Animasi untuk link di footer */
    .footer-link {
        position: relative;
        display: inline-block;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .footer-link:hover {
        color: #ffffffff; 
        transform: scale(1.1);
    }

    .footer-link:active {
        transform: scale(0.95);
    }

    /* Animasi untuk ikon sosial media */
    .social-icon {
        display: inline-block;
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .social-icon:hover {
        transform: rotate(10deg) scale(1.2);
        color: #25D366;
    }

    /* Efek muncul halus saat di-scroll */
    footer {
        animation: fadeInUp 1s ease forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row align-items-start">

            <!-- Kolom Logo dan Alamat -->
            <div class="col-md-5 mb-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('images/logo jarsan.png') }}" alt="Logo Jarsan" style="height: 55px; width: auto;" class="me-2">
                    <h4 class="fw-bold mb-0">JARSAN BARBERSHOP</h4>
                </div>
                <h6 class="fw-semibold mb-2">Alamat</h6>
                <p class="mb-0">
                    Kayulangit, Sikampuh, Kec. Kroya, <br>
                    Kabupaten Cilacap, Jawa Tengah 53282
                </p>
            </div>

            <!-- Kolom Kontak -->
            <div class="col-md-4 mb-4">
                <h6 class="fw-semibold mb-3">Hubungi Kami</h6>
                <p class="mb-1 d-flex align-items-center">
                    <a href="https://wa.me/6288232560561?text=INFO+BOOKING" target="_blank" class="footer-link">
                    <img src="{{ asset('images/phone-flip.png') }}" alt="Telepon" style="height: 15px; width: 15px;" class="me-2">
                        0882 3256 0561
                    </a>
                </p>
                <p class="mb-2 d-flex align-items-center">
                    <a href="mailto:jarsanbarbershop@gmail.com" target="_blank" class="footer-link">
                    <img src="{{ asset('images/white-envelope.png') }}" alt="email" style="height: 15px; width: 15px;" class="me-2">
                        jarsanbarbershop@gmail.com
                    </a>
                </p>
                <p class="mb-3 d-flex align-items-center">
                    <a href="https://maps.app.goo.gl/nVYHcMvkHizxKMwE8" target="_blank" class="footer-link">
                    <img src="{{ asset('images/marker.png') }}" alt="time" style="height: 15px; width: 15px;" class="me-2">
                        Setiap Hari: 13.00 - 21.00 WIB
                    </a>
                </p>

                <!-- Sosial Media -->
                <div class="mt-3">
                    <a href="https://www.tiktok.com/@jarsan_barbershop" target="_blank" class="text-white me-3 fs-5 social-icon">
                        <i class="fi fi-brands-tik-tok"></i>
                    </a>
                    <a href="https://www.instagram.com/jarsan_barbershop/" target="_blank" class="text-white fs-5 social-icon">
                        <i class="fi fi-brands-instagram"></i>
                    </a>
                </div>
            </div>

            <!-- Kolom Tentang -->
            <div class="col-md-3 mb-4">
                <h6 class="fw-semibold mb-3">Tentang Kami</h6>
                <p style="opacity: 0.85;">
                    Jarsan Barbershop hadir dengan layanan profesional, tempat nyaman, dan potongan rambut modern untuk semua kalangan.
                </p>
            </div>
        </div>

        <!-- Garis bawah -->
        <div class="border-top pt-3 text-center" style="font-size: 0.9rem; opacity: 0.7;">
            &copy; {{ date('Y') }} Jarsan Barbershop. All Rights Reserved.
        </div>
    </div>
</footer>
