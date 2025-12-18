<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Barber;
use App\Models\About;

class PublicController extends Controller
{
    // 1. Halaman Beranda (Welcome)
    public function welcome()
    {
        return view('welcome');
    }

    // 2. Halaman Tentang Kami
    public function about()
    {
        // Ambil data about, kalau kosong pakai default array biar ga error
        $about = About::first(); 
        return view('about', compact('about'));
    }

    // 3. Halaman Barberman
    public function barberman()
    {
        // Ambil semua barber
        $barbers = Barber::all();
        return view('barberman', compact('barbers'));
    }

    // 4. Halaman Pricelist
    public function pricelist()
    {
        // Ambil semua layanan
        $services = Service::all();
        return view('pricelist', compact('services'));
    }

    // 5. Halaman Kontak
    public function contact()
    {
        return view('contact');
    }
}