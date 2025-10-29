@extends('layouts.app')

@section('title', 'Price List - Jarsan Barbershop')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-uppercase">Jarsan Barbershop Service</h2>
        <p class="text-muted">Pelayanan terbaik dengan hasil maksimal dan harga bersahabat</p>
    </div>

    <div class="row g-4 justify-content-center">
        <!-- HAIRCUT ONLY -->
        <div class="col-md-4 col-sm-6">
            <div class="card price-card h-100 text-center shadow-sm">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h4 class="fw-bold mb-2 text-uppercase">Haircut Only</h4>
                        <p class="text-muted small">Potongan cepat dan rapi sesuai gaya Anda</p>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mt-3">Rp 20.000</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- PREMIUM HAIRCUT -->
        <div class="col-md-4 col-sm-6">
            <div class="card price-card h-100 text-center shadow-sm">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h4 class="fw-bold mb-2 text-uppercase">Premium Haircut</h4>
                        <p class="text-muted small">Haircut + Keramas + Tonic + Styling</p>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mt-3">Rp 25.000</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- HAIR COLORING -->
        <div class="col-md-4 col-sm-6">
            <div class="card price-card h-100 text-center shadow-sm">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h4 class="fw-bold mb-2 text-uppercase">Hair Coloring</h4>
                        <p class="text-muted small">Pewarnaan rambut dengan produk berkualitas tinggi</p>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mt-3">Rp 150.000</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- CREAMBATH -->
        <div class="col-md-4 col-sm-6">
            <div class="card price-card h-100 text-center shadow-sm">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h4 class="fw-bold mb-2 text-uppercase">Creambath</h4>
                        <p class="text-muted small">Perawatan rambut agar tetap lembut dan sehat</p>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mt-3">Rp 30.000</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- HOME SERVICE -->
        <div class="col-md-4 col-sm-6">
            <div class="card price-card h-100 text-center shadow-sm">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h4 class="fw-bold mb-2 text-uppercase">Home Service</h4>
                        <p class="text-muted small">Layanan panggilan ke rumah sesuai jarak</p>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mt-3">Mulai Rp 40.000</h5>
                        <small class="text-muted">(Harga menyesuaikan jarak)</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .price-card {
        border-radius: 15px;
        border: none;
        background-color: #fff;
        transition: all 0.3s ease;
        padding: 1.5rem;
    }

    .price-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .price-card h4 {
        color: #000;
        letter-spacing: 0.5px;
    }

    .price-card h5 {
        color: #111;
    }

    @media (max-width: 768px) {
        .price-card {
            padding: 1.2rem;
        }
    }
</style>
@endpush
