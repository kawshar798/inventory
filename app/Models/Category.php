<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    protected  $table='categories';
    protected  $primaryKey = 'id';
    protected  $fillable = ['id','cat_name','slug','status'];
}
