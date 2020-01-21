<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected  $table='products';
    protected  $primaryKey = 'id';

//    protected  $timestamps  = true;

    protected  $fillable = ['id',
        'name',
        'type',
        'description',
        'unit_id',
        'brand_id',
        'category_id',
        'sub_category_id',
        'tax',
        'tax_type',
        'quantity',
        'alert_quantity',
        'sku',
        'image',
        'cost_price',
        'mrp',
        'featured',
        'barcode',
        'status',
        ];
}
