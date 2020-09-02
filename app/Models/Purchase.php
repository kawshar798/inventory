<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //

    public  function  supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }
    public  function  purchaseProduct(){
        return $this->hasMany(ProductPurchase::class,'purchase_id','id');
    }
}
