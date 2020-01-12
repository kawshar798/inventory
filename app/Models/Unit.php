<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    protected  $table='units';
    protected  $primaryKey = 'id';
    protected $fillable = ['id', 'name', 'slug'];
}
