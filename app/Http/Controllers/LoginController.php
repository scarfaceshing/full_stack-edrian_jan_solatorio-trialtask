<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    const UNAUTHORIZED = 401;

    function login(LoginRequest $request) 
    {
        $username = $request->username;
        $user = User::where(['username' => $request->username])->first();
        $user_password = $user->password;
        $is_valid = Hash::check($request->password, $user_password);

        if ($user->exists() && $is_valid) {
            $role = $user->is_admin;

            if ($role === 'ADMIN') {
                $token = $user->createToken('API-TOKEN', ['is-admin']);
            } else if ($role === 'USER') {
                $token = $user->createToken('API-TOKEN', ['is-user']);
            }
        
            return response()->json([
                'user' => $user,
                'token' => $token->plainTextToken
            ]);
        }
        
        return response()->json([
            'message' => 'Authentication failed',
        ], self::UNAUTHORIZED);
    }

    function logout(Request $request) {
        try {
            $request->user()->tokens()->delete();
            
            return response()->json('Logout success');
        } catch (Exception $e) {
            return response()->json('Login first');
        }
    }
}
