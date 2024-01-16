<?php
namespace WspomagaczServer\Controllers;

class VersionController
{
    public static function getVersion()
    {
        $response = [
            'version' => '1.0',
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}