@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold m-0">Pesan Masuk</h3>
    <p class="small" style="color: var(--text-muted);">Daftar pertanyaan dari formulir kontak.</p>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th style="min-width: 200px;">Pengirim</th>
                        <th>Isi Pesan</th>
                        <th width="15%">Waktu</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                    <tr>
                        <td class="text-center" style="color: var(--text-muted);">{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle border d-flex align-items-center justify-content-center fw-bold"
                                    style="width: 40px; height: 40px; background-color: var(--bg-body); color: var(--text-main);">
                                    {{ substr($contact->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $contact->name }}</div>
                                    <div class="small" style="color: var(--text-muted);">{{ $contact->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="p-3 rounded border"
                                style="background-color: var(--bg-body); color: var(--text-main); font-size: 0.9rem;">
                                {{ Str::limit($contact->message, 120) }}
                            </div>
                        </td>
                        <td>
                            <div class="small">{{ $contact->created_at->format('d M Y') }}</div>
                            <div class="small" style="color: var(--text-muted);">
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
                        <td colspan="5" class="text-center py-5" style="color: var(--text-muted);">
                            <i class="bi bi-inbox fs-1 d-block mb-2 opacity-25"></i>
                            Tidak ada pesan baru.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection