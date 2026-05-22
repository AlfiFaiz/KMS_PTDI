<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WikiHelpful extends Model
{
    protected $fillable = [
        'wiki_id',
        'user_id',
    ];

    public $timestamps = false;

    public function wiki()
    {
        return $this->belongsTo(Wiki::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}