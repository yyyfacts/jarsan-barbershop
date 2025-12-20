<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // 1. TAMPILKAN FORM RESERVASI
    public function create()
    {
        // Ambil semua layanan yang aktif untuk ditampilkan di dropdown
        $services = Service::where('is_active', 1)->get();
        return view('user.reservasi', compact('services'));
    }

    // 2. TAMPILKAN DAFTAR RESERVASI (ADMIN)
    public function index()
    {
        // Ambil data reservasi urutkan dari yang terbaru
        $reservations = Reservation::with('service')->latest()->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    // 3. PROSES SIMPAN RESERVASI (USER)
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'time' => 'required',
            'service_id' => 'required|exists:services,id', // Pastikan ID layanan valid
            'notes' => 'nullable|string',
        ]);

        // Simpan ke Database
        Reservation::create([
            'user_id' => Auth::id(),        // Ambil ID user yang sedang login
            'name' => $request->name,
            'phone' => $request->phone,
            'date' => $request->date,
            'time' => $request->time,
            'service_id' => $request->service_id, // PERBAIKAN: Gunakan service_id, bukan service_name
            'notes' => $request->notes,
            'status' => 'Pending',          // Default status pending
        ]);

        return redirect()->route('dashboard')->with('success', 'Reservasi berhasil dibuat! Menunggu konfirmasi admin.');
    }

    // 4. UPDATE STATUS RESERVASI (ADMIN)
    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status reservasi diperbarui.');
    }

    // 5. HAPUS RESERVASI (ADMIN)
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return back()->with('success', 'Data reservasi dihapus.');
    }
}