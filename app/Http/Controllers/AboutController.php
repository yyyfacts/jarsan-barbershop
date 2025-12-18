<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    // User melihat halaman About
    public function index()
    {
        $about = About::first();
        return view('about', compact('about'));
    }

    // Admin melihat halaman Edit About
    public function edit()
    {
        // Ambil data pertama, jika tidak ada buat instance kosong
        $about = About::first() ?? new About();

        // PENTING: Mengarah ke 'resources/views/admin/tentangkami.blade.php'
        return view('admin.tentangkami', compact('about'));
    }

    // Admin Update Data About
    public function update(Request $request)
    {
        // Validasi
        $data = $request->validate([
            'history' => 'nullable|string',
            'mission' => 'nullable|string',
            'history_image' => 'nullable|image|max:2048',
            'mission_image' => 'nullable|image|max:2048',
        ]);

        // Ambil data lama atau buat baru
        $about = About::firstOrNew();

        // Upload Gambar Sejarah
        if ($request->hasFile('history_image')) {
            if ($about->history_image) Storage::disk('public')->delete($about->history_image);
            $data['history_image'] = $request->file('history_image')->store('about', 'public');
        }

        // Upload Gambar Misi
        if ($request->hasFile('mission_image')) {
            if ($about->mission_image) Storage::disk('public')->delete($about->mission_image);
            $data['mission_image'] = $request->file('mission_image')->store('about', 'public');
        }

        // Simpan
        $about->fill($data)->save();

        return redirect()->back()->with('success', 'Halaman Tentang Kami berhasil diperbarui!');
    }
}