<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'price_total',
        'price_subtotal',
        'price_discount',
    ];

    public function client(){
        return $this->belongsTo(client::class);
    }

    public function sale_line(){
        return $this->belongsToMany(SaleLine::class,'rel_sale_to_sale_lines');
    }
}
