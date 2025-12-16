<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkPackageSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'aircraft_program_id',
        'contract_number',
    ];

    // Relasi ke program
    public function program()
    {
        return $this->belongsTo(AircraftProgram::class, 'aircraft_program_id');
    }

    // Relasi ke item
    public function items()
    {
        return $this->hasMany(WorkPackageItem::class);
    }
}