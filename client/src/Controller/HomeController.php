<?php

namespace Wspomagacz\Controller;

use Wspomagacz\View\View;

class HomeController
{
    public function index(): void
    {
        $view = new View(__DIR__ . '/../View/Home');
        $view->render('index', [], 'Wspomagacz | Strona Główna');
    }
}