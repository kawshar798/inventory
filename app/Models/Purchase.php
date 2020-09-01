<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //

    public  function  supplier(){
        return $this->hasOne(Supplier::class,'id','supplier_id');
    }
    public  function  purchaseProduct(){
        return $this->hasMany(ProductPurchase::class,'purchase_id','id');
    }
}
