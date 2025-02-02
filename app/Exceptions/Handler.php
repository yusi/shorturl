<?php
namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException || $e instanceof HttpExceptionInterface && $e->getStatusCode() == 404) {
            return response()->view('errors.404', [], 404);
        }

        return parent::render($request, $e);
    }
}