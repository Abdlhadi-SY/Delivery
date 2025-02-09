<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showproduct(Request $request){
        return Product::where("id",$request->id)->first();
    }

    public function searchProductInDashboard(Request $request){
        $listofstores=[];
        $Products=Product::all();

        foreach($Products as $product){
            if($product->name==$request->name){
                $id=$product->store_id;
                $store=Store::find($id);
                array_push($listofstores,$store);
            }
        }

        return $listofstores;
    }

    public function searchProductInStore(Request $request){
        $Products=Store::where('name',$request->storeName)->first()->products;
        foreach($Products as $product){
            if($product->name==$request->productName){
                return $product;
            }
        }
        return response()->json(["message"=>"Product is not found"]);
    }

    public function showAllProducts(Request $request){
        return Product::all();
    }

}
