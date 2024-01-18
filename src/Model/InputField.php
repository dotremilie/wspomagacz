<?php

namespace Wspomagacz\Model;

class InputField
{
    private string $id;
    private string $placeholder;
    private string $errorText;
    private string $icon;

    public function __construct(string $id, string $placeholder, string $errorText, string $icon)
    {
        $this->id = $id;
        $this->placeholder = $placeholder;
        $this->errorText = $errorText;
        $this->icon = $icon;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
    }

    public function getErrorText(): string
    {
        return $this->errorText;
    }

    public function setErrorText(string $errorText): void
    {
        $this->errorText = $errorText;
    }

    public function getPlaceholder(): string
    {
        return $this->placeholder;
    }

    public function setPlaceholder(string $placeholder): void
    {
        $this->placeholder = $placeholder;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}