<?php

namespace Wspomagacz\Controller;

use Wspomagacz\View\View;

class ProfileController
{
    public function index(): void
    {
        if (!isset($_SESSION['user_id'])) header('Location: /startup');

        $view = new View(__DIR__ . '/../View/Profile');
        $view->render('index', [], 'Wspomagacz | Profil');
    }
}