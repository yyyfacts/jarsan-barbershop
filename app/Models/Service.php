<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // PERBAIKAN: Ganti 'duration' menjadi 'duration_minutes'
    protected $fillable = [
        'name',
        'price',
        'duration_minutes', // INI YANG BENAR
        'description',
        'image_path',
        'is_active'
    ];
}