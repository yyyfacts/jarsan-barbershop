<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Pastikan nama tabel di database 'services'
    protected $table = 'services';

    protected $fillable = [
        'name',
        'price',
        'duration_minutes',
        'description',
        'image_path',
        'is_active'
    ];

    /**
     * Casting tipe data otomatis
     * Berguna agar saat data diambil, tipenya sudah sesuai (bukan string semua)
     */
    protected $casts = [
        'price' => 'integer',          // Pastikan harga dianggap angka
        'duration_minutes' => 'integer',
        'is_active' => 'boolean',      // Mengubah 1/0 di database menjadi true/false di PHP
    ];
}