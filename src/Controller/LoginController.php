<?php

namespace Wspomagacz\Controller;

use Wspomagacz\Core\Database;
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

    public function verify(): void
    {
        if (isset($_POST['login']) && isset($_POST['password'])) {
            if ($user_id = $this->verifyLogin($_POST['login'], $_POST['password'])) {
                session_start();
                $_SESSION['user_id'] = $user_id;
            }
        }
    }

    private function verifyLogin(string $username, string $password): bool | int
    {
        $database = new Database();

        $query = "SELECT u.id, u.password_hash FROM users u WHERE u.username = :username;";

        $user_data = $database->query($query, ['username' => $username])->fetch();

        if (password_verify($password, $user_data['password_hash'])) return $user_data['id'];
        return false;
    }
}