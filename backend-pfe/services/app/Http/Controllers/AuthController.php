<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Utilisateur;
use Illuminate\Http\Exceptions\HttpResponseException;


class AuthController extends Controller
{
    /**
     * Authenticate the user and generate a token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = $user->createToken('AuthToken')->plainTextToken;

        Session::put('user', $user);

        return response()->json(['user' => $user, 'token' => $token]);
    }

    throw new HttpResponseException(response()->json(['error' => 'Unauthorized'], 401));
}
    public function register(Request $request)
    {
        // Add validation logic here
        $user = Utilisateur::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['message' => 'User created successfully']);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
