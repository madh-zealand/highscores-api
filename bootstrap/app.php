<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(
            fn (NotFoundHttpException $exception, Request $request) => response()->json(
                data: [
                    'title' => 'Resource not found',
                    'detail' => 'The resource you are looking for could not be found.',
                    'instance' => $request->fullUrl(),
                ],
                status: Response::HTTP_NOT_FOUND
            ));
    })->create();
