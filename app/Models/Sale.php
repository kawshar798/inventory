<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //

    public  function  user(){
        return $this->hasOne(User::class,'id','biller_id');
    }
    public  function  customer(){
        return $this->hasOne(Customer::class,'id','customer_id');
    }

    public  function  productSales(){
        return $this->hasMany(ProductSale::class,'sale_id','id');
    }
}
