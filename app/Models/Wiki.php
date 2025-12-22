<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wiki extends Model
{
    use HasFactory;

    protected $fillable = [
    'title',
    'slug',
    'category',
    'tags',
    'content',
    'status',
    'created_by',
    'updated_by',     // siapa terakhir edit
    'reviewed_at',    // waktu review
    'published_at',   // waktu publish
    'archived_at',    // waktu archive
];
    // Relasi ke user
    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function editor()
{
    return $this->belongsTo(User::class, 'updated_by');
}
    public function versions()
{
    return $this->hasMany(WikiVersion::class);
}
public function logs()
{
    return $this->hasMany(WikiLog::class);
}

}  
