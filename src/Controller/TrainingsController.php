<?php

namespace Wspomagacz\Controller;

use DateTime;
use Exception;
use Wspomagacz\Core\Database;
use Wspomagacz\Enums\TrainingStatus;
use Wspomagacz\Model\Exercise;
use Wspomagacz\Model\Training;
use Wspomagacz\Model\TrainingExercise;
use Wspomagacz\Model\TrainingExerciseSet;
use Wspomagacz\View\View;

class TrainingsController
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
    public function create(): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $trainingObject = null;
        $exercises = [];

        if (isset($_GET['user_id']) && isset($_GET['training_id']) && isset($_GET['exercises'])) {
            $this->fetchTrainings(intval($_GET['user_id']));
            /** @var Training $training */
            foreach ($this->getTrainings() as $training) {
                if ($training->getId() == $_GET['training_id']) {
                    $trainingObject = $training;
                    break;
                }
            }

            $exercisesIntList = explode(',', $_GET['exercises']);

            foreach ($exercisesIntList as $exercise) {
                $exercisesController = new ExercisesController();

                $exercises[] = $exercisesController->fetchExerciseById(intval($exercise));
            }
        }

        $view = new View(__DIR__ . '/../View/Trainings');
        $view->render('create', ['training' => $trainingObject, 'exercises' => $exercises], 'Wspomagacz | Nowy Trening');
    }

    public function save_create(): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        if (!isset($_GET['name']) || !isset($_GET['date'])) header('Location: /trainings');

        if ($_GET['name'] == '' || $_GET['date'] == '') header('Location: /trainings');

        if (!($trainingId = $this->addTraining($_SESSION['user_id'], $_GET['name'], $_GET['date']))) header('Location: /trainings');

        if (!isset($_GET['exercises'])) header('Location: /trainings');

        $exercisesIds = explode(',', $_GET['exercises']);

        foreach ($exercisesIds as $exerciseId) {
            $this->addTrainingExercise(intval($trainingId), intval($exerciseId));
        }

        header('Location: /trainings');
    }

    /**
     * @throws Exception
     */
    public function show(array $params): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $trainingId = isset($params['id']) ? (int)$params['id'] : null;
        $trainingObject = null;

        if (isset($_GET['set_status'])) $this->editTrainingStatus($trainingId, $_GET['set_status']);

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

    public function delete(array $params): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $trainingId = isset($params['id']) ? (int)$params['id'] : null;

        $this->fetchTrainings($_SESSION['user_id']);

        /** @var Training $training */
        foreach ($this->getTrainings() as $training) {
            if ($training->getId() == $trainingId) {
                $this->removeTraining($trainingId);
                break;
            }
        }
        header('Location: /trainings');
    }

    /**
     * @throws Exception
     */
    public function edit(array $params): void
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
        $view->render('edit', ['training' => $trainingObject], "Wspomagacz | $titleTraining");
    }

    public function save_edit(array $params): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $trainingId = isset($params['id']) ? (int)$params['id'] : null;
        $trainingName = isset($_GET['name']) ? (int)$_GET['name'] : null;
        $trainingDate = isset($_GET['date']) ? (int)$_GET['date'] : null;

        $this->fetchTrainings($_SESSION['user_id']);

        /** @var Training $training */
        foreach ($this->getTrainings() as $training) {
            if ($training->getId() == $trainingId) {
                if (isset($trainingName) && isset($trainingDate)) $this->editTraining($trainingId, $trainingName, $trainingDate);
                else if (isset($trainingName))  $this->editTraining($trainingId, $trainingName, $training->getDate());
                else if (isset($trainingDate))  $this->editTraining($trainingId, $training->getName(), $trainingDate);
                break;
            }
        }
        header("Location: /trainings/$trainingId");
    }

    /**
     * @throws Exception
     */
    public function show_exercise(array $params): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $trainingId = isset($params['training_id']) ? (int)$params['training_id'] : null;
        $exerciseId = isset($params['exercise_id']) ? (int)$params['exercise_id'] : null;
        $trainingObject = null;
        $exerciseObject = null;

        if (isset($_GET['set_status'])) $this->editTrainingExerciseStatus($exerciseId, $_GET['set_status']);

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
    public function add_exercise(array $params): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $trainingId = isset($params['training_id']) ? (int)$params['training_id'] : null;
        $trainingObject = null;

        $this->fetchTrainings($_SESSION['user_id']);

        /** @var Training $training */
        foreach ($this->getTrainings() as $training) {
            if ($training->getId() == $trainingId) {
                $trainingObject = $training;
                break;
            }
        }

        $exerciseController = new ExercisesController();

        $exerciseController->fetchExercises();

        $exercises = $exerciseController->getExercises();

        $view = new View(__DIR__ . '/../View/TrainingExercises');
        $view->render('add', ['training' => $trainingObject, 'exercises' => $exercises], "Wspomagacz | Dodaj Ćwiczenie");
    }

    /**
     * @throws Exception
     */
    public function save_add_exercise(array $params): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $trainingId = isset($params['training_id']) ? (int)$params['training_id'] : null;
        $exerciseId = isset($params['exercise_id']) ? (int)$params['exercise_id'] : null;

        $this->fetchTrainings($_SESSION['user_id']);

        /** @var Training $training */
        foreach ($this->getTrainings() as $training) {
            if ($training->getId() == $trainingId) {
                $this->addTrainingExercise($trainingId, $exerciseId);
                break;
            }
        }

        header("Location: /trainings/$trainingId");
    }

    public function delete_exercise(array $params): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $trainingId = isset($params['training_id']) ? (int)$params['training_id'] : null;
        $trainingExerciseId = isset($params['exercise_id']) ? (int)$params['exercise_id'] : null;

        $this->fetchTrainings($_SESSION['user_id']);

        /** @var Training $training */
        foreach ($this->getTrainings() as $training) {
            if ($training->getId() == $trainingId) {
                $this->removeTrainingExercise($trainingExerciseId);
                break;
            }
        }
        header('Location: /trainings');
    }

    /**
     * @throws Exception
     */
    public function show_set(array $params): void
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

    /**
     * @throws Exception
     */
    public function edit_set(array $params): void
    {
        $titleTraining = isset($trainingObject) ? $trainingObject->getName() : "Nie znaleziono";

        $view = new View(__DIR__ . '/../View/TrainingExerciseSets');
        $view->render('edit', [], "Wspomagacz | $titleTraining");
    }

    public function delete_set(array $params): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $trainingId = isset($params['training_id']) ? (int)$params['training_id'] : null;
        $exerciseId = isset($params['exercise_id']) ? (int)$params['exercise_id'] : null;
        $setId = isset($params['set_id']) ? (int)$params['set_id'] : null;

        $this->fetchTrainings($_SESSION['user_id']);

        /** @var Training $training */
        foreach ($this->getTrainings() as $training) {
            if ($training->getId() == $trainingId) {
                $this->removeSet($setId);
                break;
            }
        }

        header("Location: /trainings/$trainingId/exercises/$exerciseId");
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
            $trainingExercisesArray = [];

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

            if ($trainingExercises = $database->query($query, ["training_id" => $training['training_id']])->fetchAll()) {
                foreach ($trainingExercises as $trainingExercise) {
                    $trainingExercisesSetsArray = [];

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

                    if ($trainingExercisesSets = $database->query($query, ["training_exercise_id" => $trainingExercise['id']])->fetchAll()) {
                        foreach ($trainingExercisesSets as $trainingExercisesSet) $trainingExercisesSetsArray[] = new TrainingExerciseSet($trainingExercisesSet['id'], $trainingExercisesSet['order'], $trainingExercisesSet['repetitions'], $trainingExercisesSet['weight']);
                    }

                    $trainingExercisesArray[] = new TrainingExercise($trainingExercise['id'], $training['training_id'], $trainingExercise['name'], $trainingExercise['order'], TrainingStatus::from($trainingExercise['status']), $trainingExercisesSetsArray);
                }
            }

            $trainingsArray[] = new Training($training['training_id'], $training['user_id'], $training['training_name'], $training['burnt_calories'], new DateTime($training['date']), TrainingStatus::from($training['status']), null, null, $trainingExercisesArray);
        }

        $this->setTrainings($trainingsArray);
        $database->close();
    }

    private function addTraining(int $user_id, string $training_name, string $training_date): false|string
    {
        $database = new Database();

        $query = "
        INSERT INTO
            trainings (user_id, name, date, status)
        VALUES
            (:user_id, :training_name, :training_date, 1)";

        $database->query($query, ["user_id" => $user_id, "training_name" => $training_name, "training_date" => $training_date]);
        $lastInsertId = $database->lastInsertId();

        $database->close();
        return $lastInsertId;
    }

    private function editTraining(int $training_id, string $training_name, string $training_date): void
    {
        $database = new Database();

        $query = "
        UPDATE trainings
        SET
            name = :training_name,
            date = :training_date
        WHERE
            id = :training_id;";

        $database->query($query, ["training_id" => $training_id, "training_name" => $training_name, "training_date" => $training_date]);
        $database->close();
    }

    private function editTrainingStatus(int $trainingId, int $trainingStatus): void
    {
        $database = new Database();

        $query = "UPDATE trainings SET status = :training_status WHERE id = :training_id;";

        $database->query($query, ["training_id" => $trainingId, "training_status" => $trainingStatus]);
        $database->close();
    }

    private function removeTraining(int $trainingId): void
    {
        $database = new Database();

        $query = "DELETE FROM trainings where id = :training_id";

        $database->query($query, ["training_id" => $trainingId]);
        $database->close();
    }

    private function addTrainingExercise(int $trainingId, int $exerciseId): false|string
    {
        $database = new Database();

        $query = "
        INSERT INTO
            training_exercises (training_id, exercise_id, `order`)
        VALUES
            (:training_id, :exercise_id, (SELECT COALESCE(MAX(`order`), 0) + 1 FROM training_exercises te WHERE te.training_id = :training_id));";

        $database->query($query, ["training_id" => $trainingId, "exercise_id" => $exerciseId]);
        $lastInsertId = $database->lastInsertId();

        $database->close();
        return $lastInsertId;
    }

    private function removeTrainingExercise(int $trainingExerciseId): void
    {
        $database = new Database();

        $query = "DELETE FROM training_exercises where id = :training_exercise_id";

        $database->query($query, ["training_exercise_id" => $trainingExerciseId]);
        $database->close();
    }

    private function editTrainingExerciseStatus(int $exerciseId, int $exerciseStatus): void
    {
        $database = new Database();

        $query = "UPDATE training_exercises SET status = :exercise_status WHERE id = :exercise_id";

        $database->query($query, ["exercise_id" => $exerciseId, "exercise_status" => $exerciseStatus]);
        $database->close();
    }

    private function removeSet(int $setId): void
    {
        $database = new Database();

        $query = "DELETE FROM training_exercises_sets where id = :set_id";

        $database->query($query, ["set_id" => $setId]);
        $database->close();
    }

}