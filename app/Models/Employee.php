<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected  $table='employees';
    protected  $primaryKey = 'id';

//    protected  $timestamps  = true;

    protected  $fillable = ['id','name','email','phone','address','city','experience','photo','salary'];

}
