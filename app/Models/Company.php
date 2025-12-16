<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'name',
        'address',
        'phone',
    ];
    public function pelanggan()
    {
        return $this->hasMany(Pelanggan::class, 'company_id');
    }

}