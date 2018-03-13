<?php

namespace App\Http\Controllers;

use Closure;

trait Ajax
{
    public function buildJson($code, $message, $data)
    {
        return response()->json([
            'errorCode' => $code,
            'errorMsg' => $message,
            'data' => $data
        ]);
    }

    public function buildSucceededJson($data)
    {
        return $this->buildJson(0, null, $data);
    }

    public function buildFailedJson($code, $message)
    {
        return $this->buildJson($code, $message, null);
    }

    public function buildFinalJson(Closure $callback)
    {
        try {
            $ret = $callback($this);
            return $this->buildSucceededJson($ret);
        } catch(\Exception $ex) {
            $code = $ex->getCode();
            $code = $code ? $code : 1;
            return $this->buildFailedJson($code, $ex->getMessage());
        }
    }

}