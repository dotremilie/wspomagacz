<?php

namespace Wspomagacz\Client\Controller;

use Wspomagacz\Client\View\View;

class HomeController
{
    /**
     * @return void
     */
    public function index(): void
    {
        $view = new View(__DIR__ . '/../View/Home');
        $view->render('index', [], 'Wspomagacz | Strona Główna');
    }
}