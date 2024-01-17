<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Wspomagacz\Controller\ExercisesController;
use Wspomagacz\Controller\HomeController;
use Wspomagacz\Controller\StartupController;
use Wspomagacz\Controller\RankingController;
use Wspomagacz\Controller\TrainingController;
use Wspomagacz\Core\Router;

$router = new Router();

$router->addRoute('GET', '/', HomeController::class, 'index');

$router->addRoute('GET', '/startup', StartupController::class, 'index');
$router->addRoute('GET', '/startup/login', StartupController::class, 'login');
$router->addRoute('GET', '/startup/login', StartupController::class, 'login');
$router->addRoute('GET', '/startup/login/forgot-password', StartupController::class, 'forgotPassword');
$router->addRoute('GET', '/startup/login/forgot-password/reset-password', StartupController::class, 'resetPassword');

$router->addRoute('GET', '/startup/signup', StartupController::class, 'signup');
$router->addRoute('POST', '/startup/signup', StartupController::class, 'verification');

$router->addRoute('GET', '/ranking', RankingController::class, 'index');

$router->addRoute('GET', '/exercises', ExercisesController::class, 'index');

$router->addRoute('GET', '/training', TrainingController::class, 'index');
$router->addRoute('GET', '/training/new', TrainingController::class, 'new');
$router->addRoute('GET', '/training/start', TrainingController::class, 'new');

$router->addRoute('GET', '/profile', TrainingController::class, 'new');

$router->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));