<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        // Ambil data setting pertama (atau baru jika belum ada)
        $setting = Setting::first();
        // Jika tabel kosong, buat instance baru agar tidak error di view
        if (!$setting) {
            $setting = new Setting();
        }
        return view('admin.setting', compact('setting'));
    }

    public function update(Request $request)
    {
        // 1. Validasi
        $request->validate([
            // ... validasi lain ...
            'hero_image'   => 'nullable|image|max:2048', 
            'hero_image_2' => 'nullable|image|max:2048', // Validasi baru
            'hero_image_3' => 'nullable|image|max:2048', // Validasi baru
        ]);

        $dataToUpdate = $request->except(['logo', 'hero_image', 'hero_image_2', 'hero_image_3', '_token', '_method']);

        // FUNGSI BANTUAN UNTUK UPLOAD BASE64 (Supaya kodingan rapi)
        $processImage = function($fieldName) use ($request, &$dataToUpdate) {
            if ($request->hasFile($fieldName)) {
                $file = $request->file($fieldName);
                $path = $file->getRealPath();
                $image = file_get_contents($path);
                $base64 = base64_encode($image);
                $dataToUpdate[$fieldName] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
            }
        };

        // Jalankan upload untuk masing-masing gambar
        $processImage('hero_image');   // Slide 1
        $processImage('hero_image_2'); // Slide 2
        $processImage('hero_image_3'); // Slide 3

        // Proses Logo (tetap sama)
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = $file->getRealPath();
            $image = file_get_contents($path);
            $base64 = base64_encode($image);
            $dataToUpdate['logo_path'] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        }

        Setting::updateOrCreate(['id' => 1], $dataToUpdate);

        return redirect()->back()->with('success', 'Slider berhasil diperbarui!');
    }
}