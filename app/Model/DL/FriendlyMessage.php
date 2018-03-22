<?php

namespace App\Model\DL;

use Illuminate\Database\Eloquent\Model;

class FriendlyMessage extends Base
{
    protected $table = 'FRIENDLY_MESSAGE';
    protected $primaryKey = 'FRIENDLY_MESSAGE_ID';

    protected $casts = [
        
    ];

    public function user()
    {
        return $this->belongsTo('App\Model\DL\User', 'USER_ID', 'ID');
    }

    public function toArr()
    {
        return [
            'id' => $this->FRIENDLY_MESSAGE_ID,
            'user' => $this->user->toArr(),
            'title' => $this->TITLE,
            'content' => $this->CONTENT,
            'state' => $this->STATE,
            'time' => $this->TIME,
            'likeNumber' => $this->LIKENUMBER,
        ];
    }
}