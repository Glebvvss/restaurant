<?php

namespace Restaurant\Collection;

use Restaurant\Entity\Hall;
use Restaurant\Entity\HallName;
use Restaurant\Exception\RestaurantException;

class Halls
{
    private $data = [];

    public function add(Hall $hall): void
    {
        if ($this->isReservedName($hall->name())) {
            throw new RestaurantException('This name alreadyReserves');
        }

        $this->data[] = $hall;
    }

    public function hallByName(HallName $hallName)
    {
        foreach($this->data as $dataItem) {
            if ($dataItem->name() === $hallName->string()) {
                return $dataItem;
            }
        }

        throw new RestaurantException("Hall with {$hallName->string()} name not found");
    }

    public function isReservedName(string $name): bool
    {
        foreach($this->data as $dataItem) {
            if ($dataItem->name() === $name) {
                return true;
            }
        }

        return false;
    }

    public function array(): array
    {
        return $this->data;
    }
}