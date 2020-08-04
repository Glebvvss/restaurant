<?php

namespace Restaurant\Entity;

class Table
{
    private $reserves;

    public function __construct(array $reserves)
    {
        $this->reserves = $reserves;
    }

    public function reserves(): array
    {
        return $this->reserves;
    }

    public function isFreeInterval(): bool
    {
        return true;
    }
}