<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    // DILIHAT USER (FRONTEND)
    public function index()
    {
        // Ambil data pertama, jika kosong buat object baru biar gak error
        $about = About::first() ?? new About(); 
        return view('about', compact('about'));
    }

    // HALAMAN EDIT (ADMIN)
    public function edit()
    {
        $about = About::first() ?? new About();
        return view('admin.about.edit', compact('about'));
    }

    // PROSES UPDATE (ADMIN)
    public function update(Request $request)
    {
        // Ambil data lama atau buat baru
        $about = About::firstOrNew();

        $data = $request->validate([
            'history' => 'nullable|string',
            'mission' => 'nullable|string',
            'history_image' => 'nullable|image|max:2048',
            'mission_image' => 'nullable|image|max:2048',
        ]);

        // Upload Foto Sejarah
        if ($request->hasFile('history_image')) {
            if ($about->history_image) Storage::disk('public')->delete($about->history_image);
            $data['history_image'] = $request->file('history_image')->store('about', 'public');
        }

        // Upload Foto Misi
        if ($request->hasFile('mission_image')) {
            if ($about->mission_image) Storage::disk('public')->delete($about->mission_image);
            $data['mission_image'] = $request->file('mission_image')->store('about', 'public');
        }

        // Simpan ke database (Update jika ada ID, Create jika belum)
        $about->fill($data)->save();

        return redirect()->back()->with('success', 'Halaman Tentang Kami berhasil diperbarui!');
    }
}