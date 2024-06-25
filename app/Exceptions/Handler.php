<?php
namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

// class Handler extends ExceptionHandler
// {
//     /**
//      * A list of the exception types that should not be reported.
//      *
//      * @var array
//      */
//     protected $dontReport = [
//         AuthorizationException::class,
//         HttpException::class,
//         ModelNotFoundException::class,
//         ValidationException::class,
//     ];

//     /**
//      * Report or log an exception.
//      *
//      * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
//      *
//      * @param  \Throwable  $exception
//      * @return void
//      *
//      * @throws \Exception
//      */
//     public function report(Throwable $exception)
//     {
//         parent::report($exception);
//     }

//     /**
//      * Render an exception into an HTTP response.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \Throwable  $exception
//      * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
//      *
//      * @throws \Throwable
//      */
//     public function render($request, Throwable $exception)
//     {
//         return parent::render($request, $exception);
//     }



class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // Manejar errores de validación
        if ($exception instanceof ValidationException) {
            return response()->json([
                'message' => 'Datos de entrada inválidos',
                'errors' => $exception->errors()
            ], 422);
        }

        // Manejar errores de autorización
        if ($exception instanceof AuthorizationException) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        // Manejar errores 404 (Not Found)
        if ($exception instanceof ModelNotFoundException) {
            return response()->json(['message' => 'Recurso no encontrado'], 404);
        }

        // Manejar excepciones HTTP generales
        if ($exception instanceof HttpException) {
            $statusCode = $exception->getStatusCode();
            $message = $exception->getMessage() ?: 'Error HTTP';

            return response()->json(['message' => $message], $statusCode);
        }

        // Manejar errores 500 (Internal Server Error)
        return response()->json([
            'message' => 'Ocurrió un error en el servidor. Por favor, inténtelo de nuevo más tarde.'
        ], 500);
    }

}
