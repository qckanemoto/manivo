<?php

namespace Qck\Manivo\Resource\Page;

use BEAR\Resource\ResourceObject;
use BEAR\Sunday\Inject\ResourceInject;

class Index extends ResourceObject
{
    use ResourceInject;

    public function onGet()
    {
        $this['request_uri'] = rtrim($_SERVER['REQUEST_URI'], '/');

        return $this;
    }
}
