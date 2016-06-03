<?php
/**
 * Application instance script
 *
 * @return $app  \BEAR\Sunday\Extension\Application\AppInterface
 *
 * @global $context string configuration context
 */
namespace Tch\Manivo;

use BEAR\Package\Bootstrap\Bootstrap;

require_once __DIR__ . '/autoload.php';

$_SERVER;

$app = Bootstrap::getApp(
    __NAMESPACE__,
    isset($context) ? $context : 'prod',
    dirname(__DIR__) . '/var/tmp'
);

return $app;
