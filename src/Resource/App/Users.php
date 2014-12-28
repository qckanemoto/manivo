<?php
namespace Qck\Manivo\Resource\App;

use BEAR\Resource\Code;
use BEAR\Resource\ResourceObject;
use Parse\ParseException;
use Parse\ParseUser;

class Users extends ResourceObject
{
    /**
     * @param null $objectId
     * @return $this
     */
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

        $this['users'] = $query->find();

        return $this;
    }

    /**
     * @param $username
     * @param $password
     * @param null $email
     * @return $this
     */
    public function onPost($username, $password, $email = null)
    {
        $user = new ParseUser();
        $user->set('username', $username);
        $user->set('password', $password);
        is_null($email) or $user->set('email', $email);

        try {
            $user->signUp();
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
