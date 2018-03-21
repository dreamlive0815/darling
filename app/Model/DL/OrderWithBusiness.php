<?php

namespace App\Model\DL;

use Illuminate\Database\Eloquent\Model;

class OrderWithBusiness extends Base
{
    protected $table = 'ORDER_WITH_BUSINESS';
    protected $primaryKey = 'ORDER_WITH_BUSINESS_ID';

    protected $casts = [
        
    ];

    public function userGet()
    {
        return $this->belongsTo('App\Model\DL\User', 'USER_GET_ID', 'ID');
    }

    public function userDelivery()
    {
        return $this->belongsTo('App\Model\DL\User', 'USER_DELIVERY_ID', 'ID');
    }

    public function business()
    {
        return $this->belongsTo('App\Model\DL\Business', 'BUSINESS_ID', 'BUSINESS_ID');
    }

    public function toArr()
    {
        return [
            'id' => $this->ORDER_WITH_BUSINESS_ID,
            'business' => $this->business->toArr(),
            'userGet' => $this->userGet->toArr(),
            'userDelivery' => ($UD = $this->userDelivery) ? $UD->toArr() : null,
			'state' => $this->STATE,
			'userGetSubmitTime' => $this->USER_GET_SUBMIT_TIME,
			'businessAcceptTime' => $this->BUSINESS_ACCEPT_TIME,
			'userDeliveryAcceptTime' => $this->USER_DELIVERY_ACCEPT_TIME,
			'businessDeliveryTransferTime' => $this->BUSINESS_DELIVERY_TRANSFER_TIME,
			'userDeliveryTransferTime' => $this->USER_DELIVERY_TRANSFER_TIME,
			'userGetAddress' => $this->USER_GET_ADDRESS,
			'userSendAddress' => $this->USER_SEND_ADDRESS,
			'userGetNotes' => $this->USER_GET_NOTES,
			'commodityList' => $this->COMMODITY_LIST,
			'commodityMoney' => $this->COMMODITY_MONEY,
			'userSendReward' => $this->USER_SEND_REWARD,
			'userGetTel' => $this->USER_GET_TEL,
			'userGetExceptTime' => $this->USER_GET_EXCEPT_TIME,
        ];
    }
}