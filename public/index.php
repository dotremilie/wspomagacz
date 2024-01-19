<?php

session_start();

$_SESSION['user_id'] = 1;

require_once __DIR__ . '/../vendor/autoload.php';

use Wspomagacz\Controller\ExercisesController;
use Wspomagacz\Controller\HomeController;
use Wspomagacz\Controller\LoginController;
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
$router->addRoute('GET', '/exercises/{id}', ExercisesController::class, 'show');

$router->addRoute('GET', '/trainings', TrainingController::class, 'index');

$router->addRoute('GET', '/trainings', TrainingController::class, 'index');
$router->addRoute('GET', '/trainings/create', TrainingController::class, 'index');

$router->addRoute('GET', '/trainings/{id}', TrainingController::class, 'show');
$router->addRoute('GET', '/trainings/{training_id}/exercises/{exercise_id}', TrainingController::class, 'show');
$router->addRoute('GET', '/trainings/{training_id}/exercises/{exercise_id}/sets/{set_id}', TrainingController::class, 'show');

$router->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));