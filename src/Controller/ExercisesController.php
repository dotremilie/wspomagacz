<?php

namespace Wspomagacz\Controller;

use Wspomagacz\Model\Exercise;
use Wspomagacz\View\View;

class ExercisesController
{
    public array $exercises = [];

    public array $customExercises = [];

    public function index(): void
    {
        $view = new View(__DIR__ . '/../View/Exercises');
        $view->render('index', [], 'Wspomagacz | Ćwiczenia');
    }

    private function setExercises(): void
    {

    }

    private function addCustomExercise(Exercise $exercise): void
    {
        $this->customExercises[] = $exercise;
    }

    private function pushCustomExercises(): void
    {
        //TODO: Send Custom User Exercises to API
    }

    public function getExercises(): array
    {
        return $this->exercises;
    }

    public function getCustomExercises(): array
    {
        return $this->customExercises;
    }
}