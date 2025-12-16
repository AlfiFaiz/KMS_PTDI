<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'nomor',
        'judul',
        'date_issued',
        'issued_by',
        'file_path',
    ];
}