<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMapIntegration extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'providers_id',
        'field_id',
        'field_name',
        'field_description',
        'field_price',
        'field_discountValue',
        'field_hasDiscount',
        'field_material',
        'field_category',
        'field_images',
        'field_departaments',
        'api_url',
        'api_token',
        'api_username',
        'api_password',
    ];

    public function provider(){
        return $this->hasOne(Providers::class,'id','provider_id');
    }
}
