<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $result = $this->authService->login($credentials);

        if (!$result['status']) {
            return response()->json(['error' => $result['message']], $result['code']);
        }

        return response()->json(['token' => $result['token']]);
    }

    public function register(Request $request)
    {
        $data = $request->only('name', 'email', 'password');
        $result = $this->authService->register($data);

        return response()->json([
            'token' => $result['token'],
            'user' => $result['user'],
        ]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        $this->authService->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
