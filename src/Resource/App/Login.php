<?php
namespace Tch\Manivo\Resource\App;

use BEAR\Resource\ResourceObject;
use Parse\ParseUser;
use Tch\Manivo\Annotation\ParseExceptionThrowable;

class Login extends ResourceObject
{
    /**
     * @param $username
     * @param $password
     * @return $this
     *
     * @ParseExceptionThrowable
     */
    public function onGet($username, $password)
    {
        $user = ParseUser::logIn($username, $password);
        $this['user'] = $user;

        return $this;
    }
}
