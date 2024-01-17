<?php

namespace Wspomagacz\Client\Model;

class Equipment
{
    private int $id;
    private string $name;

    public function __construct(int $id, string $name, string $description)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}