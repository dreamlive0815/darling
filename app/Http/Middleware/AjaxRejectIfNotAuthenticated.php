<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\Ajax;
use Illuminate\Support\Facades\Auth;

class AjaxRejectIfNotAuthenticated
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
            return $this->buildFailedJson(2, trans('auth.expired'));
        }

        return $next($request);
    }
}
