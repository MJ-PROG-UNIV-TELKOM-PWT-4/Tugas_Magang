<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    
    protected $table = 'categories'; // Nama tabel di database
    protected $fillable = [
        'name',
        'description',
    ];

    public $timestamps = false;
}