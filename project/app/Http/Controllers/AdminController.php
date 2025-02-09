<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;

class AdminController extends Controller
{
    public function addStore(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $name=$request->file('image')->getClientOriginalName();
        $image=$request->file('image')->storeAs('storeImages',$name,"images");
        Store::create([
            "name"=>$request->name,
            "location"=>$request->location,
            "image"=>$image
        ]);
    }
    public function addProduct(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'store_id' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $name=$request->file('image')->getClientOriginalName();
        $image=$request->file('image')->storeAs('productImages',$name,"images");
        Product::create([
            "name"=>$request->name,
            "store_id"=>$request->store_id,
            "description"=>$request->description,
            "amount"=>$request->amount,
            "price"=>$request->price,
            "image"=>$image
        ]);
    }
}
