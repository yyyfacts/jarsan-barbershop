@extends('layouts.app')

@section('title', 'Barberman')

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="fw-bold text-center mb-5 text-uppercase">Tim Barber Profesional Kami</h2>

        <div class="row g-4 justify-content-center">
            {{-- Barber Cards --}}
            @php
                $barbers = [
                    ['id' => 1, 'name' => 'Rizky', 'role' => 'Ahli Fade & Modern Style', 'img' => 'barber1.jpg',
                    'bio' => 'Rizky adalah barber berpengalaman dengan spesialisasi fade dan taper modern. Dengan 6 tahun pengalaman, ia memastikan potongan rapi dan detail sempurna.'],

                    ['id' => 2, 'name' => 'Agus', 'role' => 'Specialist Classic Cut', 'img' => 'barber2.jpg',
                    'bio' => 'Agus memiliki kemampuan unik dalam menciptakan potongan klasik elegan. Dengan ketelitian dan rasa seni tinggi, ia jadi favorit pelanggan senior.'],

                    ['id' => 3, 'name' => 'Fahri', 'role' => 'Expert Styling & Coloring', 'img' => 'barber3.jpg',
                    'bio' => 'Fahri unggul dalam pewarnaan rambut dan styling modern. Keahliannya membawa tren terkini ke setiap klien.'],

                    ['id' => 4, 'name' => 'Rian', 'role' => 'Beard Specialist', 'img' => 'barber4.jpg',
                    'bio' => 'Rian adalah spesialis janggut dan kumis. Ia tahu cara membentuk tampilan maskulin yang tetap rapi dan stylish.']
                ];
            @endphp

            @foreach ($barbers as $barber)
            <div class="col-md-3 col-sm-6">
                <div 
                    class="card barber-card border-0 shadow text-center h-100"
                    onclick="showBio({{ $barber['id'] }})"
                    style="cursor: pointer;"
                >
                    <img src="{{ asset('images/' . $barber['img']) }}" class="card-img-top" alt="{{ $barber['name'] }}">
                    <div class="card-body">
                        <h5 class="fw-bold mb-1">{{ $barber['name'] }}</h5>
                        <p class="text-muted mb-2">{{ $barber['role'] }}</p>
                        <i class="bi bi-chevron-down text-secondary arrow-down"></i>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Biodata Section --}}
        <div id="barberBio" class="barber-bio text-center mt-5" style="display: none;">
            <div class="card border-0 shadow-lg p-4 mx-auto" style="max-width: 700px;">
                <img id="bioImg" src="" alt="Foto Barber" class="rounded-circle mb-3" width="150" height="150" style="object-fit: cover;">
                <h4 id="bioName" class="fw-bold mb-1"></h4>
                <h6 id="bioRole" class="text-muted mb-3"></h6>
                <p id="bioDesc" class="text-secondary px-3"></p>
                <a href="#" class="btn btn-dark rounded-pill px-4 mt-2">Reservasi</a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
/* Kartu barber */
.barber-card {
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
    background: #fff;
}
.barber-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}
.barber-card img {
    height: 300px;
    object-fit: cover;
    transition: transform 0.4s ease;
}
.barber-card:hover img {
    transform: scale(1.05);
}

/* Panah bawah */
.arrow-down {
    display: inline-block;
    margin-top: 8px;
    font-size: 1.2rem;
    transition: transform 0.3s ease;
}
.barber-card:hover .arrow-down {
    transform: translateY(4px);
    color: #000;
}

/* Biodata */
.barber-bio img {
    border: 4px solid #222;
    transition: all 0.4s ease;
}
.barber-bio .card {
    background: #fff;
    border-radius: 20px;
}
</style>
@endpush

@push('scripts')
<script>
const barbers = {
    1: {
        name: 'Rizky',
        role: 'Ahli Fade & Modern Style',
        img: '{{ asset("images/barber1.jpg") }}',
        bio: 'Rizky adalah barber berpengalaman dengan spesialisasi fade dan taper modern. Dengan 6 tahun pengalaman, ia memastikan potongan rapi dan detail sempurna.'
    },
    2: {
        name: 'Agus',
        role: 'Specialist Classic Cut',
        img: '{{ asset("images/barber2.jpg") }}',
        bio: 'Agus memiliki kemampuan unik dalam menciptakan potongan klasik elegan. Dengan ketelitian dan rasa seni tinggi, ia jadi favorit pelanggan senior.'
    },
    3: {
        name: 'Fahri',
        role: 'Expert Styling & Coloring',
        img: '{{ asset("images/barber3.jpg") }}',
        bio: 'Fahri unggul dalam pewarnaan rambut dan styling modern. Keahliannya membawa tren terkini ke setiap klien.'
    },
    4: {
        name: 'Rian',
        role: 'Beard Specialist',
        img: '{{ asset("images/barber4.jpg") }}',
        bio: 'Rian adalah spesialis janggut dan kumis. Ia tahu cara membentuk tampilan maskulin yang tetap rapi dan stylish.'
    }
};

function showBio(id) {
    const barber = barbers[id];
    if (barber) {
        document.getElementById('barberBio').style.display = 'block';
        document.getElementById('bioImg').src = barber.img;
        document.getElementById('bioName').textContent = barber.name;
        document.getElementById('bioRole').textContent = barber.role;
        document.getElementById('bioDesc').textContent = barber.bio;
        document.getElementById('barberBio').scrollIntoView({ behavior: 'smooth' });
    }
}
</script>
@endpush
