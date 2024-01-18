<?php

namespace Wspomagacz\Controller;

use Wspomagacz\View\View;

class TrainingController
{
    public function index(): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $view = new View(__DIR__ . '/../View/Training');
        $view->render('index', [], 'Wspomagacz | Treningi');
    }

    public function new(): void
    {
        $view = new View(__DIR__ . '/../View/Training');
        $view->render('new', [], 'Wspomagacz | Nowy Trening');
    }

    public function start(): void
    {
        $view = new View(__DIR__ . '/../View/Training');
        $view->render('new', [], 'Wspomagacz | Rozpocznij Trening');
    }
}