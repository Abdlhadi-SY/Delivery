<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
            $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|unique:users|Digits:10',
            'password' => 'required|string|min:8',
            ]);

        $user=User::create([
            "first_name"=>$request->first_name,
            "last_name"=>$request->last_name,
            "phone"=>$request->phone,
            "password"=>Hash::make($request->password),
            "image"=>""
        ]);
        $token=$user->createToken("auth_token")->plainTextToken;
        return response()->json([
            "message"=>"registered successfully",
            "token"=>$token
        ]);
    }

    public function login(Request $request){
        $request->validate([
            "phone" => "required|Digits:10",
            "password" => "required|string"
        ]);

        if(!Auth::attempt($request->only("phone","password"))){
            return response()->json(["message"=>"Invalid phone or password"]);
        }
        $user=User::where("phone",$request->phone)->firstorfail();
        $token=$user->createToken("auth_token")->plainTextToken;
        return response()->json([
            "message"=>"Login success",
            "token"=>$token
        ]);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(["message"=>"Logout success"]);
    }

}
