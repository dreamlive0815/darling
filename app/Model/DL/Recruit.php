<?php

namespace App\Model\DL;

use Illuminate\Database\Eloquent\Model;

class Recruit extends Base
{
    protected $table = 'RECRUIT';
    protected $primaryKey = 'RECRUIT_ID';

    protected $casts = [
        
    ];

    public function user()
    {
        return $this->belongsTo('App\Model\DL\User', 'USER_ID', 'ID');
    }

    public function toArr()
    {
        return [
            'id' => $this->RECRUIT_ID,
            'user' => $this->user->toArr(),
            'price' => $this->PRICE,
            'imageUrl' => $this->IMAGEURL,
            'content' => $this->CONTENT,
            'publishTime' => $this->PUBLISH_TIME,
        ];
    }
}