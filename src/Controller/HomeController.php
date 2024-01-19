<?php

namespace Wspomagacz\Controller;

use DateTime;
use Exception;
use Wspomagacz\Core\Database;
use Wspomagacz\Enums\TrainingStatus;
use Wspomagacz\Model\CommunityTraining;
use Wspomagacz\Model\Exercise;
use Wspomagacz\Model\Training;
use Wspomagacz\Model\TrainingExercise;
use Wspomagacz\Model\TrainingExerciseSet;
use Wspomagacz\Model\UserExercisePersonalBest;
use Wspomagacz\Model\UserStatistics;
use Wspomagacz\View\View;

class HomeController
{
    private array $personalBests = [];
    private UserExercisePersonalBest $personalBest;
    private ?Training $todayTraining = null;
    private UserStatistics $userStatistics;
    private array $communityTrainings = [];

    /**
     * @throws Exception
     */
    public function index(): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $this->fetchPersonalBests($_SESSION['user_id']);
        $this->fetchTodayTraining($_SESSION['user_id']);
        $this->fetchUserStatistics($_SESSION['user_id']);
        $this->fetchCommunityTrainings();

        $data = [
            'personalBests' => $this->getPersonalBests(),
            'todayTraining' => $this->getTodayTraining(),
            'userStatistics' => $this->getUserStatistics(),
            'communityTrainings' => $this->getCommunityTrainings()
        ];

        $view = new View(__DIR__ . '/../View/Home');
        $view->render('index', $data, 'Wspomagacz | Strona Główna');
    }

    /**
     * @throws Exception
     */

    private function fetchPersonalBests(int $user_id): void
    {
        $database = new Database();

        $query = "
        SELECT
            u.id AS user_id,
            t.id AS training_id,
            e.name AS exercise_name,
            t.date,
            ueps.weight
        FROM
            user_exercise_personal_best ueps
        JOIN
            users u ON ueps.user_id = u.id
        JOIN
            exercises e ON ueps.exercise_id = e.id
        JOIN
            trainings t ON ueps.training_id = t.id
        WHERE
            u.id = :user_id";

        $data = $database->query($query, ["user_id" => $user_id])->fetchAll();
        $database->close();

        $personalBests = [];
        foreach ($data as $personalBest) {
            $personalBests[] = new UserExercisePersonalBest($personalBest['user_id'], $personalBest['training_id'], $personalBest['exercise_name'], new DateTime($personalBest['date']), $personalBest['weight']);
        }

        $this->setPersonalBests($personalBests);
    }

    public function getPersonalBests(): array
    {
        return $this->personalBests;
    }

    public function setPersonalBests(array $personalBests): void
    {
        $this->personalBests = $personalBests;
    }

    public function getPersonalBest(): UserExercisePersonalBest
    {
        return $this->personalBest;
    }

    public function setPersonalBest(UserExercisePersonalBest $personalBest): void
    {
        $this->personalBest = $personalBest;
    }

    private function fetchUserStatistics(int $user_id): void
    {
        $database = new Database();

        $query = "
        SELECT
            u.id AS user_id,
            u.username,
            COUNT(DISTINCT te.id) AS exercise_count,
            COALESCE(SUM(tes.repetitions * tes.weight), 0) AS weight_sum,
            COALESCE(SUM(t.burned_calories), 0) AS burnt_calories
        FROM
            users u
                LEFT JOIN
            trainings t ON u.id = t.user_id
                LEFT JOIN
            training_exercises te ON t.id = te.training_id
                LEFT JOIN
            training_exercises_sets tes ON te.id = tes.training_exercise_id
        WHERE
            u.id = :user_id";

        $data = $database->query($query, ["user_id" => $user_id])->fetch();
        $database->close();

        $this->userStatistics = new UserStatistics($data['user_id'], $data['username'], $data['exercise_count'], $data['weight_sum'], $data['burnt_calories']);
    }

    /**
     * @throws Exception
     */
    private function fetchTodayTraining(int $user_id): void
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
            AND t.date = CURDATE()
        LIMIT 1";

        if (!$data = $database->query($query, ["user_id" => $user_id])->fetch()) return;

        $trainingId = $data['training_id'];

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

        if (!$trainingExercises = $database->query($query, ["training_id" => $trainingId])->fetchAll()) return;
        $trainingExercisesArray = [];

        foreach($trainingExercises as $trainingExercise) {
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

            $trainingExercisesArray[] = new TrainingExercise($trainingExercise['id'], $trainingId, $trainingExercise['name'], $trainingExercise['order'], TrainingStatus::from($trainingExercise['status']), $trainingExercisesSetsArray);
        }

        $todayTraining = new Training($data['training_id'], $data['user_id'], $data['training_name'], $data['burnt_calories'], new DateTime($data['date']), TrainingStatus::from($data['status']), new DateTime($data['started_at']), new DateTime($data['finished_at']), $trainingExercisesArray);
        $this->setTodayTraining($todayTraining);
    }

    public function getTodayTraining(): Training|null
    {
        return $this->todayTraining;
    }

    public function setTodayTraining(Training $todayTraining): void
    {
        $this->todayTraining = $todayTraining;
    }

    public function getUserStatistics(): UserStatistics
    {
        return $this->userStatistics;
    }

    public function setUserStatistics(UserStatistics $ProfileStatistics): void
    {
        $this->userStatistics = $ProfileStatistics;
    }

    private function fetchCommunityTrainings(): void
    {
        $database = new Database();

        $query = "
        SELECT
            t.id AS training_id,
            u.id AS user_id,
            u.username AS username,
            t.name  AS training_name
        FROM
            trainings t
            JOIN users u ON t.user_id = u.id
        WHERE t.status = 3
        ORDER BY RAND()
        LIMIT 5";
        $trainingData = $database->query($query)->fetchAll();

        $communityTrainings = [];
        foreach ($trainingData as $training) {

            $query = "
            SELECT
                e.id AS exercise_id,
                e.name AS exercise_name
            FROM
                exercises e
                JOIN training_exercises te ON e.id = te.exercise_id
                JOIN trainings t ON te.training_id = t.id
            WHERE t.id = :training_id";
            $exercisesData = $database->query($query, ["training_id"=>$training['training_id']])->fetchAll();

            $exercises = [];
            foreach ($exercisesData as $exercise) $exercises[] = new Exercise($exercise['exercise_id'], $exercise['exercise_name'], [], []);

            $communityTrainings[] = new CommunityTraining($training['training_id'], $training['user_id'], $training['username'], $training['training_name'], $exercises);
        }

        $database->close();
        $this->setCommunityTrainings($communityTrainings);
    }

    public function getCommunityTrainings(): array
    {
        return $this->communityTrainings;
    }

    public function setCommunityTrainings(array $communityTrainings): void
    {
        $this->communityTrainings = $communityTrainings;
    }
}

