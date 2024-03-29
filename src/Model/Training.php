<?php

namespace Wspomagacz\Model;

use DateTime;
use Wspomagacz\Enums\TrainingStatus;

class Training
{
    private int $id;
    private int $userId;
    private string $name;
    private int $burnedCalories;
    private ?DateTime $date;
    private TrainingStatus $status;
    private ?DateTime $startedAt;
    private ?DateTime $finishedAt;
    private array $exercises;

    public function __construct(int $id, int $userId, string $name, int $burnedCalories, DateTime $date, TrainingStatus $status, DateTime|null $startedAt, DateTime|null $FinishedAt, array $exercises = [])
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->name = $name;
        $this->burnedCalories = $burnedCalories;
        $this->date = $date;
        $this->status = $status;
        $this->startedAt = $startedAt;
        $this->finishedAt = $FinishedAt;
        $this->exercises = $exercises;
    }

    public function getFinishedAt(): ?DateTime
    {
        return $this->finishedAt;
    }

    public function setFinishedAt(?DateTime $finishedAt): void
    {
        $this->finishedAt = $finishedAt;
    }

    public function getStartedAt(): ?DateTime
    {
        return $this->startedAt;
    }

    public function setStartedAt(?DateTime $startedAt): void
    {
        $this->startedAt = $startedAt;
    }

    public function getStatus(): TrainingStatus
    {
        return $this->status;
    }

    public function setStatus(TrainingStatus $status): void
    {
        $this->status = $status;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getBurnedCalories(): int
    {
        return $this->burnedCalories;
    }

    public function setBurnedCalories(int $burnedCalories): void
    {
        $this->burnedCalories = $burnedCalories;
    }

    public function getDate(): ?DateTime
    {
        return $this->date;
    }

    public function setDate(?DateTime $date): void
    {
        $this->date = $date;
    }

    public function getExercises(): array
    {
        return $this->exercises;
    }

    public function setExercises(array $exercises): void
    {
        $this->exercises = $exercises;
    }
}