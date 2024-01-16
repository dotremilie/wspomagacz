<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Wspomagacz\Client\Controller\ExercisesController;
use Wspomagacz\Client\Controller\HomeController;
use Wspomagacz\Client\Controller\LoginController;
use Wspomagacz\Client\Controller\RankingController;
use Wspomagacz\Client\Controller\RegisterController;
use Wspomagacz\Client\Controller\TrainingController;
use Wspomagacz\Client\Core\Router;

$router = new Router();

$router->addRoute('GET', '/', HomeController::class, 'index');

$router->addRoute('GET', '/login', LoginController::class, 'index');

$router->addRoute('GET', '/register', RegisterController::class, 'index');

$router->addRoute('GET', '/ranking', RankingController::class, 'index');

$router->addRoute('GET', '/exercises', ExercisesController::class, 'index');

$router->addRoute('GET', '/training', TrainingController::class, 'index');
$router->addRoute('GET', '/training/new', TrainingController::class, 'new');
$router->addRoute('GET', '/training/start', TrainingController::class, 'new');

$router->addRoute('GET', '/profile', TrainingController::class, 'new');

$router->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));