<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use \App\Http\Controllers\Ajax;

class AjaxAuthenticate
{
    use Ajax;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            return $this->buildFailedJson(2, '登录态已失效,请重新登录');
        }

        return $next($request);
    }
}
