<?php
declare(strict_types=1);

define('BASE_DIR', dirname(__DIR__) . '/');

require_once BASE_DIR . 'vendor/autoload.php';
require_once BASE_DIR . 'core/Router.php';
require_once BASE_DIR . 'functions/Functions.php';

$router = new \Core\Router();
$router->addRoute('/', ['get' => '\Controllers\HomeController@hello',
    'post' => '\Controllers\HomeController@timeOfRequest']);


try {
    print_r($router->dispatch($_SERVER['REQUEST_URI']));

} catch (Exception $exception) {
    echo $exception->getMessage();
}

