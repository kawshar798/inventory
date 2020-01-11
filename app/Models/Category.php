<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    protected  $table='categories';
    protected  $primaryKey = 'id';
    protected $fillable = [
        'name', 'slug', 'description', 'parent_id', 'featured', 'status', 'image'
    ];

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(){
        return $this->hasMany(Category::class, 'parent_id');
    }
}
