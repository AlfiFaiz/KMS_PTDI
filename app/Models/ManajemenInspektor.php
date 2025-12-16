<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManajemenInspektor extends Model
{
    use HasFactory;
    protected $table = 'manajemen_inspektor';

    protected $fillable = [
        'user_id',
        'role_detail',
        'departemen',
        'posisi',
        'nomor_pegawai',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}