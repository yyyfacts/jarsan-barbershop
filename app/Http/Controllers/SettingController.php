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
        // 1. Validasi Input
        $request->validate([
            'app_name'        => 'required|string|max:255',
            'logo'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'instagram_link'  => 'nullable|url',     // Format URL
            'tiktok_link'     => 'nullable|url',     // Format URL
            'whatsapp_number' => 'nullable|numeric', // <--- Validasi WA (Angka Saja)
            'maps_embed'      => 'nullable|string',  // String kode iframe
        ]);

        // 2. Siapkan data dasar yang akan diupdate
        $dataToUpdate = [
            'app_name'        => $request->app_name,
            'instagram_link'  => $request->instagram_link,
            'tiktok_link'     => $request->tiktok_link,
            'whatsapp_number' => $request->whatsapp_number, // <--- Masukkan WA ke data update
            'maps_embed'      => $request->maps_embed,
        ];

        // 3. Proses Logo menjadi Base64 jika ada file yang diupload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            
            // Ambil path sementara
            $path = $file->getRealPath();
            
            // Baca konten file
            $image = file_get_contents($path);
            
            // Encode ke Base64
            $base64 = base64_encode($image);
            
            // Simpan format lengkap: data:image/png;base64,.....
            $dataToUpdate['logo_path'] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        }

        // 4. Simpan ke Database
        // Update data jika id=1 ada, atau buat baru jika belum ada
        Setting::updateOrCreate(
            ['id' => 1], // Kunci pencarian (selalu id 1 untuk setting tunggal)
            $dataToUpdate // Data yang disimpan
        );

        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}