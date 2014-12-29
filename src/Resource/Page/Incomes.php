<?php
namespace Qck\Manivo\Resource\Page;

use BEAR\Package\Provide\ResourceView\JsonRenderer;
use BEAR\Resource\ResourceObject;
use BEAR\Sunday\Inject\ResourceInject;

class Incomes extends ResourceObject
{
    use ResourceInject;

    /**
     * @param $sessionToken
     * @param null $objectId
     * @return $this
     */
    public function onGet($sessionToken, $objectId = null)
    {
        $incomes = $this->resource
            ->get
            ->uri('app://self/incomes')
            ->withQuery(['sessionToken' => $sessionToken, 'objectId' => $objectId])
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

    /**
     * @param $sessionToken
     * @param $date
     * @param $amount
     * @return $this
     */
    public function onPost($sessionToken, $date, $amount)
    {
        $income = $this->resource
            ->post
            ->uri('app://self/incomes')
            ->withQuery(['sessionToken' => $sessionToken, 'date' => $date, 'amount' => $amount])
            ->eager
            ->request()
            ->body['income']
        ;

        $this['income'] = json_decode($income->_encode(), true);

        $this->setRenderer(new JsonRenderer($this));

        return $this;
    }
}
