<?php

namespace Wspomagacz\Model;

use DateTime;
use Wspomagacz\Enums\TrainingStatus;

class CommunityTraining
{
    private int $trainingId;
    private int $userId;
    private string $userName;
    private string $trainingName;
    private array $exercises;

    public function __construct(int $trainingId, int $userId, string $userName, string $trainingName, array $exercises)
    {
        $this->trainingId = $trainingId;
        $this->userId = $userId;
        $this->userName = $userName;
        $this->trainingName = $trainingName;
        $this->exercises = $exercises;
    }

    public function getTrainingId(): int
    {
        return $this->trainingId;
    }

    public function setTrainingId(int $trainingId): void
    {
        $this->trainingId = $trainingId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    public function getTrainingName(): string
    {
        return $this->trainingName;
    }

    public function setTrainingName(string $trainingName): void
    {
        $this->trainingName = $trainingName;
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