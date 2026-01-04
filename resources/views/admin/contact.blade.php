@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    {{-- JUDUL 1: Ubah text-white jadi text-dark --}}
    <h3 class="fw-bold mb-4 text-dark">Contact Information Settings</h3>

    <div class="card border-0 mb-5 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.contact.update') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Page Title</label>
                        <input type="text" name="page_title" class="form-control"
                            value="{{ old('page_title', $config->page_title) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Page Subtitle</label>
                        <input type="text" name="page_subtitle" class="form-control"
                            value="{{ old('page_subtitle', $config->page_subtitle) }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">WhatsApp Number</label>
                        <input type="text" name="whatsapp" class="form-control"
                            value="{{ old('whatsapp', $config->whatsapp) }}" placeholder="628xxxxx">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Email Address</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $config->email) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Google Maps Link</label>
                        <input type="text" name="maps_link" class="form-control"
                            value="{{ old('maps_link', $config->maps_link) }}">
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Full Address</label>
                        <textarea name="address" class="form-control"
                            rows="2">{{ old('address', $config->address) }}</textarea>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="small text-muted">Mon-Fri Hours</label>
                        <input type="text" name="hours_mon_fri" class="form-control form-control-sm"
                            value="{{ old('hours_mon_fri', $config->hours_mon_fri) }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="small text-muted">Sat-Sun Hours</label>
                        <input type="text" name="hours_sat_sun" class="form-control form-control-sm"
                            value="{{ old('hours_sat_sun', $config->hours_sat_sun) }}">
                    </div>
                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                </div>
            </form>
        </div>
    </div>


    {{-- JUDUL 2: Ubah text-white jadi text-dark --}}
    <h3 class="fw-bold mb-4 text-dark">Incoming Messages</h3>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-nowrap">
                    {{-- Header Tabel tetap gelap biar keren --}}
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">NO</th>
                            <th>SENDER</th>
                            <th>MESSAGE CONTENT</th>
                            <th>DATE RECEIVED</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                        <tr>
                            {{-- ISI TABEL: Hapus text-white atau ganti text-dark --}}
                            <td class="text-center text-dark">{{ $loop->iteration }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $contact->name }}</div>
                                <div class="small text-muted">{{ $contact->email }}</div>
                            </td>
                            {{-- Pesan: warnanya default (hitam) --}}
                            <td style="min-width: 300px; white-space: normal;">
                                {{ Str::limit($contact->message, 80) }}
                            </td>
                            {{-- Tanggal: ganti gold jadi muted atau dark --}}
                            <td class="small text-muted">
                                {{ $contact->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="text-center">
                                <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST"
                                    onsubmit="return confirm('Delete message from {{ $contact->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-0">DELETE</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-dark">No messages in inbox.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection