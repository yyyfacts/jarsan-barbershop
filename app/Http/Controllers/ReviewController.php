<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $reservation = Reservation::findOrFail($request->reservation_id);

        // Pastikan user yang login adalah pemilik reservasi
        if ($reservation->user_id != Auth::id()) {
            return abort(403, 'Unauthorized action.');
        }

        // Cek apakah sudah pernah review
        $existingReview = Review::where('reservation_id', $reservation->id)->first();
        if ($existingReview) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk layanan ini.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'barber_id' => $reservation->barber_id, 
            'reservation_id' => $reservation->id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return back()->with('success', 'Terima kasih! Ulasan Anda berhasil dikirim.');
    }
}