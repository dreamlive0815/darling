<?php

namespace App\Model\DL;

use Illuminate\Database\Eloquent\Model;

class FeedBackBusiness extends Base
{
    protected $table = 'FEEDBACK_BUSINESS';
    protected $primaryKey = 'FEEDBACK_BUSINESS_ID';

    protected $casts = [
        
    ];

    public function business()
    {
        return $this->belongsTo('App\Model\DL\Business', 'BUSINESS_ID', 'BUSINESS_ID');
    }

    public function toArr()
    {
        return [
            'id' => $this->FEEDBACK_BUSINESS_ID,
            'business' => $this->business->toArr(),
            'state' => $this->STATE,
            'time' => $this->TIME,
            'content' => $this->CONTENT,
        ];
    }
}