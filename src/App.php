<?php

namespace Qck\Manivo;

use BEAR\Package\Provide\Application\AbstractApp;
use Parse\ParseClient;
use Ray\Di\Di\PostConstruct;

final class App extends AbstractApp
{
    /**
     * @PostConstruct
     */
    public function onInit()
    {
        ParseClient::initialize(PARSE_APP_ID, PARSE_REST_KEY, PARSE_MASTER_KEY);
    }
}
