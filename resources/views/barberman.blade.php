@extends('layouts.app')

@section('title', 'Tim Kami')

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h5 class="text-primary text-uppercase fw-bold ls-2">The Team</h5>
            <h2 class="fw-bold font-playfair display-5">Meet Our Masters</h2>
            <p class="text-muted mt-2">Para ahli cukur yang siap mengubah penampilan Anda.</p>
        </div>

        <div class="row g-4 justify-content-center">
            {{-- DATA BARBERS (PHP ARRAY) --}}
            @php
            $barbers = [
            ['id' => 1, 'name' => 'Rizky', 'role' => 'Master Barber', 'img' => 'barber1.jpg', 'bio' => 'Rizky adalah
            barber senior dengan spesialisasi fade dan taper modern. 6 tahun pengalaman menjamin kepuasan.'],
            ['id' => 2, 'name' => 'Agus', 'role' => 'Classic Specialist', 'img' => 'barber2.jpg', 'bio' => 'Agus
            memiliki tangan emas untuk potongan klasik seperti Pompadour dan Side Part. Favorit gentleman sejati.'],
            ['id' => 3, 'name' => 'Fahri', 'role' => 'Color & Style Expert', 'img' => 'barber3.jpg', 'bio' => 'Fahri
            adalah seniman warna. Ingin warna silver, ash grey, atau highlight? Fahri ahlinya.'],
            ['id' => 4, 'name' => 'Rian', 'role' => 'Beard Groomer', 'img' => 'barber4.jpg', 'bio' => 'Spesialis janggut
            dan kumis. Rian tahu cara membentuk framing wajah yang maskulin dan rapi.']
            ];
            @endphp

            @foreach ($barbers as $barber)
            <div class="col-md-3 col-sm-6">
                <div class="card barber-card border-0 shadow-sm h-100 text-center position-relative"
                    onclick="showBio({{ $barber['id'] }})" role="button">
                    <div class="card-img-wrapper overflow-hidden">
                        {{-- Gunakan asset() untuk gambar --}}
                        <img src="{{ asset('images/' . $barber['img']) }}" class="card-img-top"
                            alt="{{ $barber['name'] }}">
                        <div class="overlay-hover d-flex align-items-center justify-content-center">
                            <span class="text-white fw-bold">Lihat Profil <i class="bi bi-eye"></i></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="fw-bold mb-1">{{ $barber['name'] }}</h4>
                        <p class="text-primary small fw-bold mb-0">{{ $barber['role'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- AREA BIODATA (HIDDEN BY DEFAULT) --}}
        <div id="barberBio" class="barber-bio mt-5" style="display: none; opacity: 0; transition: opacity 0.5s ease;">
            <div class="card border-0 shadow-lg p-5 mx-auto rounded-4" style="max-width: 800px; background: #fff;">
                <div class="row align-items-center">
                    <div class="col-md-4 text-center">
                        <img id="bioImg" src="" alt="Foto Barber" class="rounded-circle shadow mb-3 mb-md-0" width="180"
                            height="180" style="object-fit: cover; border: 5px solid #f8f9fa;">
                    </div>
                    <div class="col-md-8 text-center text-md-start">
                        <h3 id="bioName" class="fw-bold font-playfair display-6 mb-1"></h3>
                        <span id="bioRole" class="badge bg-dark text-uppercase mb-3 px-3 py-2"></span>
                        <p id="bioDesc" class="text-muted fs-5 lh-lg"></p>
                        <a href="{{ url('/reservasi') }}" class="btn btn-outline-dark rounded-pill mt-2 px-4">Booking
                            <span id="btnName"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.font-playfair {
    font-family: 'Playfair Display', serif;
}

.ls-2 {
    letter-spacing: 2px;
}

.barber-card {
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.barber-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
}

.card-img-wrapper {
    position: relative;
}

.overlay-hover {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    opacity: 0;
    transition: 0.3s;
}

.barber-card:hover .overlay-hover {
    opacity: 1;
}

.barber-card img {
    height: 350px;
    object-fit: cover;
    transition: 0.5s;
}

.barber-card:hover img {
    transform: scale(1.05);
}
</style>
@endpush

@push('scripts')
<script>
// Data barbers untuk JS (Harus sinkron dengan PHP di atas)
const barbers = {
    1: {
        name: 'Rizky',
        role: 'Master Barber',
        img: '{{ asset("images/barber1.jpg") }}',
        bio: 'Rizky adalah barber senior dengan spesialisasi fade dan taper modern. 6 tahun pengalaman menjamin kepuasan.'
    },
    2: {
        name: 'Agus',
        role: 'Classic Specialist',
        img: '{{ asset("images/barber2.jpg") }}',
        bio: 'Agus memiliki tangan emas untuk potongan klasik seperti Pompadour dan Side Part. Favorit gentleman sejati.'
    },
    3: {
        name: 'Fahri',
        role: 'Color & Style Expert',
        img: '{{ asset("images/barber3.jpg") }}',
        bio: 'Fahri adalah seniman warna. Ingin warna silver, ash grey, atau highlight? Fahri ahlinya.'
    },
    4: {
        name: 'Rian',
        role: 'Beard Groomer',
        img: '{{ asset("images/barber4.jpg") }}',
        bio: 'Spesialis janggut dan kumis. Rian tahu cara membentuk framing wajah yang maskulin dan rapi.'
    }
};

function showBio(id) {
    const barber = barbers[id];
    const bioSection = document.getElementById('barberBio');

    if (barber) {
        // Efek fade out dulu jika sedang tampil
        bioSection.style.opacity = '0';

        setTimeout(() => {
            document.getElementById('bioImg').src = barber.img;
            document.getElementById('bioName').textContent = barber.name;
            document.getElementById('bioRole').textContent = barber.role;
            document.getElementById('bioDesc').textContent = barber.bio;
            document.getElementById('btnName').textContent = barber.name;

            bioSection.style.display = 'block';

            // Fade in animation
            setTimeout(() => {
                bioSection.style.opacity = '1';
                bioSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }, 50);
        }, 300);
    }
}
</script>
@endpush