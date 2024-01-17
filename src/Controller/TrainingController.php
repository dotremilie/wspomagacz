<?php

namespace Wspomagacz\Client\Controller;

use Wspomagacz\Client\View\View;

class TrainingController
{
    public function index(): void
    {
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