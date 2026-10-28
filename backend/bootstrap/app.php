<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Todos los errores de la API con el mismo formato: {"mensaje": "...", "errores": {...}}
        $exceptions->render(function (Throwable $e, Request $request) {
            if (! $request->is('api/*')) {
                return null;
            }

            if ($e instanceof ValidationException) {
                return response()->json([
                    'mensaje' => 'Revise los datos, falta algo o está mal escrito.',
                    'errores' => $e->errors(),
                ], 422);
            }

            $codigo = $e instanceof HttpExceptionInterface ? $e->getStatusCode() : 500;
            $mensaje = match ($codigo) {
                404 => 'No encontramos lo que busca.',
                405 => 'Esa acción no está permitida aquí.',
                429 => 'Demasiados intentos seguidos. Espere un minuto y vuelva a intentar.',
                500 => 'Algo falló. Intente de nuevo.',
                default => $e->getMessage() ?: 'Algo falló. Intente de nuevo.',
            };

            return response()->json(['mensaje' => $mensaje, 'errores' => (object) []], $codigo);
        });
    })->create();
