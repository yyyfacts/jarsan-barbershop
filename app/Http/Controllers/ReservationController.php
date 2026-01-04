<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Service;
use App\Models\Barber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Ditambahkan untuk query yang lebih kompleks

// IMPORT UNTUK EXCEL
use App\Exports\ReservationsExport;
use Maatwebsite\Excel\Facades\Excel;

class ReservationController extends Controller
{
    // --- USER: FORM BOOKING ---
    public function create()
    {
        $services = Service::where('is_active', 1)->get();
        // Mengambil barber beserta relasi reviews dan user yang mengulas
        $barbers = Barber::with(['reviews.user'])->get(); 

        return view('reservasi', compact('services', 'barbers')); 
    }

    // --- FITUR BARU: CEK KETERSEDIAAN SLOT (AJAX) ---
    public function checkSlots(Request $request)
    {
        $date = $request->query('date');
        $barberId = $request->query('barber_id');

        if (!$date) {
            return response()->json([]);
        }

        // Logic 1: Jika User memilih Barber spesifik
        if ($barberId) {
            $bookedTimes = Reservation::whereDate('date', $date)
                ->where('barber_id', $barberId)
                ->whereNotIn('status', ['Cancelled', 'Done']) // Slot dianggap penuh jika Pending/Approved
                ->pluck('time')
                ->map(function($time) {
                    return date('H:i', strtotime($time));
                });
        } 
        // Logic 2: Jika User memilih "Any Barber" (Sesuai kode radio value="")
        else {
            // "Any Barber" hanya dianggap penuh jika SEMUA barber sudah dibooking pada jam tersebut
            $totalBarbers = Barber::count();
            
            $bookedTimes = Reservation::whereDate('date', $date)
                ->whereNotIn('status', ['Cancelled', 'Done'])
                ->select('time', DB::raw('count(*) as total'))
                ->groupBy('time')
                ->having('total', '>=', $totalBarbers)
                ->pluck('time')
                ->map(function($time) {
                    return date('H:i', strtotime($time));
                });
        }

        return response()->json($bookedTimes);
    }

    // --- USER: KIRIM DATA (DENGAN VALIDASI DOUBLE BOOKING) ---
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'service_id' => 'required|exists:services,id', 
            'barber_id' => 'nullable|exists:barbers,id',
            'notes' => 'nullable|string',
        ]);

        // Proteksi Server-Side: Cek kembali apakah slot masih tersedia sebelum simpan
        $isBooked = Reservation::whereDate('date', $request->date)
            ->where('time', $request->time)
            ->where('barber_id', $request->barber_id)
            ->whereNotIn('status', ['Cancelled', 'Done'])
            ->exists();

        if ($isBooked) {
            return redirect()->back()->with('error', 'Maaf, slot waktu ini baru saja diambil orang lain. Silakan pilih waktu lain.');
        }

        Reservation::create([
            'user_id' => Auth::id(),        
            'name' => $request->name,
            'phone' => $request->phone,
            'date' => $request->date,
            'time' => $request->time,
            'service_id' => $request->service_id,
            'barber_id' => $request->barber_id, 
            'notes' => $request->notes,
            'status' => 'Pending'           
        ]);

        return redirect()->back()->with('success', 'Reservasi berhasil dikirim! Menunggu konfirmasi admin.');
    }

    // --- ADMIN: LIHAT DATA ---
    public function index()
    {
        $reservations = Reservation::with(['service', 'barber'])->latest()->get();
        return view('admin.reservations', compact('reservations'));
    }

    // --- ADMIN: FUNGSI EXPORT EXCEL ---
    public function exportExcel()
    {
        return Excel::download(new ReservationsExport, 'Laporan_Reservasi_' . date('d-m-Y') . '.xlsx');
    }

    // --- ADMIN: GANTI STATUS ---
    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        
        if ($request->has('status')) {
            $reservation->status = $request->status;
            $reservation->save();
            return redirect()->back()->with('success', 'Status berhasil diubah menjadi: ' . $request->status);
        }

        return redirect()->back()->with('error', 'Gagal mengubah status.');
    }

    // --- ADMIN: HAPUS ---
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        
        return redirect()->back()->with('success', 'Data reservasi dihapus.');
    }
}