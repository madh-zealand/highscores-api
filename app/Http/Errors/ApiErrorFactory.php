<?php

namespace App\Http\Errors;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class ApiErrorFactory
{
    public static function create(\Throwable $e, Request $request): JsonResponse
    {
        $error = match (true) {
            $e instanceof HttpException && $e->getStatusCode() === Response::HTTP_NOT_FOUND,
            $e instanceof ModelNotFoundException,
            $e instanceof NotFoundHttpException => new ApiError(
                status: Response::HTTP_NOT_FOUND,
                type: 'not-found',
                title: 'Resource not found',
                detail: 'The requested resource was not found.',
                instance: $request->fullUrl(),
            ),
            $e instanceof AccessDeniedHttpException => new ApiError(
                status: Response::HTTP_UNAUTHORIZED,
                type: 'unauthorized',
                title: 'Unauthorized',
                detail: 'The requested action is unauthorized.',
                instance: $request->fullUrl(),
            ),
            $e instanceof MethodNotAllowedException => new ApiError(
                status: Response::HTTP_METHOD_NOT_ALLOWED,
                type: 'method-not-allowed',
                title: 'Method not allowed',
                detail: "You are trying to do a {$request->method()} request on an endpoint that only allows {$e->getAllowedMethods()}",
                instance: $request->fullUrl(),
            ),
            $e instanceof ValidationException => new ApiError(
                status: Response::HTTP_UNPROCESSABLE_ENTITY,
                type: 'validation-error',
                title: 'Validation error',
                detail: 'You have validation errors in the request.',
                instance: $request->fullUrl(),
                additional: [
                    'errors' => $e->validator->errors()->toArray(),
                ],
            ),
            default => new ApiError(
                status: Response::HTTP_INTERNAL_SERVER_ERROR,
                type: 'internal-server-error',
                title: 'Internal server error',
                detail: 'An internal server error occurred.',
                instance: $request->fullUrl(),
            ),
        };

        $developmentExtra = app()->environment() === 'production'
            ? []
            : [
                'exception' => [
                    'class' => get_class($e),
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    // 'trace' => $e->getTrace(),
                ],
            ];

        return new JsonResponse(
            data: $error->toArray() + $developmentExtra,
            status: $error->status,
            headers: [
                'Content-Type' => 'application/problem+json',
            ],
        );
    }
}
