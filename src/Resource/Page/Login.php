<?php
namespace Qck\Manivo\Resource\Page;

use BEAR\Package\Provide\ResourceView\JsonRenderer;
use BEAR\Resource\ResourceObject;
use BEAR\Sunday\Inject\ResourceInject;
use Parse\ParseUser;
use Ray\Di\Di\PostConstruct;

class Login extends ResourceObject
{
    use ResourceInject;

    /**
     * @PostConstruct
     */
    public function onInit()
    {
        $this->setRenderer(new JsonRenderer);
    }

    /**
     * @param $username
     * @param $password
     * @return $this
     */
    public function onGet($username, $password)
    {
        /** @var ResourceObject $ro */
        $ro = $this->resource
            ->get
            ->uri('app://self/login')
            ->withQuery(['username' => $username, 'password' => $password])
            ->eager
            ->request()
        ;

        if (isset($ro->body['error'])) {
            $this->code = $ro->code;
            $this->headers = $ro->headers;
            $this->body = $ro->body;

            return $this;
        }

        /** @var ParseUser $user */
        $user = $ro->body['user'];
        $this['sessionToken'] = $user->getSessionToken();

        return $this;
    }
}
