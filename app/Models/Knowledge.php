<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Knowledge extends Model
{
    protected $table = 'knowledge';

    protected $fillable = [
        'title',
        'description',
        'category',
        'file',
        'created_by',
        'status'
    ];

    // app/Models/Knowledge.php

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    // app/Models/Knowledge.php

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}