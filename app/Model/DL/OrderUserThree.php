<?php

namespace App\Model\DL;

use Illuminate\Database\Eloquent\Model;

class OrderUserThree extends Base
{
    protected $table = 'ORDER_USER_THREE';
    protected $primaryKey = 'ORDER_USER_THREE_ID';

    protected $casts = [
        
    ];

    public function userGet()
    {
        return $this->belongsTo('App\Model\DL\User', 'USER_GET_ID', 'ID');
    }

    public function userSend()
    {
        return $this->belongsTo('App\Model\DL\User', 'USER_SEND_ID', 'ID');
    }

    public function userDelivery()
    {
        return $this->belongsTo('App\Model\DL\User', 'USER_DELIVERY_ID', 'ID');
    }

    public function toArr()
    {
        return [
            'id' => $this->ORDER_USER_THREE_ID,
            'userGet' => $this->userGet->toArr(),
            'userSend' => ($US = $this->userSend) ? $US->toArr() : null,
            'userDelivery' => ($UD = $this->userDelivery) ? $UD->toArr() : null,
            'state' => $this->STATE,
			'userGetSubmitTime' => $this->USER_GET_SUBMIT_TIME,
            'userDeliveryAcceptTime' => $this->USER_DELIVERY_ACCEPT_TIME,
            'userGetNotes' => $this->USER_GET_NOTES,
            'userGetTel' => $this->USER_GET_TEL,
            'userGetExceptTime' => $this->USER_GET_EXCEPT_TIME,
			'userSendAcceptTime' => $this->USER_SEND_ACCEPT_TIME,
			'userSendDeliveryTransferTime' => $this->USER_SEND_DELIVERY_TRANSFER_TIME,
			'userDeliveryGetTransferTime' => $this->USER_DELIVERY_GET_TRANSFER_TIME,
			'userGetAdress' => $this->USER_GET_ADRESS,
			'userSendAddress' => $this->USER_SEND_ADRESS,
			'userSendNotes' => $this->USER_SEND_NOTES,
			'userSendMoney' => $this->USER_SEND_MONEY,
			'userDeliveryReward' => $this->USER_DELIVERY_REWARD,
			'userSendTel' => $this->USER_SEND_TEL,
			'userDeliveryTel' => $this->USER_DELIVERY_TEL,
			'position' => $this->POSITION,
			'tag' => $this->TAG,
			'getInsurance' => $this->GET_INSURANCE,
			'deliveryInsurance' => $this->DELIVERY_INSURANCE,
			'imageUrl' => $this->IMAGE_URL,
        ];
    }
}