<?php

namespace Wspomagacz\Client\Controller;

use Wspomagacz\Client\View\View;

class RankingController
{
    public function index(): void
    {
        $view = new View(__DIR__ . '/../View/Ranking');
        $view->render('index', [], 'Wspomagacz | Ranking');
    }
}