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
                $_SESSION['user_id'] = $user_id;
                header('Location: /');
            }
        }
        header('Location: /login');
    }

    private function verifyLogin(string $username, string $password): bool | int
    {
        $database = new Database();

        $query = "SELECT u.id, u.password_hash, u.status FROM users u WHERE u.username = :username;";

        $user_data = $database->query($query, ['username' => $username])->fetch();

        if ($user_data['status'] == 3) return false;
        else if ($user_data['status'] == 2) $this->activateUser($user_data['id']);
        else if ($user_data['status'] == 1) $this->updateLastUserLogin($user_data['id']);

        if (password_verify($password, $user_data['password_hash'])) return $user_data['id'];
        return false;
    }

    private function activateUser(int $user_id): void
    {
        $database = new Database();

        $query = "UPDATE users u SET u.status = 1, u.last_logged_at = CURRENT_TIMESTAMP() WHERE u.id = :user_id";

        $database->query($query, ['user_id' => $user_id]);
    }

    private function updateLastUserLogin(int $user_id): void
    {
        $database = new Database();

        $query = "UPDATE users u SET u.last_logged_at = CURRENT_TIMESTAMP() WHERE u.id = :user_id";

        $database->query($query, ['user_id' => $user_id]);
    }
}