<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Ajax;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Auth;

trait Register
{
    use Ajax;

    private $table = 'users';

    protected function validateRegister(Request $request, $table = 'users')
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:' . $table,
            'email' => 'required|email|max:255|unique:' . $table,
            'password' => 'required|min:6|confirmed',
        ]);

        if($validator->fails())
        {
            $errors = $validator->errors();
            throw new \Exception(implode('|', $errors->all()));
        }
    }

    protected function guard()
    {
        return Auth::guard();
    }
}