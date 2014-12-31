<?php

namespace Qck\Manivo\Module;

use BEAR\Sunday\Extension\Application\AbstractApp;
use Parse\ParseClient;
use Ray\Di\Di\PostConstruct;

class App extends AbstractApp
{
    /**
     * @PostConstruct
     */
    public function onInit()
    {
        if (file_exists($parseConfig = __DIR__ . '/../../var/conf/parse.php')) {
            require $parseConfig;
        }

        $appId = $_ENV['PARSE_APP_ID'];
        $restKey = $_ENV['PARSE_REST_KEY'];
        $masterKey = $_ENV['PARSE_MASTER_KEY'];

        ParseClient::initialize($appId, $restKey, $masterKey);
    }
}
