<?php

namespace Wspomagacz\Model;

use DateTime;

class UserExercisePersonalBest
{
    private int $id;
    private int $trainingId;
    private int $trainingExerciseId;
    private DateTime $date;
    private float $weight;

    public function __construct(int $id, int $trainingId, int $trainingExerciseId, \DateTime $date, float $weight)
    {
        $this->id = $id;
        $this->trainingId = $trainingId;
        $this->trainingExerciseId = $trainingExerciseId;
        $this->date = $date;
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

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    public function getTrainingExerciseId(): int
    {
        return $this->trainingExerciseId;
    }

    public function setTrainingExerciseId(int $trainingExerciseId): void
    {
        $this->trainingExerciseId = $trainingExerciseId;
    }

    public function getTrainingId(): int
    {
        return $this->trainingId;
    }

    public function setTrainingId(int $trainingId): void
    {
        $this->trainingId = $trainingId;
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