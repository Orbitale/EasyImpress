<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

$environment = (getenv('APP_ENVIRONMENT') !== false) ? getenv('APP_ENVIRONMENT') : 'dev';
$debug       = (getenv('APP_DEBUG') !== false) ? (bool) getenv('APP_DEBUG') : true;

/**
 * @var Composer\Autoload\ClassLoader
 */
$loader = require __DIR__.'/../app/autoload.php';

if (true === $debug) {
    Debug::enable();
} else {
    include_once __DIR__.'/../var/bootstrap.php.cache';
}

$kernel = new AppKernel($environment, $debug);
$kernel->loadClassCache();

// Feel free to activate AppCache if you like
if (false === $debug && 'prod' === $environment) {
    // $kernel = new AppCache($kernel);
    // When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
    // Request::enableHttpMethodParameterOverride();
}

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
