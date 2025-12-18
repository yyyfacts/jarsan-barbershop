@extends('layouts.admin')

@section('content')
<h3 class="fw-bold mb-4">Edit Halaman Tentang Kami</h3>

<form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card p-4 border-0 shadow-sm h-100">
                <h5 class="fw-bold mb-3">Sejarah Kami</h5>
                <textarea name="history" rows="6" class="form-control mb-3">{{ $about->history ?? '' }}</textarea>

                <label class="form-label fw-bold">Gambar Sejarah</label>
                <input type="file" name="history_image" class="form-control mb-3">
                @if($about->history_image)
                <img src="{{ asset('storage/' . $about->history_image) }}" class="img-fluid rounded"
                    style="max-height: 200px">
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-4 border-0 shadow-sm h-100">
                <h5 class="fw-bold mb-3">Misi Kami</h5>
                <textarea name="mission" rows="6" class="form-control mb-3">{{ $about->mission ?? '' }}</textarea>

                <label class="form-label fw-bold">Gambar Misi</label>
                <input type="file" name="mission_image" class="form-control mb-3">
                @if($about->mission_image)
                <img src="{{ asset('storage/' . $about->mission_image) }}" class="img-fluid rounded"
                    style="max-height: 200px">
                @endif
            </div>
        </div>
    </div>

    <div class="mt-4 text-end">
        <button type="submit" class="btn btn-success px-5 fw-bold">Simpan Perubahan</button>
    </div>
</form>
@endsection