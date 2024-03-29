<?php

namespace Wspomagacz\Model;

class UserStatistics
{
    private int $id;
    private string $username;
    private int $exercises;
    private float $weight;
    private int $burntCalories;

    public function __construct(int $id, string $username, int $exercises, float $weight, int $burntCalories)
    {
        $this->id = $id;
        $this->username = $username;
        $this->exercises = $exercises;
        $this->weight = $weight;
        $this->burntCalories = $burntCalories;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function getExercises(): int
    {
        return $this->exercises;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getBurntCalories(): int
    {
        return $this->burntCalories;
    }
}