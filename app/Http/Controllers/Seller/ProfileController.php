<?php

namespace App\Http\Controllers\Seller;


use Illuminate\Http\Request;
use App\Http\Controllers\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    use Profile;

    public function __construct()
    {
        $this->middleware('auth.ajax.reject:seller');
    }

    protected function guard()
    {
        return Auth::guard('seller');
    }

}
