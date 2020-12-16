<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleReturn extends Model
{
    //
    public  function  productSaleReturns(){
        return $this->hasMany(ProductSaleReturn::class,'sale_return_id','id');
    }

    public  function  customer(){
        return $this->hasOne(Customer::class,'id','customer_id');
    }
}
