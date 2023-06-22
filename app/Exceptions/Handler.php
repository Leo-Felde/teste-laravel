<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson() || $request->is('api/*')) {
            // Handle API-specific exceptions
            if ($exception instanceof HttpResponseException) {
                return $exception->getResponse();
            }

            // Handle validation errors
            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                return response()->json(['errors' => $exception->errors()], 422);
            }

            // Handle other exceptions
            return response()->json(['message' => $exception->getMessage()], 500);
        }

        return parent::render($request, $exception);
    }
}