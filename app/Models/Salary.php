<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    //

    protected  $table='advanced_salaries';
    protected  $primaryKey = 'id';
    protected  $fillable = ['id','employee_id','month','year','advanced_salary','status'];
}
