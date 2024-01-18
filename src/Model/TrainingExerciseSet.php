<?php

namespace Wspomagacz\Model;

class TrainingExerciseSet
{
    private int $id;
    private int $order;
    private int $repetitions;
    private float $weight;

    public function __construct(int $id, int $order, int $repetitions, float $weight)
    {
        $this->id = $id;
        $this->order = $order;
        $this->repetitions = $repetitions;
        $this->weight = $weight;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): void
    {
        $this->weight = $weight;
    }

    public function getRepetitions(): int
    {
        return $this->repetitions;
    }

    public function setRepetitions(int $repetitions): void
    {
        $this->repetitions = $repetitions;
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
}