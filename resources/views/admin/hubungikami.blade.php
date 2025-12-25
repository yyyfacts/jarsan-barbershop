@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold text-dark m-0">Pesan Masuk</h3>
    <p class="text-muted small">Daftar pertanyaan atau masukan dari pelanggan.</p>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th style="min-width: 200px;">Pengirim</th>
                        <th>Isi Pesan</th>
                        <th width="15%">Tanggal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                    <tr>
                        <td class="text-center text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center fw-bold text-secondary"
                                    style="width: 40px; height: 40px;">
                                    {{ substr($contact->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $contact->name }}</div>
                                    <div class="small text-muted">{{ $contact->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="p-3 bg-light rounded border text-secondary" style="font-size: 0.9rem;">
                                {{ Str::limit($contact->message, 120) }}
                            </div>
                        </td>
                        <td>
                            <div class="text-dark small">{{ $contact->created_at->format('d M Y') }}</div>
                            <div class="text-muted small" style="font-size: 0.75rem;">
                                {{ $contact->created_at->format('H:i') }} WIB</div>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST"
                                onsubmit="return confirm('Hapus pesan ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-circle"
                                    style="width: 32px; height: 32px;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary opacity-25"></i>
                            Kotak masuk kosong.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection