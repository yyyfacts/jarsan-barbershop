<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        // Ambil data setting pertama
        $setting = Setting::first();
        // Passing variabel '$setting' (tunggal) ke view
        return view('admin.setting', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required',
            'logo' => 'nullable|image|max:2048'
        ]);

        $setting = Setting::first();
        $updateData = ['app_name' => $request->app_name];

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->getRealPath();
            $image = file_get_contents($path);
            $base64 = base64_encode($image);
            $updateData['logo_path'] = 'data:image/' . $request->file('logo')->extension() . ';base64,' . $base64;
        }

        if ($setting) {
            $setting->update($updateData);
        } else {
            Setting::create($updateData);
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan');
    }
}