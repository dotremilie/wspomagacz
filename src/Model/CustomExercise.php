<?php

namespace Wspomagacz\Model;

class CustomExercise extends Exercise
{
    protected User $user;

    public function __construct(int $id, string $name, array $equipmentUsed, array $musclesUsed)
    {
        parent::__construct($id, $name, $equipmentUsed, $musclesUsed);
    }
}