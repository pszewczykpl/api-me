<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
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
         * Currently app supports only one user, so we check if user exists.
         * If user exists, we return error.
         */
        if(User::exists()) {
            return response([
                'message' => 'User already exists.'
            ]);
        }

        /**
         * Validation rules.
         */
        $fields = $request->validate([
            'email' => 'required|email|unique:users',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'password' => 'required|string|min:8',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:9',
            'www' => 'nullable|url',
            'social_facebook' => 'nullable|url',
            'social_twitter' => 'nullable|url',
            'social_linkedin' => 'nullable|url',
            'social_github' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        /**
         * Creating user.
         */
        $user = User::create([
            'first_name' => $fields['first_name'],
            'last_name' => $fields['last_name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'address' => $fields['address'],
            'phone' => $fields['phone'],
            'www' => $fields['www'],
            'social_facebook' => $fields['social_facebook'],
            'social_twitter' => $fields['social_twitter'],
            'social_linkedin' => $fields['social_linkedin'],
            'social_github' => $fields['social_github'],
            'description' => $fields['description'],
        ]);

        /**
         * Create token for user.
         */
        $token = $user->createToken('auth_token')->plainTextToken;

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
         * Validation of credentials.
         */
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        /**
         * User with provided email.
         */
        $user = User::where('email', $request->email)->first();

        /**
         * Check if credentials are correct and return error if not.
         */
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'The provided credentials are incorrect.',
            ], 401);
        }

        /**
         * Create token for user.
         */
        $token = $user->createToken('auth_token')->plainTextToken;

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
        /**
         * Delete all tokens for user.
         */
        auth('sanctum')->user()->tokens()->delete();

        return response([
            'message' => 'Logged out.'
        ]);
    }
}
