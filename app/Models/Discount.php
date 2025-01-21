<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';
    protected $fillable = [
        'name', 
        'code', 
        'discount_nominal', 
        'percentage',
        'start_date', 
        'end_date', 
        'start_time', 
        'end_time', 
        'day_only',
        'min_transaction', 
        'status',
        'description'
    ];
}
