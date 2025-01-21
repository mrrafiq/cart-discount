<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartDiscount extends Model
{
    protected $table = 'cart_discounts';
    protected $fillable = ['cart_id', 'discount_id'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
}
