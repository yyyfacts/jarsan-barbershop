<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Menampilkan Form Edit
    public function edit()
    {
        return view('user.edit_profile');
    }

    // Proses Update ke Database
    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update Nama
        $user->name = $request->name;

        // Logic Upload Foto ke Database (BLOB / Base64)
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            
            // Ubah gambar jadi string Base64
            $imageData = base64_encode(file_get_contents($image));
            
            // Format data agar bisa dibaca browser
            $src = 'data:'. $image->getMimeType() . ';base64,' . $imageData;

            // Simpan ke kolom avatar_blob
            $user->avatar_blob = $src;
        }

        $user->save();

        return redirect()->route('dashboard')->with('success', 'Profil berhasil diperbarui!');
    }
}