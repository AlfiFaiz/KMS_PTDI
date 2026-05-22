<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'knowledge_id',
        'user_id',
        'comment'
    ];

    public function knowledge()
    {
        return $this->belongsTo(Knowledge::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}