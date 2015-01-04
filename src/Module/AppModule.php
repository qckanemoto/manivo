<?php
namespace Qck\Manivo\Module;

use BEAR\Package\AppMeta;
use BEAR\Package\PackageModule;
use BEAR\Sunday\Extension\Application\AppInterface;
use Qck\Manivo\Annotation\ParseExceptionThrowable;
use Qck\Manivo\Interceptor\ParseExceptionCatcher;
use Ray\Di\AbstractModule;

class AppModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->bind(AppInterface::class)->to(App::class);

        $this->install(new PackageModule(new AppMeta('Qck\Manivo')));

        $this->bindInterceptor(
            $this->matcher->any(),
            $this->matcher->annotatedWith(ParseExceptionThrowable::class),
            [ParseExceptionCatcher::class]
        );
    }
}
