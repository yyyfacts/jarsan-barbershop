<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Barber;
use App\Models\About;
use App\Models\ContactDetail; // <--- 1. WAJIB IMPORT MODEL INI

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
        $about = About::first(); 
        return view('about', compact('about'));
    }

    // 3. Halaman Barberman
    public function barberman()
    {
        $barbers = Barber::all();
        return view('barberman', compact('barbers'));
    }

    // 4. Halaman Pricelist
    public function pricelist()
    {
        $services = Service::all();
        return view('pricelist', compact('services'));
    }

    // 5. Halaman Kontak (PERBAIKAN DISINI)
    public function contact()
    {
        // 2. Ambil data konfigurasi kontak dari database
        $config = ContactDetail::first();
        
        // 3. Kirim variabel $config ke view
        return view('contact', compact('config'));
    }
}