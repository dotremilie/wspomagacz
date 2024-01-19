<?php

namespace Wspomagacz\Controller;

use Wspomagacz\Core\Database;
use Wspomagacz\Model\CustomExercise;
use Wspomagacz\Model\Equipment;
use Wspomagacz\Model\Exercise;
use Wspomagacz\Model\ExerciseMuscle;
use Wspomagacz\View\View;

class ExercisesController
{
    private array $exercises = [];

    private array $customExercises = [];

    public function index(): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $this->fetchExercises();
        $this->fetchCustomExercises($_SESSION['user_id']);

        $view = new View(__DIR__ . '/../View/Exercises');
        $view->render('index', ["exercises"=>$this->getExercises(),"customExercises"=>$this->getCustomExercises()], 'Wspomagacz | Ćwiczenia');
    }

    public function show(array $params): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $exerciseId = isset($params['id']) ? (int)$params['id'] : null;
        $exerciseObject = null;

        $this->fetchExercises();

        /** @var Exercise $exercise */
        foreach ($this->getExercises() as $exercise) {
            if ($exercise->getId() == $exerciseId) {
                $exerciseObject = $exercise;
                break;
            }
        }

        $titleExercise = $exerciseObject->getName() ?? "Nie znaleziono";

        $view = new View(__DIR__ . '/../View/Exercises');
        $view->render('show', ["exercise"=> $exerciseObject], "Wspomagacz | $titleExercise");
    }

    private function setExercises(array $exercises): void
    {
        $this->exercises = $exercises;
    }

    private function setCustomExercises(array $customExercises): void
    {
        $this->customExercises = $customExercises;
    }

    private function fetchExercises(): void
    {
        $database = new Database();
        $query = "
        SELECT 
            e.id AS exercise_id,
            e.name AS exercise_name,
            q.id AS equipment_id,
            q.name AS equipment_name,
            m.id AS muscle_id,
            m.name AS muscle_name,
            em.strength AS muscle_strength
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
        $database->close();

        $exercises = $this->getExercisesArray($data);

        $this->setExercises($exercises);
    }

    private function fetchCustomExercises(int $user_id): void
    {
        $database = new Database();
        $query = "
        SELECT 
            e.id AS exercise_id,
            e.name AS exercise_name,
            q.id AS equipment_id,
            q.name AS equipment_name,
            m.id AS muscle_id,
            m.name AS muscle_name, 
            em.strength AS muscle_strength 
        FROM 
            custom_exercises e
        JOIN
            custom_exercise_equipment eq ON eq.custom_exercise_id = e.id
        JOIN
            equipment q ON q.id = eq.equipment_id
        JOIN
            custom_exercise_muscles em ON em.custom_exercise_id = e.id
        JOIN
            muscles m ON m.id = em.muscle_id
        WHERE
            e.user_id = :user_id;";

        $data = $database->query($query, ["user_id"=>$user_id])->fetchAll();
        $database->close();

        $customExercises = $this->getExercisesArray($data);

        $this->setCustomExercises($customExercises);
    }

    private function addCustomExercise(CustomExercise $customExercise, int $user_id): void
    {
        /** @var CustomExercise $exercise */
        foreach ($this->customExercises as $exercise){
            if ($exercise->getName() == $customExercise->getName()) return;
        }

        $database = new Database();
        $query = "
        INSERT INTO 
            custom_exercises (name, user_id) 
        VALUES 
            (:name, :user_id);";


        $database->query($query, ["name"=>$customExercise->getName(), "user_id"=>$user_id]);
        $exerciseId = $database->lastInsertId();

        ## TODO -> Add strength default to database

        foreach ($customExercise->getMusclesUsed() as $muscle){
            $query = "
            INSERT INTO 
                custom_exercise_muscles (custom_exercise_id, muscle_id, strength)
            VALUES
                (:custom_exercise_id, :muscle_id, 1);";

            $database->query($query, ["custom_exercise_id"=>$exerciseId, "muscle_id"=>$muscle->getId()]);
        }

        foreach ($customExercise->getEquipmentUsed() as $equipment){
            $query = "
            INSERT INTO 
                custom_exercise_equipment (custom_exercise_id, equipment_id) 
            VALUES 
                (:custom_exercise_id, :equipment_id);";

            $database->query($query, ["custom_exercise_id"=>$exerciseId, "equipment_id"=>$equipment->getId()]);
        }

        $database->close();
        $customExercise->setId($exerciseId);
        $this->customExercises[] = $customExercise;
    }


    public function getExercises(): array
    {
        return $this->exercises;
    }

    public function getCustomExercises(): array
    {
        return $this->customExercises;
    }

    private function getExercisesArray(false|array $data): array
    {
        $exercises = [];

        foreach ($data as $row) {
            $muscles = [];
            $equipment = [];
            foreach ($data as $exercise) {
                if ($exercise['exercise_id'] == $row['exercise_id']) {
                    $muscle = new ExerciseMuscle($exercise['muscle_id'], $exercise['muscle_name'], $exercise['muscle_strength']);
                    $eq = new Equipment($exercise['equipment_id'], $exercise['equipment_name']);

                    if (!array_search($muscle, $muscles)) $muscles[] = $muscle;
                    if (!array_search($eq, $equipment)) $equipment[] = $eq;
                }
            }

            //Add exercise to array
            $exercises[$row['exercise_id']] = new Exercise($row['exercise_id'], $row['exercise_name'], $equipment, $muscles);
        }
        return $exercises;
    }
}