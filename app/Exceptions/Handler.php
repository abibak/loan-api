<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
     * @param \Throwable $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $e)
    {
        parent::report($e);
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof QueryException) {
            return $this->newResponseApiException('Request error', 400);
        }

        if ($e instanceof ModelNotFoundException) {
            return $this->newResponseApiException('Model not found', 404);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return $this->newResponseApiException('Method not allowed', 405);
        }

        if ($e instanceof NotFoundHttpException) {
            return $this->newResponseApiException('Resource not found', 404);
        }

        return parent::render($request, $e);
    }

    protected function newResponseApiException
    (
        string $message,
        int    $status,
        array  $headers = ['Content-type' => 'application/json']): Response
    {
        return new Response(['message' => $message], $status, $headers);
    }
}
