<?php

namespace Wspomagacz\Controller;

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

        $this->fetchRanking();

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

    private function fetchRanking(): void
    {
        $ranking = [
            new RankingCard(1, 'sneakydog', 20, 12061),
            new RankingCard(2, 'Remilie', 14, 10038),
            new RankingCard(3, 'suprenoctome', 11, 9047),
            new RankingCard(4, 'FleQQ', 9, 7015),
        ];

        /*
         * TODO: Fetch Rankings
         *
         * Group Trainings by user
         * Count Trainings
         * Sum Sets for each exercise, sort by this sum
         * Get User id from session
         * Find User place, username and weights from $ranking array by id
         */

        $this->setRanking($ranking);
        $this->setRankingUserCard(new RankingUserCard(1, 'sneakydog', 1, 12061));

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