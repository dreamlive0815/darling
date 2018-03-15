<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\Ajax;
use Illuminate\Support\Facades\Auth;

class AjaxRedirectIfAuthenticated
{
    use Ajax;

    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return $this->buildSucceededJson(['message' => trans('auth.authenticated')]);
        }

        return $next($request);
    }
}