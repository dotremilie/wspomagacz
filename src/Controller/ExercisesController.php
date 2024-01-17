<?php

namespace Wspomagacz\Controller;

use Wspomagacz\Core\Database;
use Wspomagacz\Model\Equipment;
use Wspomagacz\Model\Exercise;
use Wspomagacz\Model\Muscle;
use Wspomagacz\View\View;

class ExercisesController
{
    private array $exercises = [];

    private array $customExercises = [];

    public function index(): void
    {
        $this->setExercises($this->fetchExercises());

        $view = new View(__DIR__ . '/../View/Exercises');
        $view->render('index', $this->getExercises(), 'Wspomagacz | Ćwiczenia');
    }

    private function setExercises(array $exercises): void
    {
        $this->exercises = $exercises;
    }

    private function fetchExercises(): array
    {
        $database = new Database();
        $query = "
        SELECT 
            e.id AS exercise_id,
            e.name AS exercise_name,
            q.id AS equipment_id,
            q.name AS equipment_name,
            m.id AS muscle_id,
            m.name AS muscle_name 
        FROM 
            exercises e
        JOIN
            exercise_equipment eq ON eq.exercise_id = e.id
        JOIN
            equipment q ON q.id = eq.equipment_id
        JOIN
            exercise_muscles em ON em.exercise_id = e.id
        JOIN
            muscles m ON m.id = em.muscle_id;";


        $data = $database->query($query)->fetchAll();

        $exercises = [];
        $musclesCounter = 0;
        $equipmentCounter = 0;

        foreach ($data as $row) {
            $muscles = [];
            $equipment = [];
            foreach ($data as $exercise) {
                if ($exercise['exercise_id'] == $row['exercise_id']) {
                    //Add first muscle and equipment for exercise
                    if (empty($muscles)) {
                        $muscles[$musclesCounter] = new Muscle($exercise['muscle_id'],$exercise['muscle_name']);
                        $musclesCounter++;
                    }
                    if (empty($equipment)) {
                        $equipment[$equipmentCounter] = new Equipment($exercise['equipment_id'],$exercise['equipment_name']);
                        $equipmentCounter++;
                    }

                    //Check if muscle name don't exist in muscles array
                    $counter = 0;
                    foreach ($muscles as $muscle) if ($muscle->getId() != $exercise['muscle_id']) $counter++;

                    // If not then add this muscle to array
                    if ($counter == 0) {
                        $muscles[$musclesCounter] = new Muscle($exercise['muscle_id'],$exercise['muscle_name']);
                        $musclesCounter++;
                    } else $counter = 0;

                    //Check if equipment name don't exist in equipment array
                    foreach ($equipment as $eq) if ($eq->getId() != $exercise['equipment_id']) $counter++;

                    // If not then add this equipment to array
                    if ($counter == 0) {
                        $equipment[$equipmentCounter] = new Equipment($exercise['equipment_id'],$exercise['equipment_name']);
                        $equipmentCounter++;
                    }
                }
            }

            //Add exercise to array
            $exercises[$row['exercise_id']] = new Exercise($row['exercise_id'], $row['exercise_name'], $equipment, $muscles);
        }

        return $exercises;
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