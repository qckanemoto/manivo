<?php
namespace Tch\Manivo\Resource\App;

use BEAR\Resource\ResourceObject;
use Parse\ParseUser;
use Tch\Manivo\Annotation\ParseExceptionThrowable;

class Users extends ResourceObject
{
    /**
     * @param null $objectId
     * @return $this
     *
     * @ParseExceptionThrowable
     */
    public function onGet($objectId = null)
    {
        $query = ParseUser::query();

        if (!is_null($objectId)) {
            $query->get($objectId);
        }

        $this['users'] = $query->find();

        return $this;
    }

    /**
     * @param $username
     * @param $password
     * @param null $email
     * @return $this
     *
     * @ParseExceptionThrowable
     */
    public function onPost($username, $password, $email = null)
    {
        $user = new ParseUser();
        $user->set('username', $username);
        $user->set('password', $password);
        is_null($email) or $user->set('email', $email);

        $user->signUp();
        $this['user'] = $user;

        return $this;
    }
}
