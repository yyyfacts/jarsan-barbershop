<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    // USER LIHAT (FRONTEND)
    public function index()
    {
        $about = About::first();
        return view('about', compact('about'));
    }

    // ADMIN EDIT (FORM)
    public function edit()
    {
        // Ambil data pertama, atau buat objek baru jika kosong
        $about = About::first() ?? new About();
        return view('admin.tentangkami', compact('about'));
    }

    // ADMIN UPDATE (SIMPAN)
    public function update(Request $request)
    {
        $request->validate([
            'history' => 'nullable|string',
            'mission' => 'nullable|string',
            'history_image' => 'nullable|image|max:1024', // Max 1MB
            'mission_image' => 'nullable|image|max:1024', // Max 1MB
        ]);

        $about = About::firstOrNew();

        // 1. UPDATE DATA TEKS
        $about->history = $request->history;
        $about->mission = $request->mission;

        // 2. PROSES GAMBAR SEJARAH (BASE64)
        if ($request->hasFile('history_image')) {
            $path = $request->file('history_image')->getRealPath();
            $image = file_get_contents($path);
            $base64 = base64_encode($image);
            $about->history_image = 'data:image/' . $request->file('history_image')->extension() . ';base64,' . $base64;
        }

        // 3. PROSES GAMBAR MISI (BASE64)
        if ($request->hasFile('mission_image')) {
            $path = $request->file('mission_image')->getRealPath();
            $image = file_get_contents($path);
            $base64 = base64_encode($image);
            $about->mission_image = 'data:image/' . $request->file('mission_image')->extension() . ';base64,' . $base64;
        }

        $about->save();

        return redirect()->back()->with('success', 'Halaman Tentang Kami diperbarui!');
    }
}