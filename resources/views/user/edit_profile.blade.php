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

                {{-- Menampilkan Error Validasi --}}
                @if ($errors->any())
                <div class="alert alert-danger bg-opacity-25 bg-danger text-white border-0 mb-4 rounded-0">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- INFORMASI FOTO (STATIS) --}}
                    <div class="text-center mb-5">
                        <div class="d-inline-block position-relative">
                            <img src="{{ Auth::user()->avatar_blob ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=D4AF37&color=000' }}"
                                class="rounded-circle border border-warning p-1 shadow"
                                style="width: 130px; height: 130px; object-fit: cover;">
                        </div>
                        <p class="text-white-50 small mt-3">Foto profil saat ini</p>
                    </div>

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
                        <button type="submit" class="btn btn-gold-luxury w-50 py-3 rounded-0 fw-bold shadow">
                            SIMPAN PERUBAHAN
                        </button>
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
@endsection