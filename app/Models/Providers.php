<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Providers extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'country',
        'city',
        'state',
        'address',
        'postcode',
        'phone_number',
        'email',
    ];
}
