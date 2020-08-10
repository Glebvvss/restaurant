<?php

namespace Restaurant\Collection\Memory;

use Restaurant\Entity\Hall;
use Restaurant\Entity\HallName;
use Restaurant\Collection\Contract\IHalls;
use Restaurant\Exception\RestaurantException;
use Restaurant\Collection\Contract\ICollection;

class Halls implements IHalls, ICollection
{
    private $data = [];

    public function add(Hall $hall): void
    {
        if ($this->isReservedName($hall->name())) {
            throw new RestaurantException('This name alreadyReserves');
        }

        $this->data[] = $hall;
    }

    public function hallByName(HallName $hallName): Hall
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