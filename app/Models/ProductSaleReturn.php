<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSaleReturn extends Model
{
    //
    public  function  product(){
        return $this->hasOne(Product::class,'id','product_id');
    }
}
