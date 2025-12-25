<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    // 1. ADMIN: TAMPILKAN SETTING
    public function index()
    {
        // Ambil data setting pertama (karena setting biasanya cuma 1 baris)
        $setting = Setting::first();
        
        // Arahkan ke folder 'admin', file 'setting.blade.php'
        return view('admin.setting', compact('setting'));
    }

    // 2. ADMIN: UPDATE SETTING
    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required',
            'logo' => 'nullable|image|max:2048' // Validasi gambar max 2MB
        ]);

        // Cek data setting pertama
        $setting = Setting::first();

        // Siapkan data update
        $updateData = [
            'app_name' => $request->app_name,
        ];

        // Logika Gambar Base64 (Sama persis dengan BarberController)
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->getRealPath();
            $image = file_get_contents($path);
            $base64 = base64_encode($image);
            
            // Simpan sebagai string base64 lengkap
            $updateData['logo_path'] = 'data:image/' . $request->file('logo')->extension() . ';base64,' . $base64;
        }

        if ($setting) {
            // Jika sudah ada, update
            $setting->update($updateData);
        } else {
            // Jika belum ada, buat baru
            Setting::create($updateData);
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan');
    }
}