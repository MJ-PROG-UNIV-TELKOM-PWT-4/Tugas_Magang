<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    protected $table = 'stock_transactions';

    protected $fillable = [
        'product_id',
        'user_id',
        'type',
        'quantity',
        'date',
        'status',
        'notes',
    ];

    public $timestamps = false;

    // Relasi: setiap transaksi milik satu produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi: setiap transaksi dilakukan oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
