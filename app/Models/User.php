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
     * Table tidak memiliki kolom created_at dan updated_at
     */
    public $timestamps = false; 

    /**
     * Kolom yang dapat diisi massal
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password', // Pastikan ini terisi
        'role',
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token', // Hanya tidak menyembunyikan password
    ];

    /**
     * Casting kolom ke tipe tertentu
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}