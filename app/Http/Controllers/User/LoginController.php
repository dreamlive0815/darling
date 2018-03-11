<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Http\Controllers\Ajax;

class LoginController extends Controller
{
    use Ajax;

    public function __construct()
    {
        //$this->middleware('auth.ajax');
    }

    public function login(Request $request)
    {
        return $this->buildFinalJson( function ($that) {
            throw new \Exception('hhad');
            return 1;
        });
    }
}
