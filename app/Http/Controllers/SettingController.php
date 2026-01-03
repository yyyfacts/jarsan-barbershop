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
        // 1. Validasi Input
        $request->validate([
            // Identitas & Kontak
            'app_name'        => 'required|string|max:255',
            'logo'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'instagram_link'  => 'nullable|url',
            'tiktok_link'     => 'nullable|url',
            'whatsapp_number' => 'nullable|numeric',
            'maps_embed'      => 'nullable|string',

            // Hero Section (Banner Utama)
            'hero_title'      => 'nullable|string',
            'hero_subtitle'   => 'nullable|string',
            'hero_btn_text'   => 'nullable|string|max:50',
            // Validasi Gambar Banner
            'hero_image'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', 

            // Services Section
            'services_subtext'=> 'nullable|string|max:100',
            'services_title'  => 'nullable|string|max:100',
            
            'service_1_title' => 'nullable|string|max:100',
            'service_1_desc'  => 'nullable|string',
            
            'service_2_title' => 'nullable|string|max:100',
            'service_2_desc'  => 'nullable|string',
            
            'service_3_title' => 'nullable|string|max:100',
            'service_3_desc'  => 'nullable|string',

            // Testimonial Section
            'testimonial_title' => 'nullable|string|max:100',
        ]);

        // 2. Siapkan Data
        // Kecualikan file input dari array data langsung
        $dataToUpdate = $request->except(['logo', 'hero_image', '_token', '_method']);

        // 3. PROSES UPLOAD HERO IMAGE (Ubah ke Base64 untuk Vercel)
        // Kita tidak menggunakan Storage::put karena Vercel Read-Only
        if ($request->hasFile('hero_image')) {
            $file = $request->file('hero_image');
            $path = $file->getRealPath();
            $image = file_get_contents($path);
            $base64 = base64_encode($image);
            
            // Simpan sebagai string Base64 lengkap (Data URI)
            $dataToUpdate['hero_image'] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        }

        // 4. PROSES UPLOAD LOGO (Base64)
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = $file->getRealPath();
            $image = file_get_contents($path);
            $base64 = base64_encode($image);
            
            $dataToUpdate['logo_path'] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        }

        // 5. Simpan ke Database
        Setting::updateOrCreate(['id' => 1], $dataToUpdate);

        return redirect()->back()->with('success', 'Semua konten website berhasil diperbarui!');
    }
}