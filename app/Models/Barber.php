<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    use HasFactory;

    protected $table = 'barbers'; // Memastikan nama tabel benar

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'specialty',
        'bio',
        'schedule',   // Pastikan tipe data di database adalah JSON
        'photo_path',
        'is_active',  // Boolean (1 = Aktif, 0 = Nonaktif)
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        // Otomatis ubah JSON database jadi Array PHP
        'schedule' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke Reviews (Opsional, nyalakan jika sudah ada tabel reviews)
     */
    /*
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    */
}