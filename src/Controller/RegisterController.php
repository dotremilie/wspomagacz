<?php

namespace Wspomagacz\Controller;

use Wspomagacz\View\View;

class RegisterController
{
    public function index(): void
    {
        $view = new View(__DIR__ . '/../View/Register');
        $view->render('index', [], 'Wspomagacz | Rejestracja');
    }
}