<?php

namespace App\Http\Controllers;

use App\Repositories\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        $email = $request->get('email');

        $response = $this->authService->register($username, $password, $email);
        if (isset($response['error']))
            return $response;
        return response(['message' => 'Registration successful', 'username' => $username]);
    }

    public function login(Request $request) {
        $credentials = $request->only('username', 'password');

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json(['token' => $token], 200);
    }
}
