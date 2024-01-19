<?php

namespace Wspomagacz\Model;

use Wspomagacz\Enums\TrainingStatus;

class TrainingExercise
{
    private int $id;
    private string $name;
    private int $order;
    private TrainingStatus $status;
    private array $sets;

    public function __construct(int $id, string $name, int $order, TrainingStatus $status, array $sets = [])
    {
        $this->id = $id;
        $this->order = $order;
        $this->sets = $sets;
        $this->status = $status;
        $this->name = $name;
    }

    public function getOrder(): int
    {
        return $this->order;
    }

    public function setOrder(int $order): void
    {
        $this->order = $order;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getSets(): array
    {
        return $this->sets;
    }

    public function setSets(array $sets): void
    {
        $this->sets = $sets;
    }

    public function getStatus(): TrainingStatus
    {
        return $this->status;
    }

    public function setStatus(TrainingStatus $status): void
    {
        $this->status = $status;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}