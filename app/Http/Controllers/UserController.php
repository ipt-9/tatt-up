<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use function Laravel\Prompts\password;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,tattooer,designer',
        ]);
        //New user instance
        $user = new User();
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->role = $validatedData['role'];
        $user->save();

        //return UserResource::make($user);
        return response()->json(['message' => 'User created successfully'], 201);
        //return redirect('/login')->with('success', 'User registered successfully!');
    }

    public function checkUsernameExists($username)
    {
        $exists = User::where('username', $username)->exists();
        return response()->json($exists);
    }

    public function checkEmailExists($email)
    {
        $exists = User::where('email', $email)->exists();
        return response()->json($exists);
    }



}
