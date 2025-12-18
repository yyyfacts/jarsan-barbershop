@extends('layouts.app')

@section('title', 'Daftar Harga')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h5 class="text-uppercase text-primary fw-bold">Best Value</h5>
        <h2 class="fw-bold display-5 font-playfair">Daftar Harga Layanan</h2>
        <p class="text-muted">Kualitas premium dengan harga yang bersahabat.</p>
    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-lg-3 col-md-6">
            <div class="card price-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                    <div class="icon-box mb-3 text-primary">
                        <i class="bi bi-scissors fs-1"></i>
                    </div>
                    <h5 class="fw-bold text-uppercase">Haircut Only</h5>
                    <hr class="mx-auto" style="width: 50px; border-color: #333;">
                    <p class="text-muted small">Potongan rambut presisi, finishing rapi, tanpa keramas.</p>
                    <h3 class="fw-bold mt-4">Rp 20.000</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card price-card h-100 shadow border-primary border-2 position-relative transform-scale">
                <div class="position-absolute top-0 start-50 translate-middle">
                    <span class="badge bg-primary rounded-pill px-3 py-2 shadow">BEST SELLER</span>
                </div>
                <div class="card-body text-center p-4 bg-light">
                    <div class="icon-box mb-3 text-dark">
                        <i class="bi bi-stars fs-1"></i>
                    </div>
                    <h5 class="fw-bold text-uppercase text-dark">Premium Cut</h5>
                    <hr class="mx-auto" style="width: 50px; border-color: #333;">
                    <p class="text-muted small">Haircut + Keramas + Pijat Kepala + Hair Tonic + Styling Pomade.</p>
                    <h3 class="fw-bold mt-4 text-primary">Rp 25.000</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card price-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                    <div class="icon-box mb-3 text-primary">
                        <i class="bi bi-palette fs-1"></i>
                    </div>
                    <h5 class="fw-bold text-uppercase">Hair Coloring</h5>
                    <hr class="mx-auto" style="width: 50px; border-color: #333;">
                    <p class="text-muted small">Pewarnaan profesional (Basic Color / Bleaching / Highlight).</p>
                    <h3 class="fw-bold mt-4">Rp 150.000+</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card price-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                    <div class="icon-box mb-3 text-primary">
                        <i class="bi bi-house-door fs-1"></i>
                    </div>
                    <h5 class="fw-bold text-uppercase">Home Service</h5>
                    <hr class="mx-auto" style="width: 50px; border-color: #333;">
                    <p class="text-muted small">Malas keluar? Kami datang ke rumah Anda. (Sesuai jarak).</p>
                    <h3 class="fw-bold mt-4">Rp 40.000+</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="{{ url('/reservasi') }}" class="btn btn-dark rounded-pill px-5 py-3 fw-bold">Booking Jadwal
            Sekarang</a>
    </div>
</div>
@endsection

@push('styles')
<style>
.font-playfair {
    font-family: 'Playfair Display', serif;
}

.price-card {
    transition: all 0.3s;
    border-radius: 15px;
}

.price-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
}

.transform-scale {
    transform: scale(1.05);
    z-index: 2;
}

@media (max-width: 768px) {
    .transform-scale {
        transform: scale(1);
        margin-bottom: 20px;
    }
}
</style>
@endpush