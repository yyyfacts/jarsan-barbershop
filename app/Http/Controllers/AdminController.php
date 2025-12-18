<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Service;
use App\Models\Barber;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Hitung Data untuk Dashboard
        $reservasiHariIni = Reservation::whereDate('date', now())->count();
        $totalLayanan = Service::count();
        $totalBarber = Barber::count();

        return view('admin.dashboard', compact('reservasiHariIni', 'totalLayanan', 'totalBarber'));
    }
}