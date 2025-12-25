<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting; // Pastikan Model Setting sudah dibuat
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        // Ambil data pertama, jika tidak ada buat baru (Singleton pattern sederhana)
        $settings = Setting::first(); 
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $setting = Setting::first();
        if (!$setting) {
            $setting = new Setting();
        }

        $setting->app_name = $request->app_name;

        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada dan bukan url avatar default
            if ($setting->logo_path && !str_contains($setting->logo_path, 'ui-avatars')) {
                // Logika hapus file lama dari storage (opsional tapi disarankan)
                // Storage::delete($setting->logo_path); 
            }

            // Simpan file baru ke folder public/logos
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/logos'), $filename);
            
            // Simpan path yang bisa diakses publik
            $setting->logo_path = asset('storage/logos/' . $filename);
        }

        $setting->save();

        return redirect()->back()->with('success', 'Pengaturan website berhasil diperbarui.');
    }
}