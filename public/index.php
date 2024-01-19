<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use Wspomagacz\Controller\ExercisesController;
use Wspomagacz\Controller\HomeController;
use Wspomagacz\Controller\LoginController;
use Wspomagacz\Controller\SignupController;
use Wspomagacz\Controller\StartupController;
use Wspomagacz\Controller\RankingController;
use Wspomagacz\Controller\TrainingsController;
use Wspomagacz\Core\Router;

$router = new Router();

$router->addRoute('GET', '/', HomeController::class, 'index');

$router->addRoute('GET', '/startup', StartupController::class, 'index');

$router->addRoute('GET', '/login', LoginController::class, 'index');
$router->addRoute('POST', '/login/verify', LoginController::class, 'verify');

$router->addRoute('GET', '/signup', SignupController::class, 'index');
$router->addRoute('POST', '/signup/verify', SignupController::class, 'verify');

$router->addRoute('GET', '/ranking', RankingController::class, 'index');

$router->addRoute('GET', '/exercises', ExercisesController::class, 'index');
$router->addRoute('GET', '/exercises/{id}', ExercisesController::class, 'show');

$router->addRoute('GET', '/trainings', TrainingsController::class, 'index');

$router->addRoute('GET', '/trainings', TrainingsController::class, 'index');
$router->addRoute('GET', '/trainings/create', TrainingsController::class, 'create');

$router->addRoute('GET', '/trainings/{id}', TrainingsController::class, 'show');
$router->addRoute('GET', '/trainings/{training_id}/exercises/{exercise_id}', TrainingsController::class, 'showExercises');
$router->addRoute('GET', '/trainings/{training_id}/exercises/{exercise_id}/sets/{set_id}', TrainingsController::class, 'showSets');

$router->addRoute('GET', '/trainings/{id}/edit', TrainingsController::class, 'edit');
$router->addRoute('GET', '/trainings/{training_id}/exercises/{exercise_id}/sets/{set_id}/edit', TrainingsController::class, 'editSets');

$router->addRoute('GET', '/trainings/create/save', TrainingsController::class, 'save');
$router->addRoute('GET', '/trainings/{id}/edit/save', TrainingsController::class, 'editSave');
$router->addRoute('GET', '/trainings/{training_id}/exercises/{exercise_id}/sets/{set_id}/edit/save', TrainingsController::class, 'editSaveSets');

$router->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));