<?php

namespace Wspomagacz\Model;

class Exercise
{
    protected ?int $id;
    protected string $name;
    protected array $equipmentUsed;
    protected array $musclesUsed;

    public function __construct(int|null $id, string $name, array $equipmentUsed, array $musclesUsed)
    {
        $this->id = $id;
        $this->name = $name;
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

    public function getEquipmentUsed(): array
    {
        return $this->equipmentUsed;
    }

    public function getMusclesUsed(): array
    {
        return $this->musclesUsed;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }
}