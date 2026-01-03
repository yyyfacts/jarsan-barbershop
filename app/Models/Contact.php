<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Tabel: 'contacts' (default Laravel)
    protected $table = 'contacts';

    protected $fillable = [
        'name',
        'email',
        'message'
    ];
}