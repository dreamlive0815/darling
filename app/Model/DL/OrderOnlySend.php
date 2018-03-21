<?php

namespace App\Model\DL;

use Illuminate\Database\Eloquent\Model;

class OrderOnlySend extends Base
{
    protected $table = 'ORDER_ONLY_SEND';
    protected $primaryKey = 'ORDER_ONLY_SEND_ID';

    protected $casts = [
        
    ];

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
            'id' => $this->ORDER_ONLY_SEND_ID,
			'userSend' => $this->userSend->toArr(),
			'userDelivery' => ($UD = $this->userDelivery) ? $UD->toArr() : null,
			'instruction' => $this->INSTRUCTION,
			'state' => $this->STATE,
			'userSendAddress' => $this->USER_SEND_ADDRESS,
			'sendToAddress' => $this->SEND_TO_ADDRESS,
			'sendToName' => $this->SEND_TONAME,
			'reward' => $this->REWARD,
			'userSendSubmitTime' => $this->USER_SEND_SUBMIT_TIME,
			'userDeliveryAcceptTime' => $this->USER_DELIVERY_ACCEPT_TIME,
			'userSendDeliveryTransferTime' => $this->USER_SEND_DELIVERY_TRANSFER_TIME,
			'userDeliveryArriveTime' => $this->USER_DELIVERY_ARRIVE_TIME,
			'userGetExceptTime' => $this->USER_GET_EXCEPT_TIME,
			'userSendTel' => $this->USER_SEND_TEL,
			'sendToTel' => $this->SEND_TO_TEL,
			'userDeliveryTel' => $this->USER_DELIVERY_TEL,
			'userDeliveryTransferTime' => $this->USER_EXCEPT_DELIVERY_TRANSFER_TIME,
			'itemType' => $this->ITEM_TYPE,
			'weight' => $this->WEIGHT,
			'imageUrl' => $this->IMAGE_URL,
			'deliveryInsurance' => $this->DELIVERY_INSURANCE,
        ];
    }
}