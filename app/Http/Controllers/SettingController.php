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
        'app_name'        => 'required|string|max:255',
        'logo'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'instagram_link'  => 'nullable|url',
        'tiktok_link'     => 'nullable|url',
        'whatsapp_number' => 'nullable|numeric',
        'maps_embed'      => 'nullable|string',
        // VALIDASI BARU
        'hero_title'      => 'nullable|string|max:100',
        'hero_subtitle'   => 'nullable|string|max:500',
    ]);

    $dataToUpdate = [
        'app_name'        => $request->app_name,
        'instagram_link'  => $request->instagram_link,
        'tiktok_link'     => $request->tiktok_link,
        'whatsapp_number' => $request->whatsapp_number,
        'maps_embed'      => $request->maps_embed,
        // DATA BARU
        'hero_title'      => $request->hero_title,
        'hero_subtitle'   => $request->hero_subtitle,
    ];

    if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        $path = $file->getRealPath();
        $image = file_get_contents($path);
        $base64 = base64_encode($image);
        $dataToUpdate['logo_path'] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
    }

    Setting::updateOrCreate(['id' => 1], $dataToUpdate);

    return redirect()->back()->with('success', 'Pengaturan berhasil disimpan!');
}
}