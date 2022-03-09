<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function logout(){
        $cookie=Cookie::forget('jwt');

        return response([
            'message' => 'Vous êtes deconnecté'
        ])->withCookie(($cookie));
        }

        public function login(Request $request)
        {
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'success' => true,
                    'message' => 'Informations entrées invalide',
                    'status' =>201
                ]);
            }
            $user = User::where('email', $request['email'])->firstOrFail();
            $token=$user->createToken('token')->plainTextToken;
            $date=time();
            return response()->json([
                'username' =>$user->name,
                'success' => true,
                'dateToken' =>$date,
                'token' => 'Bearer '.$token,
                'status'=>200
            ]);
        }

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
        $token = $user->createToken('token')->plainTextToken;
        return response()->json([
            'success' => true,
            'token' => 'Bearer '.$token,
            'status' =>200
        ]);
    }

}
