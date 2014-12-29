<?php
namespace Qck\Manivo\Resource\Page;

use BEAR\Package\Provide\ResourceView\JsonRenderer;
use BEAR\Resource\ResourceObject;
use BEAR\Sunday\Inject\ResourceInject;
use Parse\ParseObject;
use Ray\Di\Di\PostConstruct;

class Incomes extends ResourceObject
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
     * @param $sessionToken
     * @param null $objectId
     * @return $this
     */
    public function onGet($sessionToken, $objectId = null)
    {
        /** @var ResourceObject $ro */
        $ro = $this->resource
            ->get
            ->uri('app://self/incomes')
            ->withQuery(['sessionToken' => $sessionToken, 'objectId' => $objectId])
            ->eager
            ->request()
        ;

        if (isset($ro->body['error'])) {
            $this->code = $ro->code;
            $this->body = $ro->body;

            return $this;
        }

        $incomes = [];
        foreach ($ro->body['incomes'] as $income) {
            /** @var ParseObject $income */
            $incomes[] = json_decode($income->_encode(), true);
        }
        $this['incomes'] = $incomes;

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
        /** @var ResourceObject $ro */
        $ro = $this->resource
            ->post
            ->uri('app://self/incomes')
            ->withQuery(['sessionToken' => $sessionToken, 'date' => $date, 'amount' => $amount])
            ->eager
            ->request()
        ;

        if (isset($ro->body['error'])) {
            $this->code = $ro->code;
            $this->headers = $ro->headers;
            $this->body = $ro->body;

            return $this;
        }

        /** @var ParseObject $income */
        $income = $ro->body['income'];
        $this['income'] = json_decode($income->_encode(), true);

        return $this;
    }
}
