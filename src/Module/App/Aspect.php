<?php

namespace Qck\Manivo\Module\App;

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
            $this->matcher->annotatedWith('Qck\Manivo\Annotation\ParseExceptionThrowable'),
            [$this->requestInjection('Qck\Manivo\Interceptor\ParseExceptionCatcher')]
        );
    }
}
