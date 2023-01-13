<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleLine extends Model
{
    use HasFactory;
    protected $fillable = [
        'integration_id',
        'product_id',
        'quantity',
        'price_unit',
        'price_discount',
        'price_subtotal',
        'price_discount_total',
        'price_total',
    ];
}
