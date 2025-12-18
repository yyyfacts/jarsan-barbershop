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
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        Contact::create($data);
        return redirect()->back()->with('success', 'Pesan Anda telah terkirim!');
    }

    // ADMIN LIHAT PESAN
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contacts.index', compact('contacts'));
    }

    // ADMIN HAPUS PESAN
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Pesan dihapus.');
    }
}