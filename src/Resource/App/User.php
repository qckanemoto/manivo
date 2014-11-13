<?php
namespace Qck\Manivo\Resource\App;

use BEAR\Resource\Code;
use BEAR\Resource\ResourceObject;
use Parse\ParseException;
use Parse\ParseUser;

class User extends ResourceObject
{
    public function onPost($username, $email, $password)
    {
        $user = new ParseUser();
        $user->set('username', $username);
        $user->set('email', $email);
        $user->set('password', $password);

        try {
            $user->signUp();
        } catch (ParseException $e) {
            $this['errors'] = [
                [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ],
            ];
            $this->code = Code::ERROR;

            return $this;
        }

        return $this;
    }
}
