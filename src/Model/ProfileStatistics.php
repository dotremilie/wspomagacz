<?php

namespace Wspomagacz\Model;

class ProfileStatistics
{
    private int $id;
    private string $username;
    private int $trainings;
    private int $weight;
    private int $burntCalories;

    public function __construct(int $id, string $username, int $trainings, int $weight, int $burntCalories)
    {
        $this->id = $id;
        $this->username = $username;
        $this->trainings = $trainings;
        $this->weight = $weight;
        $this->burntCalories = $burntCalories;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function getTrainings(): int
    {
        return $this->trainings;
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