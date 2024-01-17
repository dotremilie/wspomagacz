<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Wspomagacz\Server\Controller\VersionController;
use Wspomagacz\Server\Core\Router;

$router = new Router();

$router->addRoute('GET', '/api/version', VersionController::class, 'index');

echo $_SERVER['REQUEST_URI'];

$router->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));