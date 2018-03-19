<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    protected $table = 'commodities';

    protected $fillable = [
        'seller_id', 'name', 'price'
    ];
}
