<?php

namespace Wspomagacz\Controller;

use Wspomagacz\View\View;

class ExercisesController
{
    public function index(): void
    {
        $view = new View(__DIR__ . '/../View/Exercises');
        $view->render('index', [], 'Wspomagacz | Ćwiczenia');
    }
}