<?php

namespace Tch\Manivo;

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
        $appId = $_ENV['PARSE_APP_ID'];
        $restKey = $_ENV['PARSE_REST_KEY'];
        $masterKey = $_ENV['PARSE_MASTER_KEY'];

        ParseClient::initialize($appId, $restKey, $masterKey);
    }
}
