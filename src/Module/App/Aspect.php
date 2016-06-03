<?php

namespace Tch\Manivo\Module\App;

use BEAR\Package;
use Ray\Di\AbstractModule;

class Aspect extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->bindInterceptor(
            $this->matcher->any(),
            $this->matcher->annotatedWith('Tch\Manivo\Annotation\ParseExceptionThrowable'),
            [$this->requestInjection('Tch\Manivo\Interceptor\ParseExceptionCatcher')]
        );
    }
}
