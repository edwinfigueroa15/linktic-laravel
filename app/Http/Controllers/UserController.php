<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token =  $user->createToken('user-token')->plainTextToken;
            $user->remember_token = $token;
            $user->save();
            return [
                'token' => $token,
            ];
        }
    }

    public function signup(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = HASH::make($request->password);
        $user->email_verified_at = now();
        $user->save();
        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token =  $user->createToken('user-token')->plainTextToken;
            $user->remember_token = $token;
            $user->save();
            return [
                'token' => $token,
            ];
        }

    }
}
