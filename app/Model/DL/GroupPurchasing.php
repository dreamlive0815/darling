<?php

namespace App\Model\DL;

use Illuminate\Database\Eloquent\Model;

class GroupPurchasing extends Base
{
    protected $table = 'GROUP_PURCHASING';
    protected $primaryKey = 'GROUP_PURCHASING_ID';

    protected $casts = [
        
    ];

    public function publisher()
    {
        return $this->belongsTo('App\Model\DL\User', 'USER_PUBLISH_ID', 'ID');
    }

    public function toArr()
    {
        return [
            'id' => $this->GROUP_PURCHASING_ID,
            'userPublish' => $this->publisher->toArr(),
            'state' => $this->STATE,
            'publishTime' => $this->PUBLISH_TIME,
            'limitNumber' => $this->LIMIT_NUMBER,
            'nowNumber' => $this->NOW_NUMBER,
            'title' => $this->TITLE,
            'instruction' => $this->INSTRUCTION,
            'weight' => $this->WEIGHT,
            'type' => $this->TYPE,
            'imageUrl' => $this->IMAGEURL,
        ];
    }
}