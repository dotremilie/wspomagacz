<?php

namespace Wspomagacz\Controller;

use Wspomagacz\View\View;

class StartupController
{
    public function index(): void
    {
        session_start();

        if (isset($_SESSION['user_id'])) {
            header('Location: /');
        }

        $view = new View(__DIR__ . '/../View/Startup');
        $view->render('index', [], 'Wspomagacz | Ekran Powitalny');
    }
}