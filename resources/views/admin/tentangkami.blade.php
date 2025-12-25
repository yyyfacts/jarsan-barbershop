@extends('layouts.admin')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-end mb-5 gap-3">
    <div>
        <h6 class="text-gold small-caps mb-1">Company Profile</h6>
        <h3 class="fw-bold m-0 text-white">Edit "About Us" Content</h3>
    </div>
    <button type="submit" form="aboutForm" class="btn btn-gold shadow-sm px-4">
        <i class="bi bi-check2-circle me-2"></i> Save Changes
    </button>
</div>

@if(session('success'))
<div class="alert alert-dark border-0 d-flex align-items-center mb-4" role="alert">
    <i class="bi bi-check-circle-fill text-gold me-2"></i>
    <div class="text-white small">{{ session('success') }}</div>
</div>
@endif

<form id="aboutForm" action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="row g-4">
        <div class="col-12 col-lg-6">
            <div class="card h-100 p-4 border-0" style="background-color: #141414;">
                <div class="d-flex align-items-center gap-2 mb-4 pb-3 border-bottom border-dark">
                    <i class="bi bi-clock-history text-gold fs-5"></i>
                    <h5 class="font-serif text-white m-0">History & Background</h5>
                </div>

                <div class="mb-4">
                    <label class="text-muted small mb-2 text-uppercase fw-bold">Story Content</label>
                    <textarea name="history" rows="12" class="form-control"
                        placeholder="Write your barbershop history here..."
                        style="line-height: 1.8;">{{ $about->history ?? '' }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="text-muted small mb-2 text-uppercase fw-bold">Section Image</label>
                    <input type="file" name="history_image" class="form-control mb-3">

                    @if($about->history_image)
                    <div class="position-relative mt-2">
                        <p class="small text-muted mb-1">Current Image:</p>
                        <img src="{{ $about->history_image }}"
                            class="img-fluid rounded shadow-sm border border-secondary w-100 object-fit-cover"
                            style="height: 250px;">
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 p-4 border-0" style="background-color: #141414;">
                <div class="d-flex align-items-center gap-2 mb-4 pb-3 border-bottom border-dark">
                    <i class="bi bi-bullseye text-gold fs-5"></i>
                    <h5 class="font-serif text-white m-0">Our Mission</h5>
                </div>

                <div class="mb-4">
                    <label class="text-muted small mb-2 text-uppercase fw-bold">Mission Statement</label>
                    <textarea name="mission" rows="12" class="form-control"
                        placeholder="Write your vision and mission here..."
                        style="line-height: 1.8;">{{ $about->mission ?? '' }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="text-muted small mb-2 text-uppercase fw-bold">Section Image</label>
                    <input type="file" name="mission_image" class="form-control mb-3">

                    @if($about->mission_image)
                    <div class="position-relative mt-2">
                        <p class="small text-muted mb-1">Current Image:</p>
                        <img src="{{ $about->mission_image }}"
                            class="img-fluid rounded shadow-sm border border-secondary w-100 object-fit-cover"
                            style="height: 250px;">
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>
@endsection