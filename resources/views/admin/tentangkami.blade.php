@extends('layouts.admin')

@section('content')
<div class="mb-5">
    <h3 class="fw-bold text-white">Edit "About Us" Content</h3>
</div>

@if(session('success'))
<div class="alert alert-dark border-0 shadow-sm text-center mb-4" role="alert"
    style="border-left: 4px solid var(--gold-accent) !important;">
    <span style="color: var(--gold-accent);">{{ session('success') }}</span>
</div>
@endif

<form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="row g-4">
        {{-- HISTORY SECTION --}}
        <div class="col-12 col-lg-6">
            <div class="card h-100 p-4">
                <div class="d-flex align-items-center mb-4 pb-2 border-bottom border-secondary">
                    <h5 class="fw-bold m-0" style="color: var(--gold-accent);">01. HISTORY SECTION</h5>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted small">HISTORY TEXT</label>
                    <textarea name="history" rows="8" class="form-control"
                        placeholder="Write the barbershop history...">{{ $about->history ?? '' }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted small">BACKGROUND IMAGE</label>
                    <input type="file" name="history_image" class="form-control">
                </div>

                @if($about->history_image)
                <div class="mt-3">
                    <small class="text-muted d-block mb-2">Current Image:</small>
                    <img src="{{ $about->history_image }}" class="img-fluid rounded border border-secondary"
                        style="height: 150px; width: 100%; object-fit: cover;">
                </div>
                @endif
            </div>
        </div>

        {{-- MISSION SECTION --}}
        <div class="col-12 col-lg-6">
            <div class="card h-100 p-4">
                <div class="d-flex align-items-center mb-4 pb-2 border-bottom border-secondary">
                    <h5 class="fw-bold m-0" style="color: var(--gold-accent);">02. MISSION SECTION</h5>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted small">MISSION TEXT</label>
                    <textarea name="mission" rows="8" class="form-control"
                        placeholder="Write the mission statement...">{{ $about->mission ?? '' }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted small">BACKGROUND IMAGE</label>
                    <input type="file" name="mission_image" class="form-control">
                </div>

                @if($about->mission_image)
                <div class="mt-3">
                    <small class="text-muted d-block mb-2">Current Image:</small>
                    <img src="{{ $about->mission_image }}" class="img-fluid rounded border border-secondary"
                        style="height: 150px; width: 100%; object-fit: cover;">
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-5 text-end">
        <button type="submit" class="btn btn-gold btn-lg w-100 w-md-auto px-5 rounded-0 shadow">SAVE CHANGES</button>
    </div>
</form>
@endsection