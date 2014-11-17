<?php
namespace Qck\Manivo\Resource\App;

use BEAR\Resource\Code;
use BEAR\Resource\ResourceObject;
use Parse\ParseException;
use Parse\ParseUser;

class Users extends ResourceObject
{
    public function onGet($objectId = null)
    {
        $query = ParseUser::query();

        if (!is_null($objectId)) {
            try {
                $query->get($objectId);
            } catch (ParseException $e) {
                $this['error'] = [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ];
                $this->code = Code::NOT_FOUND;

                return $this;
            }
        }

        $users = [];
        foreach ($query->find() as $user) {
            $users[] = json_decode($user->_encode(), true);
        }
        $this->body = $users;

        return $this;
    }

    public function onPost($username, $email, $password)
    {
        $user = new ParseUser();
        $user->set('username', $username);
        $user->set('email', $email);
        $user->set('password', $password);

        try {
            $user->signUp();
            $this->body = json_decode($user->_encode(), true);

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
