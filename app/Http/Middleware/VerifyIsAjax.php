<?php

namespace CodeProject\Http\Middleware;

use Closure;
use CodeProject\Exceptions\OnlyAjaxRequestsException;

class VerifyIsAjax
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(! $request->ajax()){
            throw new OnlyAjaxRequestsException('Only allowed ajax requests.');
        }

        return $next($request);
    }
}
