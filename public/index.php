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

// Ekran główny
$router->addRoute('GET', '/', HomeController::class, 'index');

// Ekran powitalny
$router->addRoute('GET', '/startup', StartupController::class, 'index');

// Logowanie
$router->addRoute('GET', '/login', LoginController::class, 'index');
$router->addRoute('POST', '/login/verify', LoginController::class, 'verify');

// Wylogowanie
$router->addRoute('GET', '/logout', LoginController::class, 'logout');

// Rejestracja
$router->addRoute('GET', '/signup', SignupController::class, 'index');
$router->addRoute('POST', '/signup/verify', SignupController::class, 'verify');

// Wyświetlenie rankingu
$router->addRoute('GET', '/ranking', RankingController::class, 'index');

// Wyświetlenie ćwiczeń
$router->addRoute('GET', '/exercises', ExercisesController::class, 'index');

// Wyświetlenie ćwiczenia
$router->addRoute('GET', '/exercises/{id}', ExercisesController::class, 'show');

// Wyświetlenie treningów
$router->addRoute('GET', '/trainings', TrainingsController::class, 'index');

// Utworzenie treningu
$router->addRoute('GET', '/trainings/create', TrainingsController::class, 'create');
$router->addRoute('GET', '/trainings/create/save', TrainingsController::class, 'save_create');

// Wyświetlenie treningu
$router->addRoute('GET', '/trainings/{id}', TrainingsController::class, 'show');

// Usunięcie treningu
$router->addRoute('GET', '/trainings/{id}/delete', TrainingsController::class, 'delete');

// Edycja treningu
$router->addRoute('GET', '/trainings/{id}/edit', TrainingsController::class, 'edit');
$router->addRoute('GET', '/trainings/{id}/edit/save', TrainingsController::class, 'save_edit');

// Wyświetlenie ćwiczenia w treningu
$router->addRoute('GET', '/trainings/{training_id}/exercises/{exercise_id}', TrainingsController::class, 'show_exercise');

// Dodanie ćwiczenia do treningu
$router->addRoute('GET', '/trainings/{training_id}/add_exercise', TrainingsController::class, 'add_exercise');
$router->addRoute('GET', '/trainings/{training_id}/add_exercise/{exercise_id}', TrainingsController::class, 'save_add_exercise');

// Usunięcie ćwiczenia z treningu
$router->addRoute('GET', '/trainings/{training_id}/exercises/{exercise_id}/delete', TrainingsController::class, 'delete_exercise');

// Wyświetlenie serii w ćwiczeniu
$router->addRoute('GET', '/trainings/{training_id}/exercises/{exercise_id}/sets/{set_id}', TrainingsController::class, 'show_set');

// Dodanie serii do ćwiczenia
$router->addRoute('GET', '/trainings/{training_id}/exercises/{exercise_id}/add_set', TrainingsController::class, 'add_set');
$router->addRoute('GET', '/trainings/{training_id}/exercises/{exercise_id}/add_set/save', TrainingsController::class, 'save_add_set');

// Usunięcie serii z ćwiczenia
$router->addRoute('GET', '/trainings/{training_id}/exercises/{exercise_id}/sets/{set_id}/delete', TrainingsController::class, 'delete_set');

// Edycja serii w ćwiczeniu
$router->addRoute('GET', '/trainings/{training_id}/exercises/{exercise_id}/sets/{set_id}/edit', TrainingsController::class, 'edit_set');
$router->addRoute('GET', '/trainings/{training_id}/exercises/{exercise_id}/sets/{set_id}/edit/save', TrainingsController::class, 'save_edit_set');

$router->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));