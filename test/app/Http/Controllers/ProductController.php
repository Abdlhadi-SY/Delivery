<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // public function showProducts(Request $request){
    //     return Store::where('id',$request->id)->first()->products;
    // }
    // public function showProducts(){
    //     return Product::all();
    // }
    public function showProduct(Request $request){
        return Product::where('name',$request->name)->first();
    }
}
