<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Register;
use App\Http\Controllers\Controller;


class RegisterController extends Controller
{
    use Register;

    private $table = 'sellers';

    public function __construct(Request $request)
    {
    }


    protected function create(array $data)
    {
        return Seller::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

}
