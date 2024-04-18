<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function Laravel\Prompts\password;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $userData = json_decode($request->getContent(), true);

        $validator = Validator::make($userData, [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,tattooer,designer',
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }
        //New user instance
        $user = new User();
        $user->username = $userData['username'];
        $user->email = $userData['email'];
        $user->password = bcrypt($userData['password']);
        $user->role = $userData['role'];
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
