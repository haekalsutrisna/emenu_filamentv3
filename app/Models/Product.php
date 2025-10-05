<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'product_category_id',
        'image',
        'name',
        'description',
        'price'
    ];
};
