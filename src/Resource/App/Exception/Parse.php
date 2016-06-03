<?php
namespace Tch\Manivo\Resource\App\Exception;

use BEAR\Resource\ResourceObject;

class Parse extends ResourceObject
{
    /**
     * @param $statusCode
     * @param $exceptionCode
     * @param $exceptionMessage
     * @return $this
     */
    public function onGet($statusCode, $exceptionCode, $exceptionMessage)
    {
        $this->code = $statusCode;

        $this['error'] = [
            'code' => $exceptionCode,
            'message' => $exceptionMessage,
        ];

        return $this;
    }
}
