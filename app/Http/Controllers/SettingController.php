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
        return view('admin.setting', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'logo'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Siapkan data update nama aplikasi
        $dataToUpdate = [
            'app_name' => $request->app_name
        ];

        // Proses Logo menjadi Base64 jika ada file yang diupload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = $file->getRealPath();
            $image = file_get_contents($path);
            $base64 = base64_encode($image);
            
            // Simpan format lengkap: data:image/png;base64,.....
            $dataToUpdate['logo_path'] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        }

        // Update data jika ada, atau buat baru jika belum ada (id = 1)
        Setting::updateOrCreate(
            ['id' => 1], // Kunci pencarian
            $dataToUpdate // Data yang disimpan
        );

        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan');
    }
}