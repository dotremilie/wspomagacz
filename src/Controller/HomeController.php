<?php

namespace Wspomagacz\Controller;

use Wspomagacz\View\View;

class HomeController
{
    public function index(): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $view = new View(__DIR__ . '/../View/Home');
        $view->render('index', [], 'Wspomagacz | Strona Główna');
    }
}