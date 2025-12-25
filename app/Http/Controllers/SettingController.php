<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    // Menampilkan Halaman Pengaturan
    public function index()
    {
        // Ambil data setting pertama, jika kosong return null
        $settings = Setting::first();
        return view('admin.settings.index', compact('settings'));
    }

    // Menyimpan/Update Pengaturan
    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'logo'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        // Ambil data pertama, atau buat instance baru jika belum ada
        $setting = Setting::firstOrNew([]);

        // Update Nama Aplikasi
        $setting->app_name = $request->app_name;

        // Logika Simpan Gambar sebagai BLOB
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            
            // Baca konten file menjadi string binary
            $binaryData = file_get_contents($file->getRealPath());
            
            // Simpan ke kolom logo_data
            $setting->logo_data = $binaryData;
        }

        $setting->save();

        return redirect()->back()->with('success', 'Pengaturan website berhasil diperbarui.');
    }
}