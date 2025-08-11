<?php

namespace App\Exceptions;
use App\Models\SystemSetting;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     */
    protected $dontReport = [
        // Add exceptions you don't want to report, if any.
    ];
//
    /**
     * A list of the inputs that are never flashed for validation exceptions.
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     */
    public function report(Throwable $exception)
    {
        // You can log the exception to a third-party service here, e.g., Sentry, Bugsnag.
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {


        if (
            $exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException ||
            $exception instanceof NotFoundHttpException
        ) {
            return response()->view('errors.404')->with('systemInfo', $systemInfo)->setStatusCode(404);
        }

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return response()->view('errors.403')->with('systemInfo', $systemInfo)->setStatusCode(403);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->view('errors.405')->with('systemInfo', $systemInfo)->setStatusCode(405);
        }

        // Default: use Laravel's default exception rendering
        return parent::render($request, $exception);
    }


}
