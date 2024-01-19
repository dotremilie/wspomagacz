<?php

namespace Wspomagacz\Controller;

use DateTime;
use Exception;
use Wspomagacz\Core\Database;
use Wspomagacz\Model\UserExercisePersonalBest;
use Wspomagacz\View\View;

class HomeController
{
    private array $personalBests = [];
    private UserExercisePersonalBest $personalBest;

    /**
     * @throws Exception
     */
    public function index(): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $this->fetchPersonalBests($_SESSION['user_id']);

        $data = [
            'personalBests' => $this->getPersonalBests()
            //'todayTraining' => $this->getTodayTraining(),
            //'popularTrainings' => $this->getPopularTrainings()
        ];

        $view = new View(__DIR__ . '/../View/Home');
        $view->render('index', $data, 'Wspomagacz | Strona Główna');
    }

    /**
     * TODO: Fetch today's training and its exercises.
     * 5 "random" finished trainings as a popular trainings
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

        $data = $database->query($query, ["user_id"=>$user_id])->fetchAll();
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

}

