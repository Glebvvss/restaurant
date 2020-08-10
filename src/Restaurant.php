<?php

namespace Restaurant;

use Restaurant\Entity\Hall;
use Restaurant\Entity\HallName;
use Restaurant\Collection\Memory\Halls;

class Restaurant
{
    /**
     * @var Halls
     */
    private $halls;

    public function __construct(Halls $halls)
    {
        $this->halls = $halls;
    }

    public function hall(HallName $hallName): Hall
    {
        return $this->halls->hallByName($hallName);
    }

    public function halls(): array
    {
        return $this->halls->array();
    }

    public function addHall(Hall $hall): void
    {
        $this->halls->add($hall);
    }
}