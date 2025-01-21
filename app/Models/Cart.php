<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
        'total_price',
        'status', // enum: cart, checkout, cancel
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
