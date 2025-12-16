<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkPackageItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_package_summary_id',
        'section',
        'item',
        'status',
        'remarks',
    ];

    // Relasi ke summary
    public function summary()
    {
        return $this->belongsTo(WorkPackageSummary::class, 'work_package_summary_id');
    }
}