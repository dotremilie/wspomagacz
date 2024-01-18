<?php

namespace Wspomagacz\Controller;

use Wspomagacz\Core\Database;
use Wspomagacz\Model\RankingCard;
use Wspomagacz\Model\RankingUserCard;
use Wspomagacz\View\View;

class RankingController
{
    private array $ranking = [];
    private RankingUserCard $rankingUserCard;

    public function index(): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $this->fetchRanking($_SESSION['user_id']);

        $data = [
            'userCard' => $this->getRankingUserCard(),
            'ranking' => $this->getRanking()
        ];

        $view = new View(__DIR__ . '/../View/Ranking');
        $view->render('index', $data, 'Wspomagacz | Ranking');
    }

    public function setRanking(array $ranking): void
    {
        $this->ranking = $ranking;
    }

    public function getRanking(): array
    {
        return $this->ranking;
    }

    private function fetchRanking(int $user_id): void
    {
        $database = new Database();

        $query = "
        SELECT
            u.id AS user_id,
            u.username,
            COUNT(DISTINCT t.id) AS training_count,
            SUM(tes.repetitions * tes.weight) AS weight_sum
        FROM
            users u
                LEFT JOIN
            trainings t ON u.id = t.user_id
                LEFT JOIN
            training_exercises te ON t.id = te.training_id
                LEFT JOIN
            training_exercises_sets tes ON te.id = tes.training_exercise_id
        WHERE
            u.status = 1
        GROUP BY
            u.id, u.username
        ORDER BY
            weight_sum DESC";

        $data = $database->query($query)->fetchAll();
        $database->close();

        $ranking = [];
        foreach ($data as $rankingUser) {
            $ranking[] = new RankingCard($rankingUser['user_id'], $rankingUser['username'], $rankingUser['training_count'], $rankingUser['weight_sum']);
        }

        $this->setRanking($ranking);

        foreach ($data as $key => $rankingUser) {
            if ($rankingUser['user_id'] = $user_id){
                $this->setRankingUserCard(new RankingUserCard($rankingUser['user_id'], $rankingUser['username'], ($key+1), $rankingUser['weight_sum']));
            }
        }
    }

    public function getRankingUserCard(): RankingUserCard
    {
        return $this->rankingUserCard;
    }

    public function setRankingUserCard(RankingUserCard $rankingUserCard): void
    {
        $this->rankingUserCard = $rankingUserCard;
    }
}