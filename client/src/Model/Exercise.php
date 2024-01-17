<?php

namespace Wspomagacz\Client\Model;

class Exercise
{
    private int $id;
    private string $name;
    private string $description;
    private array $equipmentUsed;
    private array $musclesUsed;

    public function __construct(int $id, string $name, string $description, array $equipmentUsed, array $musclesUsed)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->equipmentUsed = $equipmentUsed;
        $this->musclesUsed = $musclesUsed;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getEquipmentUsed(): array
    {
        return $this->equipmentUsed;
    }

    public function getMusclesUsed(): array
    {
        return $this->musclesUsed;
    }
}