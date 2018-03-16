<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Login;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    use Login;

    public function __construct(Request $request)
    {
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

}
