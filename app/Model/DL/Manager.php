<?php

namespace App\Model\DL;

use Illuminate\Database\Eloquent\Model;

class Manager extends Base
{
    protected $table = 'SYSTEM_MANAGER';
    protected $primaryKey = 'STSTEM_MANANGER_ID';

    public function toArr()
    {
        return [
            'id' => $this->STSTEM_MANANGER_ID,
			'userName' => $this->USERNAME,
			'password' => $this->PASSWORD,
			'telephone' => $this->TELEPHONE,
			'privileges' => $this->PRIVILEGES,
			'state' => $this->STATE,
        ];
    }
}