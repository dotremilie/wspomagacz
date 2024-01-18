<?php

namespace Wspomagacz\Controller;

use Wspomagacz\Core\Database;
use Wspomagacz\Model\ProfileStatistics;
use Wspomagacz\View\View;

class ProfileController
{
    private ProfileStatistics $profileStatistics;

    public function index(): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $this->fetchProfile($_SESSION['user_id']);

        $view = new View(__DIR__ . '/../View/Profile');
        $view->render('index', [$this->getProfileStatistics()], 'Wspomagacz | Profil');
    }

    private function fetchProfile(int $user_id): void
    {
        $database = new Database();

        $query = "
        SELECT
            u.id AS user_id,
            u.username,
            COUNT(DISTINCT t.id) AS training_count,
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

        $data = $database->query($query, ["user_id"=>$user_id])->fetch();
        $database->close();

        $this->profileStatistics = new ProfileStatistics($data['user_id'], $data['username'], $data['training_count'], $data['weight_sum'], $data['burnt_calories']);
    }

    public function getProfileStatistics(): ProfileStatistics
    {
        return $this->profileStatistics;
    }

    public function setProfileStatistics(ProfileStatistics $ProfileStatistics): void
    {
        $this->profileStatistics = $ProfileStatistics;
    }
}