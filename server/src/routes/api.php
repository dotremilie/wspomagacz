<?php

$request_uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

switch ($request_uri) {
    case '/api/v1/version':
        if ($method === 'GET') {
            \WspomagaczServer\Controllers\VersionController::getVersion();
        } else {
            http_response_code(405); // Method Not Allowed
        }
        break;
    default:
        http_response_code(404); // Not Found
        break;
}