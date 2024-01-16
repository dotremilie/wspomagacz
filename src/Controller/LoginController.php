<?php

namespace Wspomagacz\Controller;

use Wspomagacz\View\View;

class LoginController
{
    public function index(): void
    {
        $view = new View(__DIR__ . '/../View/Login');
        $view->render('index', [], 'Wspomagacz | Logowanie');
    }
}