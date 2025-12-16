<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QMS extends Model
{
    use HasFactory;

    protected $table = 'qms'; // kalau kamu mau pastikan manual

    protected $fillable = [
        'nomor',
        'judul',
        'date_issued',
        'org',
        'rev',
        'amend',
        'affected_function',
        'type',
        'file_path', // <- pastikan ini juga ada
    ];
}



