<?php

namespace Wspomagacz\Model;

class RankingCard
{
    private int $id;
    private string $username;
    private int $trainings;
    private int $weight;

    public function __construct(int $id, string $username, int $trainings, int $weight)
    {
        $this->id = $id;
        $this->username = $username;
        $this->trainings = $trainings;
        $this->weight = $weight;
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
}