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
        // $status = 500;

        // $message = 'Internal Server Error';

        // if ($e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
        //     $status = 400;
        //     $message = 'Sorry, method not allowed';
        // }

        // if ($e instanceof \Illuminate\Session\TokenMismatchException) {
        //     $status = 401;
        //     $msg = 'Invalid or expired token';
        // }

        // if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
        //     $status = 404;
        //     $message = 'Sorry, that resource does not exist';
        // }

        // if ($e instanceof \Prettus\Validator\Exceptions\ValidatorException) {
        //     $status = 422;
        //     $message = $e->getMessageBag();
        // }

        // /**
        //  * response to ajax requests
        //  */
        // if($request->ajax()){
        //     return response()->json([
        //             'error'=> true, 
        //             'message' => $message
        //         ], $status);
        // }

        return parent::render($request, $e);
    }
}
