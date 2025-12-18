<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Izinkan kolom ini diisi
    protected $fillable = [
        'name',
        'price',
        'duration',
        'description',
        'image_path',
    ];
}