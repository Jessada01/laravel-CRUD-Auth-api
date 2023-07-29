<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; //
use Illuminate\Support\Facades\Hash;    //
use Illuminate\Support\Auth;    //
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string' ,
            'email' => 'required|string|unique:users,email' ,
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'] ,
            'email' => $fields['email'] ,
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
   }

   public function login(Request $request)
   {
        $fields = $request->validate([
            'email' => 'required|string' ,
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first(); //Checkmail

        if(!$user || !Hash::check($fields['password'],$user->password)) //CheckPass
        {
            return response([
                'message' => 'Email and Password Incorrect'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);

   }
   public function logout(Request $request)
   {
        auth()->user()->token()->delete();

        return[
            'message' => 'Logged out'
        ];
   }


}
