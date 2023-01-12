<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Sentry\Laravel\Integration;
use Sentry;
use Symfony\Component\HttpKernel\Exception\HttpResponseException;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            $this->reportable(function (Throwable $e) {
                Integration::captureUnhandledException($e);
            });
            
        });
        $this->reportable(function (\PDOException $e) {
            Sentry::captureException($e);
        });
        $this->reportable(function (Throwable $exception) {
            
        });
       
        $this->renderable(function (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            Sentry::captureException($e);
        });
    }
    
}
