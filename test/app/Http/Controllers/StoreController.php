<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function showStores(){
        return Store::all();
    }
    public function showStore(Request $request){
        return Store::where('name',$request->name)->first();
    }
}