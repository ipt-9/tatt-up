<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(){}
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'errors' => ['general' => 'E-Mail or Password wrong.']
            ], 422);

        }
        return ['token' => $request->user()->createToken('auth_token')->plainTextToken];

    }
    public function checkAuth(Request $request)
    {
        return UserResource::make($request->user());
    }
    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

}
