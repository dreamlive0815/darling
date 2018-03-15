<?php

namespace App\Http\Controllers\User;


use Illuminate\Http\Request;
use App\Http\Controllers\Login;
use App\Http\Controllers\Controller;


class LoginController extends Controller
{
    use Login;

    public function __construct(Request $request)
    {
    }

}
