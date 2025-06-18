<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Daftar exception yang tidak perlu dilaporkan.
     */
    protected $dontReport = [
        //
    ];

    /**
     * Daftar input yang tidak akan disertakan dalam response validasi.
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Laporkan atau log exception.
     */
    public function report(Throwable $exception): void
    {
        parent::report($exception);
    }

    /**
     * Render exception ke dalam HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        // Jika tidak terautentikasi
        if ($exception instanceof AuthenticationException) {
            return response()->json([
                'message' => 'Unauthorized or token expired',
            ], 401);
        }

        // Validasi gagal
        if ($exception instanceof ValidationException) {
            return response()->json([
                'message' => 'Validation error',
                'errors'  => $exception->errors(),
            ], 422);
        }

        // Error lainnya (fallback JSON response)
        $status = 500;
        if ($exception instanceof HttpExceptionInterface) {
            $status = $exception->getStatusCode();
        }

        return response()->json([
            'message' => $exception->getMessage(),
            'trace'   => config('app.debug') ? $exception->getTrace() : [],
        ], $status);
    }
}
