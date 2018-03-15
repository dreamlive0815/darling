<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Ajax;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;

trait Login
{
    use Ajax, ThrottlesLogins;

    public function login(Request $request)
    {
        return $this->buildFinalJson( function ($that) use($request) {
            
            $this->validateLogin($request);

            if ($this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);
                $this->fireLockoutException($request);
            }

            if ($this->attemptLogin($request)) {
                $request->session()->regenerate();
                $this->clearLoginAttempts($request);
                return $this->buildSucceededJson(null, trans('auth.logged_in'));
            }
            
            $this->incrementLoginAttempts($request);
            throw new \Exception(trans('auth.failed'));
        });
    }

    public function logout(Request $request)
    {
        return $this->buildFinalJson( function ($that) use($request) {
            $this->guard()->logout();
            $request->session()->invalidate();
            return $this->buildSucceededJson(null, trans('auth.logged_out'));
        });
    }

    protected function validateLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);

        if($validator->fails())
        {
            $errors = $validator->errors()->toArray();
            throw new \Exception(json_encode($errors));
        }
    }

    protected function attemptLogin(Request $request)
    {
        $username = $request->input($this->username());
        $password = $request->input('password');
        $remember = $request->has('remember');
        $guard = $this->guard();
        return $guard->attempt( [ 'email' => $username, 'password' => $password ], $remember) ? true : 
               $guard->attempt( [ 'name' => $username, 'password' => $password ], $remember);
    }

    protected function fireLockoutException(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        $message = Lang::get('auth.throttle', ['seconds' => $seconds]);
        throw new \Exception($message);
    }

    public function username()
    {
        return 'username';
    }

    protected function guard()
    {
        return Auth::guard();
    }
}