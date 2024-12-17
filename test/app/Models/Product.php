<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded=[];
    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function users(){
        return $this->belongsToMany(User::class,"Purchasiners");
    }
}
