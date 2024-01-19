<?php

namespace Wspomagacz\Controller;

use DateTime;
use Exception;
use Wspomagacz\Core\Database;
use Wspomagacz\Enums\TrainingStatus;
use Wspomagacz\Model\Training;
use Wspomagacz\Model\TrainingExercise;
use Wspomagacz\Model\TrainingExerciseSet;
use Wspomagacz\View\View;

class TrainingController
{
    private array $trainings = [];

    /**
     * @throws Exception
     */
    public function index(): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $this->fetchTrainings($_SESSION['user_id']);

        $view = new View(__DIR__ . '/../View/Trainings');
        $view->render('index', $this->getTrainings(), 'Wspomagacz | Treningi');
    }

    /**
     * @throws Exception
     */
    public function show(array $params): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $trainingId = isset($params['id']) ? (int)$params['id'] : null;
        $trainingObject = null;

        $this->fetchTrainings($_SESSION['user_id']);

        /** @var Training $training */
        foreach ($this->getTrainings() as $training) {
            if ($training->getId() == $trainingId) {
                $trainingObject = $training;
                break;
            }
        }

        $titleTraining = isset($trainingObject) ? $trainingObject->getName() : "Nie znaleziono";

        $view = new View(__DIR__ . '/../View/Trainings');
        $view->render('show', ['training' => $trainingObject], "Wspomagacz | $titleTraining");
    }

    /**
     * @throws Exception
     */
    public function showTrainingExercises(array $params): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $trainingId = isset($params['training_id']) ? (int)$params['training_id'] : null;
        $exerciseId = isset($params['exercise_id']) ? (int)$params['exercise_id'] : null;
        $trainingObject = null;
        $exerciseObject = null;

        $this->fetchTrainings($_SESSION['user_id']);

        /** @var Training $training */
        foreach ($this->getTrainings() as $training) {
            if ($training->getId() == $trainingId) {
                $trainingObject = $training;

                foreach ($training->getExercises() as $exercise) {
                    if ($exercise->getId() == $exerciseId) {
                        $exerciseObject = $exercise;
                        break;
                    }
                }
                break;
            }
        }

        $titleTraining = isset($trainingObject) ? $trainingObject->getName() : "Nie znaleziono";

        $view = new View(__DIR__ . '/../View/TrainingExercises');
        $view->render('show', ['training' => $trainingObject, 'exercise' => $exerciseObject], "Wspomagacz | $titleTraining");
    }

    /**
     * @throws Exception
     */
    public function showTrainingExerciseSets(array $params): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $trainingId = isset($params['training_id']) ? (int)$params['training_id'] : null;
        $exerciseId = isset($params['exercise_id']) ? (int)$params['exercise_id'] : null;
        $setId = isset($params['exercise_id']) ? (int)$params['exercise_id'] : null;
        $trainingObject = null;
        $exerciseObject = null;
        $setObject = null;

        $this->fetchTrainings($_SESSION['user_id']);

        /** @var Training $training */
        foreach ($this->getTrainings() as $training) {
            if ($training->getId() == $trainingId) {
                $trainingObject = $training;

                foreach ($training->getExercises() as $exercise) {
                    if ($exercise->getId() == $exerciseId) {
                        $exerciseObject = $exercise;

                        foreach ($exercise->getSets() as $set) {
                            if ($set->getId() == $setId) {
                                $setObject = $set;
                                break;
                            }
                        }
                        break;
                    }
                }
                break;
            }
        }

        $titleTraining = isset($trainingObject) ? $trainingObject->getName() : "Nie znaleziono";

        $view = new View(__DIR__ . '/../View/TrainingExerciseSets');
        $view->render('show', ['training' => $trainingObject, 'exercise' => $exerciseObject, 'set' => $setObject], "Wspomagacz | $titleTraining");
    }

    public function create(): void
    {
        $view = new View(__DIR__ . '/../View/Trainings');
        $view->render('create', [], 'Wspomagacz | Rozpocznij Trening');
    }

    public function getTrainings(): array
    {
        return $this->trainings;
    }

    public function setTrainings(array $trainings): void
    {
        $this->trainings = $trainings;
    }

    /**
     * @throws Exception
     */
    private function fetchTrainings(int $user_id): void
    {
        $database = new Database();

        $query = "
        SELECT
            t.id AS training_id,
            u.id AS user_id,
            t.name  AS training_name,
            t.burned_calories AS 'burnt_calories',
            t.date AS 'date',
            t.status AS 'status',
            t.started_at AS 'started_at',
            t.finished_at AS 'finished_at' 
        FROM
            trainings t
        JOIN
            users u ON t.user_id = u.id
        WHERE
            u.id = :user_id
        ORDER BY t.date DESC";

        if (!$trainings = $database->query($query, ["user_id" => $user_id])->fetchAll()) return;
        $trainingsArray = [];

        foreach ($trainings as $training) {
            $query = "
        SELECT 
            te.id,
            e.name,
            te.status,
            `order`
        FROM 
            training_exercises te
        JOIN
            trainings t ON t.id = te.training_id
        JOIN
            exercises e ON e.id = te.exercise_id
        WHERE 
            training_id = :training_id
        ORDER BY 
            `order`";

            if (!$trainingExercises = $database->query($query, ["training_id" => $training['training_id']])->fetchAll()) return;
            $trainingExercisesArray = [];

            foreach ($trainingExercises as $trainingExercise) {
                $query = "
            SELECT 
                tes.id,                  
                tes.`order`,
                repetitions,
                weight
            FROM 
                training_exercises_sets tes
            JOIN
                training_exercises te ON te.id = tes.training_exercise_id
            WHERE 
                training_exercise_id = :training_exercise_id
            ORDER BY 
                `order`";

                $trainingExercisesSets = $database->query($query, ["training_exercise_id" => $trainingExercise['id']])->fetchAll();
                $trainingExercisesSetsArray = [];

                foreach ($trainingExercisesSets as $trainingExercisesSet) $trainingExercisesSetsArray[] = new TrainingExerciseSet($trainingExercisesSet['id'], $trainingExercisesSet['order'], $trainingExercisesSet['repetitions'], $trainingExercisesSet['weight']);

                $trainingExercisesArray[] = new TrainingExercise($trainingExercise['id'], $trainingExercise['name'], $trainingExercise['order'], TrainingStatus::from($trainingExercise['status']), $trainingExercisesSetsArray);
            }

            $trainingsArray[] = new Training($training['training_id'], $training['user_id'], $training['training_name'], $training['burnt_calories'], new DateTime($training['date']), TrainingStatus::from($training['status']), new DateTime($training['started_at']), new DateTime($training['finished_at']), $trainingExercisesArray);
        }

        $this->setTrainings($trainingsArray);
    }
}