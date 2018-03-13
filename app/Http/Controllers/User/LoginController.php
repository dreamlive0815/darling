<?php

namespace App\Http\Controllers\User;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Ajax;

class LoginController extends Controller
{
    use Ajax, ThrottlesLogins;

    public function __construct(Request $request)
    {
        //$this->middleware('auth.ajax');
    }

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
                return Auth::user();
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
            return ['message' => '你已成功登出'];
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
            $errors = $validator->errors();
            throw new \Exception(implode('|', $errors->all()));
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
