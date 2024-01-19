<?php

namespace Wspomagacz\Controller;

use DateTime;
use Exception;
use Wspomagacz\Core\Database;
use Wspomagacz\Enums\TrainingStatus;
use Wspomagacz\Model\Training;
use Wspomagacz\Model\UserExercisePersonalBest;
use Wspomagacz\View\View;

class HomeController
{
    private array $personalBests = [];
    private UserExercisePersonalBest $personalBest;
    private ?Training $todayTraining;

    /**
     * @throws Exception
     */
    public function index(): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $this->fetchPersonalBests($_SESSION['user_id']);
        $this->fetchTodayTraining($_SESSION['user_id']);


        $data = [
            'personalBests' => $this->getPersonalBests(),
            'todayTraining' => $this->getTodayTraining(),
            //'popularTrainings' => $this->getPopularTrainings()
        ];

        $view = new View(__DIR__ . '/../View/Home');
        $view->render('index', $data, 'Wspomagacz | Strona Główna');
    }

    /**
     * TODO: 5 "random" finished trainings as a popular trainings
     *
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

    /**
     * @throws Exception
     */
    private function fetchTodayTraining(int $user_id): void
    {
        $database = new Database();

        $query = "
        SELECT
            t.id,
            u.id AS user_id,
            t.name,
            t.burned_calories,
            t.date,
            t.status,
            t.started_at,
            t.finished_at
        FROM
            trainings t
                JOIN
            users u ON t.user_id = u.id
        WHERE
            u.id = :user_id
            AND t.status = 1
            AND DATE(t.date) = CURDATE()-1
        LIMIT 1";

        $data = $database->query($query, ["user_id" => $user_id])->fetch();
        $database->close();

        if (isset($data)) {
            $todayTraining = new Training($data['id'], $data['user_id'], $data['name'], $data['burned_calories'], new DateTime($data['date']), TrainingStatus::from($data['status']), new DateTime($data['started_at']), new DateTime($data['finished_at']));
            $this->setTodayTraining($todayTraining);
        }
    }

    public function getTodayTraining(): Training
    {
        return $this->todayTraining;
    }

    public function setTodayTraining(Training $todayTraining): void
    {
        $this->todayTraining = $todayTraining;
    }

}

