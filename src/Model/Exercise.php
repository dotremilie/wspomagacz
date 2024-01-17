<?php

namespace Wspomagacz\Model;

abstract class Exercise
{
    protected int $id;
    protected string $name;
    protected string $description;
    protected array $equipmentUsed;
    protected array $musclesUsed;

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