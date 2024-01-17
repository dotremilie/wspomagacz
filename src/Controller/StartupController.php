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
        $view->render('login', [], 'Wspomagacz | Ekran Powitalny');
    }

    public function login(): void
    {
        session_start();

        if (isset($_SESSION['user_id'])) {
            header('Location: /');
        }

        $view = new View(__DIR__ . '/../View/Startup');
        $view->render('login', [], 'Wspomagacz | Logowanie');
    }

    public function forgotPassword(): void
    {
        session_start();

        if (isset($_SESSION['user_id'])) {
            header('Location: /');
        }

        $view = new View(__DIR__ . '/../View/Startup');
        $view->render('forgotPassword', [], 'Wspomagacz | Zapomniałeś hasło?');
    }

    public function resetPassword(): void
    {
        session_start();

        if (isset($_SESSION['user_id'])) {
            header('Location: /');
        }

        $view = new View(__DIR__ . '/../View/Startup');
        $view->render('resetPassword', [], 'Wspomagacz | Zresetuj Hasło');
    }

    public function signup(): void
    {
        session_start();

        if (isset($_SESSION['user_id'])) {
            header('Location: /');
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'] ?? null;
            $password = $_POST['login'] ?? null;
            $repeatPassword = $_POST['login'] ?? null;
            $email = $_POST['login'] ?? null;
            $repeatEmail = $_POST['login'] ?? null;

            if(!isset($login)) {
                $errors[] = [
                    'field' => 'login',
                    'error' => 'Pole nie może być puste'
                ];
            } else {

            }

            if(!isset($_POST['login'])) {
                $errors[] = [
                    'field' => 'password',
                    'error' => 'Pole nie może być puste'
                ];
            }
        }


        $view = new View(__DIR__ . '/../View/Startup');
        $view->render('signup', $errors, 'Wspomagacz | Rejestracja');
    }
}