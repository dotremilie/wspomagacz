<?php

namespace Wspomagacz\Model;

class CustomExercise extends Exercise
{
    protected int $user_id;

    public function __construct(int $id, string $name, array $equipmentUsed, array $musclesUsed, int $user_id)
    {
        parent::__construct($id, $name, $equipmentUsed, $musclesUsed);
        $this->user_id = $user_id;
    }
}