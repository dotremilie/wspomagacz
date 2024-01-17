<?php

namespace Wspomagacz\Client\Model;

use DateTime;

class User
{
    private int $id;
    private string $username;
    private ?string $email;
    private int $gender;
    private DateTime $birthday;
    private array $weights;
    private int $status;

    public function __construct(int $id, string $username, string $email, int $gender, DateTime $birthday, array $weights, int $status)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->gender = $gender;
        $this->birthday = $birthday;
        $this->weights = $weights;
        $this->status = $status;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getGender(): int
    {
        return $this->gender;
    }

    public function setGender(int $gender): void
    {
        $this->gender = $gender;
    }

    public function getAge(): DateTime
    {
        //TODO: Age from birthday
        return $this->birthday;
    }

    public function getWeights(): array
    {
        return $this->weights;
    }

    public function setWeights(array $weights): void
    {
        $this->weights = $weights;
    }

    public function addWeight(Weight $weight): void
    {
        $this->weights[] = $weight;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getBirthday(): DateTime
    {
        return $this->birthday;
    }
}