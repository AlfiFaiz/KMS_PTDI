<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    // Nama tabel (opsional, Laravel default pakai plural dari nama model)
    protected $table = 'infos';

    // Kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'title',
        'content',
        'image_path',
    ];
}