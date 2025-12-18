<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Service;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // USER: FORM BOOKING
    public function create()
    {
        $services = Service::all();
        // View User Frontend
        return view('reservasi', compact('services'));
    }

    // USER: KIRIM DATA
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'service_id' => 'required',
        ]);

        $service = Service::find($request->service_id);

        Reservation::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'date' => $request->date,
            'time' => $request->time,
            'service_name' => $service->name,
            'notes' => $request->notes,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Reservasi berhasil dikirim!');
    }

    // ADMIN: LIHAT DATA
    public function index()
    {
        $reservations = Reservation::latest()->get();
        // PERBAIKAN: Langsung ke file 'admin/reservations.blade.php'
        return view('admin.reservations', compact('reservations'));
    }

    // ADMIN: GANTI STATUS
    public function updateStatus($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = $reservation->status == 'pending' ? 'done' : 'pending';
        $reservation->save();

        return redirect()->back()->with('success', 'Status diperbarui.');
    }

    // ADMIN: HAPUS
    public function destroy($id)
    {
        Reservation::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data dihapus.');
    }
}