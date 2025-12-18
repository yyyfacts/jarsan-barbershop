<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    // USER LIHAT
    public function index()
    {
        $about = About::first();
        // View User Frontend
        return view('about', compact('about'));
    }

    // ADMIN EDIT
    public function edit()
    {
        $about = About::first() ?? new About();
        // PERBAIKAN: Langsung ke file 'admin/tentangkami.blade.php'
        return view('admin.tentangkami', compact('about'));
    }

    // ADMIN UPDATE
    public function update(Request $request)
    {
        $data = $request->validate([
            'history' => 'nullable|string',
            'mission' => 'nullable|string',
            'history_image' => 'nullable|image|max:2048',
            'mission_image' => 'nullable|image|max:2048',
        ]);

        $about = About::firstOrNew();

        if ($request->hasFile('history_image')) {
            if ($about->history_image) Storage::disk('public')->delete($about->history_image);
            $data['history_image'] = $request->file('history_image')->store('about', 'public');
        }

        if ($request->hasFile('mission_image')) {
            if ($about->mission_image) Storage::disk('public')->delete($about->mission_image);
            $data['mission_image'] = $request->file('mission_image')->store('about', 'public');
        }

        $about->fill($data)->save();

        return redirect()->back()->with('success', 'Tentang Kami diperbarui!');
    }
}