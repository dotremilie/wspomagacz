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

    private function verifyLogin(string $username, string $password): bool
    {
        $database = new Database();

        $query = "SELECT u.password_hash FROM users u WHERE u.username = :username;";

        $password_hash = $database->query($query, ['username' => $username])->fetch();

        if (password_verify($password, $password_hash)) return true;
        return false;
    }
}