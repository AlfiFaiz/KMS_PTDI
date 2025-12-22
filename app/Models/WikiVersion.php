<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WikiVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'wiki_id','title','category','tags','content','status','edited_by','edited_at'
    ];
    protected $casts = [
    'edited_at' => 'datetime',
];


    public function wiki() {
        return $this->belongsTo(Wiki::class);
    }

    public function editor() {
        return $this->belongsTo(User::class,'edited_by');
    }
    public function logs()
{
    return $this->hasMany(WikiLog::class);
}
}

