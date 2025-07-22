<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        //validation
        $data = $request->validate([
            'username' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'string|min:8|confirmed',
        ]);

       $user = \App\Models\User::create($data);

       return response()->json($user, 201);
    }

    public function login(Request $request){

       $data = $request->validate([
            'email' => 'required|string|email',
            'password' => 'string|min:8'
        ]);

        if(!Auth::attempt($data)){
            return response()->json(['message' => 'Invalid Credentials'], 401);
        }
        $user = Auth::user();

        $token = $user->createToken('auth_token',['*'],now()->addDay(1))->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);


    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
