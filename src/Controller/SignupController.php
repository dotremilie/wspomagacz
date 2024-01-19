<?php

namespace Wspomagacz\Controller;

use Wspomagacz\Core\Database;
use Wspomagacz\Model\InputField;
use Wspomagacz\View\View;

class SignupController
{
    public function index(): void
    {
        if (isset($_SESSION['user_id'])) header('Location: /');

        $inputFields = [
            new InputField('login', 'Nazwa użytkownika', 'Nazwa użytkownika może się składać tylko z liter, cyfr i mieć od 3 do 24 znaków.', 'user'),
            new InputField('password', 'Hasło', 'Hasło musi zawierać co najmniej jedną wielką literę, znak specjalny, cyfrę i mieć co najmniej 8 znaków.', 'lock'),
            new InputField('repeat-password', 'Powtórz hasło', 'Hasła muszą być takie same.', 'lock'),
            new InputField('email', 'Adres e-mail', 'Nieprawidłowy adres e-mail.', 'at-sign'),
        ];

        $view = new View(__DIR__ . '/../View/Signup');
        $view->render('index', $inputFields, 'Wspomagacz | Rejestracja');
    }

    public function verify(): void
    {
        if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['repeat-password']) && isset($_POST['email'])) {
            if (is_string($this->createUser($_POST['login'], $_POST['password'], $_POST['email'], 1))) header('Location: /login');
        } else header('Location: /signup');
    }

    private function createUser(string $username, string $password, string $email, int $gender): false|string
    {
        if ($this->checkIfUsernameExists($username)) return false;
        if ($this->checkIfEmailExists($email)) return false;

        $database = new Database();

        $query = "
        INSERT INTO
            users (username, password_hash, email, gender)
        VALUES
            (:username, :password, :email, :gender)";

        $database->query($query, ['username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT), 'email' => $email, 'gender' => $gender,]);
        $lastInsertId = $database->lastInsertId();

        $database->close();
        return $lastInsertId;
    }

    private function checkIfUsernameExists(string $username): bool
    {
        $database = new Database();

        $query = "SELECT u.id FROM users u WHERE u.username = :username";

        $user = $database->query($query, ['username' => $username])->fetch();

        $database->close();

        if (isset($user['id'])) return true;
        return false;
    }

    private function checkIfEmailExists(string $email): bool
    {
        $database = new Database();

        $query = "SELECT u.id FROM users u WHERE u.email = :email";

        $user = $database->query($query, ['email' => $email])->fetch();

        $database->close();

        if (isset($user['email'])) return true;
        return false;
    }
}