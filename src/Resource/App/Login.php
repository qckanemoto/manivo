<?php
namespace Qck\Manivo\Resource\App;

use BEAR\Resource\Code;
use BEAR\Resource\ResourceObject;
use Parse\ParseException;
use Parse\ParseUser;

class Login extends ResourceObject
{
    /**
     * @param $username
     * @param $password
     * @return $this
     */
    public function onGet($username, $password)
    {
        try {
            $user = ParseUser::logIn($username, $password);
            $this['user'] = $user;

        } catch (ParseException $e) {
            $this['error'] = [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
            $this->code = Code::BAD_REQUEST;
        }

        return $this;
    }
}
