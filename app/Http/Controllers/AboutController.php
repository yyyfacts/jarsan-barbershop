<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    // USER LIHAT (FRONTEND)
    public function index()
    {
        // Ambil data pertama
        $about = About::first();
        return view('user.about', compact('about'));
    }

    // ADMIN EDIT (FORM)
    public function edit()
    {
        // Ambil data pertama, atau buat objek baru jika kosong
        // (Supaya form tidak error saat database masih kosong)
        $about = About::firstOrCreate([], [
            'hero_title' => 'CRAFTING CONFIDENCE',
            'history' => 'Isi sejarah default...',
        ]);
        
        return view('admin.about', compact('about'));
    }

    // ADMIN UPDATE (SIMPAN)
    public function update(Request $request)
    {
        // 1. VALIDASI DATA
        $request->validate([
            // Validasi Gambar (Max 2MB)
            'hero_bg'       => 'nullable|image|max:2048', // <--- TAMBAHAN BARU
            'history_image' => 'nullable|image|max:2048', 
            'mission_image' => 'nullable|image|max:2048',

            // Hero Section
            'hero_title'    => 'nullable|string',
            'hero_subtitle' => 'nullable|string',

            // History Section
            'history'       => 'nullable|string',
            'founded_year'  => 'nullable|string',
            'founded_text'  => 'nullable|string',

            // Mission & Philosophy
            'mission'           => 'nullable|string',
            'philosophy_title'  => 'nullable|string',
            'philosophy_quote'  => 'nullable|string',

            // Why Choose Us
            'why_title'     => 'nullable|string',
            'why_1_title'   => 'nullable|string',
            'why_1_desc'    => 'nullable|string',
            'why_2_title'   => 'nullable|string',
            'why_2_desc'    => 'nullable|string',
            'why_3_title'   => 'nullable|string',
            'why_3_desc'    => 'nullable|string',
        ]);

        // 2. SIAPKAN DATA
        // Ambil semua input KECUALI file gambar dan token
        $data = $request->except(['hero_bg', 'history_image', 'mission_image', '_token', '_method']);

        // FUNGSI BANTUAN UNTUK UPLOAD BASE64 (Supaya kodingan rapi)
        $processImage = function($fieldName) use ($request, &$data) {
            if ($request->hasFile($fieldName)) {
                $file = $request->file($fieldName);
                $path = $file->getRealPath();
                $image = file_get_contents($path);
                $base64 = base64_encode($image);
                
                // Simpan sebagai Data URI
                $data[$fieldName] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
            }
        };

        // 3. JALANKAN PROSES UPLOAD GAMBAR
        $processImage('hero_bg');       // <--- PROSES BACKGROUND HERO
        $processImage('history_image'); // <--- PROSES GAMBAR SEJARAH
        $processImage('mission_image'); // <--- PROSES GAMBAR MISI

        // 4. SIMPAN KE DATABASE
        // Update ID 1, atau buat baru jika belum ada
        About::updateOrCreate(['id' => 1], $data);

        return redirect()->back()->with('success', 'Halaman Tentang Kami berhasil diperbarui!');
    }
}