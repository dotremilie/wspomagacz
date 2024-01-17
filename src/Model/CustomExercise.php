<?php

namespace Wspomagacz\Model;

abstract class CustomExercise extends Exercise
{
    protected User $user;

    public function __construct(int $id, string $name, string $description, array $equipmentUsed, array $musclesUsed)
    {
        parent::__construct($id, $name, $description, $equipmentUsed, $musclesUsed);
    }
}