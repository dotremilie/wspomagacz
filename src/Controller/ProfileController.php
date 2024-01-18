<?php

namespace Wspomagacz\Controller;

use Wspomagacz\View\View;

class ProfileController
{
    public function index(): void
    {
        $view = new View(__DIR__ . '/../View/Profile');
        $view->render('index', [], 'Wspomagacz | Profil');
    }
}