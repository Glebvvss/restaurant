<?php

namespace Restaurant\Collection\Contract;

use Restaurant\Entity\Hall;
use Restaurant\Entity\HallName;

interface IHalls
{
    public function add(Hall $hall): void;

    public function hallByName(HallName $hallName): Hall;
    
    public function isReservedName(string $name): bool;
}