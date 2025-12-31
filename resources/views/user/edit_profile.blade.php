@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container py-5" style="margin-top: 80px; min-height: 80vh;">
    <div class="row justify-content-center">
        <div class="col-md-6" data-aos="fade-up">

            <div class="p-5 rounded-0 bg-matte border border-secondary shadow-lg position-relative">
                <h3 class="luxury-font text-white fw-bold mb-4 text-center">EDIT PROFILE</h3>

                {{-- Alert Sukses/Error --}}
                @if(session('success'))
                <div class="alert alert-success bg-opacity-25 bg-success text-white border-0 mb-4">
                    {{ session('success') }}</div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- PREVIEW FOTO --}}
                    <div class="text-center mb-4">
                        <div class="d-inline-block position-relative">
                            {{-- Logic Gambar: Cek BLOB dulu, kalau null pake UI Avatars --}}
                            <img src="{{ Auth::user()->avatar_blob ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=D4AF37&color=000' }}"
                                class="rounded-circle border border-warning p-1"
                                style="width: 120px; height: 120px; object-fit: cover;" id="avatarPreview">

                            <label for="avatarInput"
                                class="position-absolute bottom-0 end-0 bg-gold text-dark rounded-circle p-2 cursor-pointer"
                                style="cursor: pointer; background: var(--luxury-gold);">
                                <i class="bi bi-camera-fill"></i>
                            </label>
                        </div>
                        <p class="text-white-50 small mt-2">Klik ikon kamera untuk mengganti foto</p>
                    </div>

                    {{-- INPUT FILE HIDDEN --}}
                    <input type="file" name="avatar" id="avatarInput" class="d-none" accept="image/*"
                        onchange="previewImage(event)">

                    {{-- INPUT NAMA --}}
                    <div class="mb-4">
                        <label class="small text-gold fw-bold letter-spacing-2">FULL NAME</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}"
                            class="form-control bg-transparent border-0 border-bottom border-secondary text-white rounded-0 ps-0 py-2"
                            required>
                    </div>

                    {{-- INPUT EMAIL (READONLY) --}}
                    <div class="mb-5">
                        <label class="small text-gold fw-bold letter-spacing-2">EMAIL (Cannot be changed)</label>
                        <input type="text" value="{{ Auth::user()->email }}"
                            class="form-control bg-transparent border-0 border-bottom border-secondary text-white-50 rounded-0 ps-0 py-2"
                            readonly>
                    </div>

                    <div class="d-flex gap-3">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-light w-50 py-3 rounded-0">KEMBALI</a>
                        <button type="submit" class="btn btn-gold-luxury w-50 py-3 rounded-0 fw-bold">SIMPAN
                            PERUBAHAN</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
// Script sederhana untuk preview gambar sebelum diupload
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('avatarPreview');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection