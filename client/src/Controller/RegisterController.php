<?php

namespace Wspomagacz\Client\Controller;

use Wspomagacz\Client\View\View;

class RegisterController
{
    public function index(): void
    {
        session_start();

        if (isset($_SESSION['user_id'])) {
            header('Location: /');
        }

        $view = new View(__DIR__ . '/../View/Register');
        $view->render('index', [], 'Wspomagacz | Rejestracja');
    }
}