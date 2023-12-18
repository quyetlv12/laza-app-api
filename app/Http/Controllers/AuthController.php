<?php

namespace App\Http\Controllers;

use App\Mail\sendmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    // Registration
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);
        $userExists = User::where('email', $request->email)->exists();
        if (!$userExists) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);

            $user->createToken('MyApp')->accessToken;
            Mail::to($request->email)->send(new sendmail());
            return response()->json(['message' => 'Đăng kí tài khoản thành công'], 201);
        } elseif ($userExists) {
            # code...
            return response()->json(["message" => "Email đã được đăng kí"], 400);
        }
    }

    // Login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        // Retrieve the authenticated user
        $user = JWTAuth::user();
        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }
    public function logout()
    {
        // Invalidate the user's JWT token
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Logged out successfully']);
    }
}
