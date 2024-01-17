<?php

namespace Wspomagacz\Server\Utilities;

class Response
{
    private int $code;
    private mixed $message;

    public function __construct(mixed $message = [], int $code = 200)
    {
        $this->message = $message;
        $this->code = $code;
    }

    public function send(): void
    {
        http_response_code($this->code);
        header('Content-Type: application/json');
        echo json_encode($this->message);
    }

    public function setMessage(mixed $message): void
    {
        $this->message = $message;
    }

    public function setCode(int $code): void
    {
        $this->code = $code;
    }
}