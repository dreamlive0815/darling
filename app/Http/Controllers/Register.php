<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Ajax;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

trait Register
{
    use Ajax;

    protected function validateRegister(Request $request)
    {
        $table = $this->table;
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:' . $table,
            'email' => 'required|email|max:255|unique:' . $table,
            'password' => 'required|min:6|confirmed',
        ]);

        if($validator->fails())
        {
            $errors = $validator->errors()->toArray();
            throw new \Exception(json_encode($errors));
        }
    }

    public function register(Request $request)
    {
        return $this->buildFinalJson( function ($that) use ($request) {
            $this->validateRegister($request);
            $user = $this->create($request->all());
            event(new Registered($user));
            $this->guard()->login($user);
            return $this->buildSucceededJson(null, trans('auth.registered'));
        });
    }

    protected function guard()
    {
        return Auth::guard();
    }
}