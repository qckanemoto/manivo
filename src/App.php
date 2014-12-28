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
        $appId = 'JgytQlORxrBx6B7uNd757Z9JlIhZCCQJvoBN8fG1';
        $restKey = 'dChlqyK9E0K6LlYrPBVSkz7vtSr1FI8pDJHumEKa';
        $masterKey = 'qNJfKMX7H67ZUraU0yodiVoudeyVgkrYJctsKRIT';

        ParseClient::initialize($appId, $restKey, $masterKey);
    }
}
