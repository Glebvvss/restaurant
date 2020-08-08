<?php

namespace Restaurant\Entity;

use InvalidAgrumentException;
use Restaurant\Collection\Tables;

class Hall
{
    private HallName $name;
    private Tables $tables;

    public function __construct(HallName $name, Tables $tables)
    {
        if (empty($name)) {
            throw new InvalidAgrumentException('Hall name cannot be empty');
        }

        $this->name = $name;
        $this->tables = $tables;
    }

    public function name(): string
    {
        return $this->name->string();
    }

    public function tables(): Tables
    {
        return $this->tables;
    }
}