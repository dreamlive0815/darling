<?php

namespace App\Model\DL;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{

    public $timestamps = false;

    protected $connection = 'mysql_bak';

    public function toArr()
    {
        return [];
    }
}