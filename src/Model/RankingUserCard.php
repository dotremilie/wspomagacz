<?php

namespace Wspomagacz\Model;

use DateTime;

class RankingUserCard
{
    private int $id;
    private string $username;
    private int $place;
    private int $weight;

    public function __construct(int $id, string $username, int $place, int $weight)
    {

        $this->id = $id;
        $this->username = $username;
        $this->place = $place;
        $this->weight = $weight;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function getPlace(): int
    {
        return $this->place;
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