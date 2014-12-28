<?php
namespace Qck\Manivo\Resource\Page;

use BEAR\Package\Provide\ResourceView\JsonRenderer;
use BEAR\Resource\ResourceObject;
use BEAR\Sunday\Inject\ResourceInject;
use Parse\ParseUser;

class Incomes extends ResourceObject
{
    use ResourceInject;

    public function onGet($username, $password, $objectId = null)
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

        $incomes = $this->resource
            ->get
            ->uri('app://self/incomes')
            ->withQuery(['sessionToken' => $user->getSessionToken(), 'objectId' => $objectId])
            ->eager
            ->request()
            ->body['incomes']
        ;

        foreach ($incomes as &$income) {
            $income = json_decode($income->_encode(), true);
        }
        unset($income);

        $this['incomes'] = $incomes;

        $this->setRenderer(new JsonRenderer($this));

        return $this;
    }
}
