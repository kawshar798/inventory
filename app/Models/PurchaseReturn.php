<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseReturn extends Model
{
    //
    //
    public  function  productPurchaseReturns(){
        return $this->hasMany(ProductPurchaseReturn::class,'purchase_return_id','id');
    }

    public  function  supplier(){
        return $this->hasOne(Supplier::class,'id','supplier_id');
    }
}
