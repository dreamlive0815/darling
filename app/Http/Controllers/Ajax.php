<?php

namespace App\Http\Controllers;

use Closure;
use Symfony\Component\HttpFoundation\Response;

trait Ajax
{
    public function buildJson($code, $message, $data)
    {
        return response()->json([
            'errorCode' => $code,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function buildSucceededJson($data, $message = null)
    {
        return $this->buildJson(0, $message, $data);
    }

    public function buildFailedJson($code, $message)
    {
        return $this->buildJson($code, $message, null);
    }

    public function buildFinalJson(Closure $callback)
    {
        try {
            $ret = $callback($this);
            if($ret instanceof Response) return $ret;
            return $this->buildSucceededJson($ret);
        } catch(\Exception $ex) {
            $code = $ex->getCode();
            $code = $code ? $code : 1;
            return $this->buildFailedJson($code, $ex->getMessage());
        }
    }

}