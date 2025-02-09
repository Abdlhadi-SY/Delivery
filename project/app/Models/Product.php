<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded=[];
    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function favorite(){
        return $this->belongsToMany(User::class,"favorites");
    }

    public function user(){
        return $this->belongsToMany(User::class,"carts");
    }
}
