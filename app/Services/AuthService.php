<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthService
{
    public function login(array $credentials): array
    {
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return [
                    'status' => false,
                    'message' => 'Invalid credentials',
                    'code' => 401,
                ];
            }

            return [
                'status' => true,
                'token' => $token,
            ];

        } catch (JWTException $e) {
            return [
                'status' => false,
                'message' => 'Could not create token',
                'code' => 500,
            ];
        }
    }

    public function register(array $data): array
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $token = JWTAuth::fromUser($user);

        return [
            'status' => true,
            'token' => $token,
            'user' => $user,
        ];
    }

    public function logout(): void
    {
        auth()->logout();
    }
}
