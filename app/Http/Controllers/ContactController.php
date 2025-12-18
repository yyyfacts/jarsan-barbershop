<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Simpan Pesan dari User (Frontend)
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);

        Contact::create($data);

        return redirect()->back()->with('success', 'Pesan Anda telah terkirim!');
    }

    // Tampilkan Pesan di Admin
    public function index()
    {
        $contacts = Contact::latest()->get();
        
        // PENTING: Mengarah ke 'resources/views/admin/hubungikami.blade.php'
        return view('admin.hubungikami', compact('contacts'));
    }

    // Hapus Pesan
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->back()->with('success', 'Pesan berhasil dihapus.');
    }
}