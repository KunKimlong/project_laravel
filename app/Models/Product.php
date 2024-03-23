<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'color',
        'size',
        'regular_price',
        'discount',
        'thumbnail',
        'stock_qty',
        'sale_price',
        'user_id',
        'category_id',
    
    ];
}
