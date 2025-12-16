<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi (mass assignable)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',      // ✅ tambahkan
        'active',    // ✅ tambahkan
        'profile_photo',
    ];

    /**
     * Kolom yang disembunyikan
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting kolom
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'active' => 'boolean',   // ✅ supaya otomatis true/false
    ];

    /**
     * Relasi ke tabel pelanggan
     */
    public function pelanggan()
    {
        return $this->hasOne(Pelanggan::class);
    }

    /**
     * Relasi ke tabel admin
     */
    public function admin()
    {
        return $this->hasOne(Admin::class);
    }
    public function manajemenInspektor()
    {
        return $this->hasOne(ManajemenInspektor::class);
    }
}