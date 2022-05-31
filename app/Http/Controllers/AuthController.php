<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function register(Request $request) {
        /**
         * Only 1 user for app (me)
         */
        if(User::exists()) {
            return response([
                'message' => 'User already exists.'
            ]);
        }

        /**
         * Validation
         */
        $fields = $request->validate([
            'email' => 'required|email|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
        ]);

        /**
         * Creating user
         */
        $user = User::create([
            'first_name' => $fields['first_name'],
            'last_name' => $fields['last_name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        /**
         * Create token
         */
        $token = $user->createToken('apimetoken')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function login(Request $request): Response
    {
        /**
         * Validation
         */
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        /**
         * User
         */
        $user = User::where('email', $request->email)->first();

        /**
         * Check if credentials are correct
         */
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'The provided credentials are incorrect.',
            ], 401);
        }

        /**
         * Create tokek
         */
        $token = $user->createToken('apimetoken')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request): Response
    {
        auth('sanctum')->user()->tokens()->delete();

        return response([
            'message' => 'Logged out.'
        ]);
    }
}
