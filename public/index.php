<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Wspomagacz\Controller\HomeController;
use Wspomagacz\Controller\LoginController;
use Wspomagacz\Controller\RegisterController;
use Wspomagacz\Core\Router;

$router = new Router();

$router->addRoute('GET', '/login', LoginController::class, 'index');
$router->addRoute('GET', '/register', RegisterController::class, 'index');
$router->addRoute('GET', '/', HomeController::class, 'index');

$router->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));