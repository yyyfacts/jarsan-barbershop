@extends('layouts.admin')

@section('content')
<div class="mb-5">
    <h3 class="fw-bold text-white">Edit "About Us"</h3>
</div>

@if(session('success'))
<div class="alert alert-dark border-0 shadow-sm text-center mb-4"
    style="border-left: 4px solid var(--gold-accent) !important;">
    <span class="text-gold">{{ session('success') }}</span>
</div>
@endif

<form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="row g-4">
        <div class="col-12 col-lg-6">
            <div class="card h-100 p-4">
                <h5 class="fw-bold mb-4 text-gold">HISTORY SECTION</h5>
                <div class="mb-3"><label class="form-label text-secondary small">TEXT</label><textarea name="history"
                        rows="8" class="form-control">{{ $about->history ?? '' }}</textarea></div>
                <div class="mb-3"><label class="form-label text-secondary small">IMAGE</label><input type="file"
                        name="history_image" class="form-control"></div>
                @if($about->history_image) <img src="{{ $about->history_image }}"
                    class="img-fluid rounded border border-secondary mt-2"> @endif
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 p-4">
                <h5 class="fw-bold mb-4 text-gold">MISSION SECTION</h5>
                <div class="mb-3"><label class="form-label text-secondary small">TEXT</label><textarea name="mission"
                        rows="8" class="form-control">{{ $about->mission ?? '' }}</textarea></div>
                <div class="mb-3"><label class="form-label text-secondary small">IMAGE</label><input type="file"
                        name="mission_image" class="form-control"></div>
                @if($about->mission_image) <img src="{{ $about->mission_image }}"
                    class="img-fluid rounded border border-secondary mt-2"> @endif
            </div>
        </div>
    </div>
    <div class="mt-5 text-end"><button type="submit"
            class="btn btn-gold btn-lg w-100 w-md-auto px-5 rounded-0 shadow">SAVE CHANGES</button></div>
</form>
@endsection