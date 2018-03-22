<?php

namespace App\Model\DL;

use Illuminate\Database\Eloquent\Model;

class FeedBackUser extends Base
{
    protected $table = 'FEEDBACK_USER';
    protected $primaryKey = 'FEEDBACK_USER_ID';

    protected $casts = [
        
    ];

    public function user()
    {
        return $this->belongsTo('App\Model\DL\User', 'USER_ID', 'ID');
    }

    public function toArr()
    {
        return [
            'id' => $this->FEEDBACK_USER_ID,
            'user' => $this->user->toArr(),
            'state' => $this->STATE,
            'time' => $this->TIME,
            'content' => $this->CONTENT,
        ];
    }
}