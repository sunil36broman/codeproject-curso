<?php

namespace CodeProject\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {

        $status = 500;
        $message = 'Internal Server Error';

        if ($e instanceof \Illuminate\Session\TokenMismatchException) {
            $status = 401;
            $msg = 'Invalid or expired token';
        }

        elseif ($e instanceof \League\OAuth2\Server\Exception\AccessDeniedException) {
            $status = 401;
            $msg = 'The resource owner or authorization server denied the request.';
        }

        elseif ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            $status = 404;
            $message = 'Sorry, that resource does not exist';
        }

        elseif ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            $status = 404;
            $message = 'Page not found.';
        }

        elseif ($e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
            $status = 400;
            $message = 'Sorry, method not allowed';
        }

        elseif ($e instanceof \PDOException) {
            $status = 500;
            $message = 'Sorry, was not possible to complete the operation. Contact your system administrator';
        }

        else{
            if(config('app.debug')){
                $message = $e->getMessage();
            }
        }

        // return parent::render($request, $e);      

        return response()->json([
            'error'=> true, 
            'message' => $message
            ], $status);
       
    }
}
