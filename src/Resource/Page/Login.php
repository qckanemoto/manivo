<?php
namespace Qck\Manivo\Resource\Page;

use BEAR\Package\Provide\ResourceView\JsonRenderer;
use BEAR\Resource\ResourceObject;
use BEAR\Sunday\Inject\ResourceInject;
use Parse\ParseUser;

class Login extends ResourceObject
{
    use ResourceInject;

    /**
     * @param $username
     * @param $password
     * @return $this
     */
    public function onGet($username, $password)
    {
        /** @var ParseUser $user */
        $user = $this->resource
            ->get
            ->uri('app://self/login')
            ->withQuery(['username' => $username, 'password' => $password])
            ->eager
            ->request()
            ->body['user']
        ;

        $this['sessionToken'] = $user->getSessionToken();

        $this->setRenderer(new JsonRenderer($this));

        return $this;
    }
}
