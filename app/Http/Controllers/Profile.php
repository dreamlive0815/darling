<?php

namespace App\Http\Controllers;

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

    protected function guard()
    {
        return Auth::guard();
    }

}