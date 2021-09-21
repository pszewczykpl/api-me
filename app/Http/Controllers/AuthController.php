<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required',
        ]);

        if(User::where('main', True)->count() > 0) {
            $main = False;
        } else {
            $main = True;
        }

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'main' => $main,
        ]);

        $token = $user->createToken('apimetoken')->plainTextToken;

        return array(
            'user' => $user,
            'token' => $token
        );
    }

    /**
     *
     */
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return [
                'message' => 'The provided credentials are incorrect.',
            ];
        }

        $token = $user->createToken('apimetoken')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function logout(Request $request) {
        auth('sanctum')->user()->tokens()->delete();

        return [
            'message' => 'Logged out.'
        ];
    }
}
