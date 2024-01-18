<?php

session_start();

$_SESSION['user_id'] = 1;

require_once __DIR__ . '/../vendor/autoload.php';

use Wspomagacz\Controller\ExercisesController;
use Wspomagacz\Controller\HomeController;
use Wspomagacz\Controller\LoginController;
use Wspomagacz\Controller\ProfileController;
use Wspomagacz\Controller\SignupController;
use Wspomagacz\Controller\StartupController;
use Wspomagacz\Controller\RankingController;
use Wspomagacz\Controller\TrainingController;
use Wspomagacz\Core\Router;

$router = new Router();

$router->addRoute('GET', '/', HomeController::class, 'index');

$router->addRoute('GET', '/startup', StartupController::class, 'index');

$router->addRoute('GET', '/login', LoginController::class, 'index');

$router->addRoute('GET', '/signup', SignupController::class, 'index');

$router->addRoute('GET', '/ranking', RankingController::class, 'index');

$router->addRoute('GET', '/exercises', ExercisesController::class, 'index');

$router->addRoute('GET', '/training', TrainingController::class, 'index');


$router->addRoute('GET', '/profile', ProfileController::class, 'index');

$router->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));