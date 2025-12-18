<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Service;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // FORM USER (Tampilkan Form)
    public function create()
    {
        $services = Service::all(); // Ambil layanan buat dropdown
        return view('reservasi', compact('services'));
    }

    // PROSES USER (Kirim Data)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'service_id' => 'required',
        ]);

        // Cari nama layanan berdasarkan ID
        $service = Service::find($request->service_id);

        Reservation::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'date' => $request->date,
            'time' => $request->time,
            'service_name' => $service->name, // Simpan namanya saja
            'notes' => $request->notes,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Reservasi berhasil dikirim! Tunggu konfirmasi admin.');
    }

    // ADMIN: LIHAT DAFTAR
    public function index()
    {
        $reservations = Reservation::latest()->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    // ADMIN: UPDATE STATUS (Pending -> Done)
    public function updateStatus($id)
    {
        $reservation = Reservation::findOrFail($id);
        // Toggle status (kalau pending jadi done, kalau done jadi pending)
        $reservation->status = $reservation->status == 'pending' ? 'done' : 'pending';
        $reservation->save();

        return redirect()->back()->with('success', 'Status reservasi diperbarui.');
    }

    // ADMIN: HAPUS
    public function destroy($id)
    {
        Reservation::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data dihapus.');
    }
}