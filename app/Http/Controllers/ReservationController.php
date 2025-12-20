<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // USER: FORM BOOKING
    public function create()
    {
        // Ambil data service yang aktif saja
        $services = Service::where('is_active', 1)->get();
        
        // PERBAIKAN DI SINI:
        // Hapus 'user.' karena file view kamu ada di folder utama views
        return view('reservasi', compact('services')); 
    }

    // USER: KIRIM DATA
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'time' => 'required',
            'service_id' => 'required|exists:services,id', 
            'notes' => 'nullable|string',
        ]);

        // Simpan ke Database
        Reservation::create([
            'user_id' => Auth::id(),        
            'name' => $request->name,
            'phone' => $request->phone,
            'date' => $request->date,
            'time' => $request->time,
            'service_id' => $request->service_id, 
            'notes' => $request->notes,
            'status' => 'Pending'           
        ]);

        return redirect()->back()->with('success', 'Reservasi berhasil dikirim! Menunggu konfirmasi admin.');
    }

    // ADMIN: LIHAT DATA
    public function index()
    {
        $reservations = Reservation::with('service')->latest()->get();
        
        // Pastikan view admin juga benar path-nya
        // Jika file kamu ada di resources/views/admin/reservations.blade.php maka ini sudah benar
        return view('admin.reservations.index', compact('reservations'));
    }

    // ADMIN: GANTI STATUS
    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        
        if ($request->has('status')) {
            $reservation->update(['status' => $request->status]);
        } else {
            $reservation->status = $reservation->status == 'pending' ? 'done' : 'pending';
            $reservation->save();
        }

        return redirect()->back()->with('success', 'Status diperbarui.');
    }

    // ADMIN: HAPUS
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        
        return redirect()->back()->with('success', 'Data reservasi dihapus.');
    }
}