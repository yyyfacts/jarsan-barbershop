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
        return view('about', compact('about'));
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
            // Gambar (Max 2MB)
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
        // Ambil semua input kecuali gambar dan token
        $data = $request->except(['history_image', 'mission_image', '_token', '_method']);

        // 3. PROSES GAMBAR SEJARAH (BASE64)
        if ($request->hasFile('history_image')) {
            $file = $request->file('history_image');
            $path = $file->getRealPath();
            $image = file_get_contents($path);
            $base64 = base64_encode($image);
            
            // Masukkan ke array data
            $data['history_image'] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        }

        // 4. PROSES GAMBAR MISI (BASE64)
        if ($request->hasFile('mission_image')) {
            $file = $request->file('mission_image');
            $path = $file->getRealPath();
            $image = file_get_contents($path);
            $base64 = base64_encode($image);
            
            // Masukkan ke array data
            $data['mission_image'] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        }

        // 5. SIMPAN KE DATABASE
        // Update ID 1, atau buat baru jika belum ada
        About::updateOrCreate(['id' => 1], $data);

        return redirect()->back()->with('success', 'Halaman Tentang Kami berhasil diperbarui!');
    }
}