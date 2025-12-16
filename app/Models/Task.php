<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name', 'description'];

    public function engineeringOrders()
    {
        return $this->hasMany(EngineeringOrder::class, 'task_id');
    }
}