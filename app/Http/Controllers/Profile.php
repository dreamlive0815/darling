<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Ajax;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Auth;

trait Profile
{
    use Ajax;

    public function __construct()
    {
        $this->middleware('auth.ajax.reject');
    }

    public function getProfile(Request $request)
    {
        return $this->buildFinalJson( function ($that) use($request) {
            return $this->guard()->user();
        });
    }

    public function modifyPassword(Request $request)
    {
        return $this->buildFinalJson( function ($that) use($request) {
            $this->validateModifyPassword($request);
            $user = $this->guard()->user();
            $user->password = bcrypt($request->input('password'));
            $user->save();
            return $this->buildSucceededJson(null, trans('auth.password_modified'));
        });
    }

    protected function validateModifyPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed',
        ]);

        if($validator->fails())
        {
            $errors = $validator->errors()->toArray();
            throw new \Exception(json_encode($errors));
        }
    }

    protected function guard()
    {
        return Auth::guard();
    }

}