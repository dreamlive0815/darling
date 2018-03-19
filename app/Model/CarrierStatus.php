<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CarrierStatus extends Model
{
    protected $table = 'carrier_status';

    protected $fillable = [
        'user_id', 'want_order_id'
    ];
}
