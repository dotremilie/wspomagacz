<?php

use Wspomagacz\Server\Utilities\Response;

/** @var array $data */
$response = new Response($data['message'], $data['code']);

$response->send();