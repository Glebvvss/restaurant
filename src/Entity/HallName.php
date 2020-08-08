<?php

namespace Restaurant\Entity;

use InvalidArgumentException;

class HallName
{
    private string $name;

    public function __construct(string $name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('Hall name cannot be empty');
        }

        $this->name = $name;
    }

    public function string(): string
    {
        return mb_strtoupper(
            mb_substr(trim($this->name), 0, 1)) . mb_substr(trim($this->name), 1
        );
    }
}