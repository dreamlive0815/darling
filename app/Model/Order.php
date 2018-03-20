<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'seller_id',
        'sender_id', 'sender_type', 'sender_address', 'sender_tel',
        'receiver_address', 'receiver_tel', 'reward_for_carrier'
    ];

    public function sender()
    {
        return $this->morphTo();
    }
}
