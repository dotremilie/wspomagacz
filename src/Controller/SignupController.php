<?php

namespace Wspomagacz\Controller;

use Wspomagacz\Model\InputField;
use Wspomagacz\View\View;

class SignupController
{
    public function index(): void
    {
        $inputFields = [
            new InputField('login', 'Nazwa użytkownika', 'Nazwa użytkownika może się składać tylko z liter, cyfr i mieć od 3 do 24 znaków.', 'user'),
            new InputField('password', 'Hasło', 'Hasło musi zawierać co najmniej jedną wielką literę, znak specjalny, cyfrę i mieć co najmniej 8 znaków.', 'lock'),
            new InputField('repeat-password', 'Powtórz hasło', 'Hasła muszą być takie same.', 'lock'),
            new InputField('email', 'Adres e-mail', 'Nieprawidłowy adres e-mail.', 'at-sign'),
        ];

        $view = new View(__DIR__ . '/../View/Signup');
        $view->render('index', $inputFields, 'Wspomagacz | Rejestracja');
    }
}