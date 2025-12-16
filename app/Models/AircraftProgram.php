<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AircraftProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'program',
        'aircraft_type',
        'registration',
        'company_id',
        'image',
    ];

    // Relasi: satu program milik satu company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Relasi: satu program punya banyak engineering orders
    public function engineeringOrders()
    {
        return $this->hasMany(EngineeringOrder::class, 'aircraft_id');
    }
}