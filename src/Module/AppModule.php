<?php

namespace Qck\Manivo\Module;

use BEAR\Package\Module\Package\StandardPackageModule;
use Ray\Di\AbstractModule;
use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;

class AppModule extends AbstractModule
{
    /**
     * @var string
     */
    private $context;

    /**
     * @param string $context
     *
     * @Inject
     * @Named("app_context")
     */
    public function __construct($context = 'prod')
    {
        $this->context = $context;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->install(new StandardPackageModule('Qck\Manivo', $this->context, dirname(dirname(__DIR__))));

        $this->bindInterceptor(
            $this->matcher->any(),
            $this->matcher->annotatedWith('Qck\Manivo\Annotation\ParseExceptionThrowable'),
            [$this->requestInjection('Qck\Manivo\Interceptor\ParseExceptionCatcher')]
        );

        // override module
        // $this->install(new SmartyModule($this));

        // $this->install(new AuraViewModule($this));

        // install application dependency
        // $this->install(new App\Dependency);

        // install application aspect
        // $this->install(new App\Aspect($this));
    }
}
