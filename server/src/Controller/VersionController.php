<?php
namespace Wspomagacz\Server\Controller;

use Wspomagacz\Server\View\View;

class VersionController
{
    public static function index(): void
    {
        $data = [
            'message' => [
                'version' => '1.0',
            ],
            'code' => 200
        ];

        $view = new View(__DIR__ . '/../View/Default');
        $view->render('index', $data);
    }
}