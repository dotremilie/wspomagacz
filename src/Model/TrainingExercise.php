<?php

namespace Wspomagacz\Model;

class TrainingExercise
{
    private int $id;
    private int $order;
    private array $sets;

    public function __construct(int $id, int $order, array $sets)
    {
        $this->id = $id;
        $this->order = $order;
        $this->sets = $sets;
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
}