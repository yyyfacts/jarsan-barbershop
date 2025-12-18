<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // USER KIRIM PESAN
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

    // ADMIN LIHAT PESAN
    public function index()
    {
        $contacts = Contact::latest()->get();
        
        // PERBAIKAN: Langsung ke file 'admin/hubungikami.blade.php'
        return view('admin.hubungikami', compact('contacts'));
    }

    // ADMIN HAPUS PESAN
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->back()->with('success', 'Pesan dihapus.');
    }
}