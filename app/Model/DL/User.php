<?php

namespace App\Model\DL;

use Illuminate\Database\Eloquent\Model;

class User extends Base
{
    protected $table = 'USER';
    protected $primaryKey = 'ID';

    protected $casts = [
        'DESPOST' => 'boolean',
        'MATCHING' => 'boolean',
    ];

    public function toArr()
    {
        return [
            'id' => $this->ID,
			'userName' => $this->USERNAME,
			'password' => $this->PASSWORD,
			'token' => $this->TOKEN,
			'creditScore' => $this->CREDIT_SCORE,
			'sex' => $this->SEX,
			'job' => $this->JOB,
			'nickName' => $this->NICKNAME,
			'hobby' => $this->HOBBY,
			'school' => $this->SCHOOL,
			'company' => $this->COMPANY,
			'mailBox' => $this->MAILBOX,
			'homePlace' => $this->HOMEPLACE,
			'age' => $this->AGE,
			'imageUrl' => $this->IMAGE_URL,
			'address' => $this->ADDRESS,
			'state' => $this->STATE,
			'introduction' => $this->INTRODUCTION,
			'idProve' => $this->IDPROVE,
			'realName' => $this->REALNAME,
			'despost' => $this->DESPOST,
			'delivery' => $this->IS_DELIVERY,
			'matching' => $this->MATCHING,
        ];
    }
}