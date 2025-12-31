<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    /**
     * DAFTAR KOLOM YANG BOLEH DIISI
     * Pastikan 'barber_id' ada di sini!
     */
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'date',
        'time',
        'service_id',
        'barber_id', // <--- INI WAJIB ADA
        'notes',
        'status',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Relasi ke Barber (Agar nama barber bisa muncul di Dashboard)
    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }
}