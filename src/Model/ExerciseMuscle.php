<?php

namespace Wspomagacz\Model;

class ExerciseMuscle extends Muscle
{
    private int $strength;

    public function __construct(int $id, string $name, int $strength)
    {
        parent::__construct($id, $name);
        $this->strength = $strength;
    }

    public function getStrength(): int
    {
        return $this->strength;
    }

    public function setStrength(int $strength): void
    {
        $this->strength = $strength;
    }
}