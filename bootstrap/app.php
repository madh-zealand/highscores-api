<?php

use App\Http\Errors\ApiErrorFactory;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\FrameGuard;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(FrameGuard::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(
            function (Throwable $exception, Request $request) {
                if ($request->is('api/*')) {
                    return ApiErrorFactory::create(
                        e: $exception,
                        request: $request,
                    );
                }
            },
        );
    })->create();
