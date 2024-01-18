<?php

namespace Wspomagacz\Controller;

use Wspomagacz\Model\InputField;
use Wspomagacz\View\View;

class LoginController
{
    public function index(): void
    {
        if (isset($_SESSION['user_id'])) header('Location: /');


        $view = new View(__DIR__ . '/../View/Login');
        $view->render('index', [], 'Wspomagacz | Logowanie');
    }
}