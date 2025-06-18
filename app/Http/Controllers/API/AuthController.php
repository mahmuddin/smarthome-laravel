<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

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
        $result      = $this->authService->login($credentials);

        if (! $result['status']) {
            return response()->json(['error' => $result['message']], $result['code']);
        }

        return response()->json(['token' => $result['token']]);
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        // Default role jika tidak diberikan
        $validated['role'] = $validated['role'] ?? 'admin';

        // Proses register via service
        $result = $this->authService->register($validated);

        return response()->json([
            'token' => $result['token'],
            'user'  => $result['user'],
        ], 201);
    }

    public function me()
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            return response()->json($user);
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'Token has expired'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'Token is invalid'], 401);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token not found or other error'], 401);
        }
    }

    public function logout()
    {
        $this->authService->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
