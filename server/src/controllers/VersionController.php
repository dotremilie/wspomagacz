<?php
namespace Wspomagacz\Server\Controllers;

class VersionController
{
    public static function getVersion(): void
    {
        $response = [
            'version' => '1.0',
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}