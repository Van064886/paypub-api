<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render exceptions message
     * @param $request
     * @param Throwable $exception
     */
    public function render($request, Throwable $exception)
    {
        // Define custom responses for somes requests exceptions
        if ($exception instanceof ModelNotFoundException) {
            $model = $exception->getModel();

            return response()->json([
                'data' => [],
                'is_success' => false,
                'error_message' => "Élément inexistant !"
            ], 404);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'data' => [],
                'is_success' => false,
                'error_message' => "Route inexistante !"
            ], 404);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            $method = $request->method();

            return response()->json([
                'data' => [],
                'is_success' => false,
                'error_message' => "Méthode non autorisée !"
            ], 405);
        }

        if ($exception instanceof ValidationException && $request->expectsJson()) {
            $errorMsg = "";
            foreach ($exception->errors() as $error) {
                foreach ($error as $err) {
                    $errorMsg .= "\n $err";
                }
            }

            return response()->json([
                'data' => [],
                'is_success' => false,
                'error_message' => $errorMsg
            ], 422);
        }

        return parent::render($request, $exception);
    }
}
