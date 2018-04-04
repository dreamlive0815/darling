<?php

namespace App\Model\DL;

use Illuminate\Database\Eloquent\Model;

class Business extends Base
{
    protected $table = 'BUSINESS';
	protected $primaryKey = 'BUSINESS_ID';
	
	protected $fillable = ['STATE'];

    public function toArr()
    {
        return [
            'id' => $this->BUSINESS_ID,
			'userName' => $this->USERNAME,
			'password' => $this->PASSWORD,
			'token' => $this->TOKEN,
			'nickName' => $this->NICKNAME,
			'address' => $this->ADDRESS,
			'telephone' => $this->TELEPHONE,
			'tag' => $this->TAG,
			'introduction' => $this->INTRODUCTION,
			'state' => $this->STATE,
			'imageUrl' => $this->IMAGE_URL,
        ];
    }
}