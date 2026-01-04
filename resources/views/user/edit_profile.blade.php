@extends('layouts.app')

@section('title', 'Ubah Profil')

@section('content')
<div class="container py-5" style="margin-top: 80px; min-height: 80vh;">
    <div class="row justify-content-center">
        <div class="col-md-6" data-aos="fade-up">

            <div class="p-5 rounded-0 bg-matte border border-secondary shadow-lg position-relative">
                <h3 class="luxury-font text-white fw-bold mb-4 text-center">UBAH PROFIL</h3>

                {{-- Alert Sukses --}}
                @if(session('success'))
                <div class="alert alert-success bg-opacity-25 bg-success text-white border-0 mb-4 rounded-0">
                    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                </div>
                @endif

                {{-- Menampilkan Error Validasi (Penting agar tahu kenapa error) --}}
                @if ($errors->any())
                <div class="alert alert-danger bg-opacity-25 bg-danger text-white border-0 mb-4 rounded-0">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- PREVIEW FOTO --}}
                    <div class="text-center mb-4">
                        <div class="d-inline-block position-relative">
                            {{-- Logic Gambar: Cek BLOB/Path dulu --}}
                            <img src="{{ Auth::user()->avatar_blob ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=D4AF37&color=000' }}"
                                class="rounded-circle border border-warning p-1 shadow"
                                style="width: 130px; height: 130px; object-fit: cover;" id="avatarPreview">

                            <label for="avatarInput"
                                class="position-absolute bottom-0 end-0 text-dark rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                style="cursor: pointer; background: #D4AF37; width: 40px; height: 40px; border: 3px solid #0a0a0a;">
                                <i class="bi bi-camera-fill"></i>
                            </label>
                        </div>
                        <p class="text-white-50 small mt-3">Klik ikon kamera untuk mengganti foto</p>
                    </div>

                    {{-- INPUT FILE HIDDEN --}}
                    <input type="file" name="avatar" id="avatarInput" class="d-none"
                        accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event)">

                    {{-- INPUT NAMA --}}
                    <div class="mb-4">
                        <label class="small text-gold fw-bold letter-spacing-2 text-uppercase">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                            class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 ps-0 py-2 focus-gold"
                            required>
                    </div>

                    {{-- INPUT EMAIL (READONLY) --}}
                    <div class="mb-5">
                        <label class="small text-gold fw-bold letter-spacing-2 text-uppercase">Email (Tidak dapat
                            diubah)</label>
                        <input type="text" value="{{ Auth::user()->email }}"
                            class="form-control bg-transparent border-0 border-bottom border-secondary text-white-50 rounded-0 ps-0 py-2"
                            readonly disabled>
                    </div>

                    <div class="d-flex gap-3">
                        <a href="{{ route('dashboard') }}"
                            class="btn btn-outline-light w-50 py-3 rounded-0 border-secondary">BATAL</a>
                        <button type="submit" class="btn btn-gold-luxury w-50 py-3 rounded-0 fw-bold shadow">SIMPAN
                            PERUBAHAN</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<style>
.focus-gold:focus {
    background: transparent !important;
    border-bottom-color: #D4AF37 !important;
    box-shadow: none !important;
    color: white !important;
}
</style>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    // Validasi ukuran file di sisi klien (Contoh: Max 2MB)
    if (file.size > 2 * 1024 * 1024) {
        alert("Ukuran file terlalu besar! Maksimal 2MB.");
        event.target.value = "";
        return;
    }

    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('avatarPreview');
        output.src = reader.result;
    };
    reader.readAsDataURL(file);
}
</script>
@endsection