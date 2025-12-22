<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WikiLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'wiki_id',
        'action',
        'user_id',
        'notes',
    ];

    // Relasi ke Wiki
    public function wiki()
    {
        return $this->belongsTo(Wiki::class);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}