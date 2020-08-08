<?php

namespace Restaurant\Collection;

use Restaurant\Entity\Reserve;
use Restaurant\Entity\TimeInterval;
use Restaurant\Exception\RestaurantException;

class Reserves
{
    private $data = [];

    public function add(Reserve $reserve): void
    {
        if ($this->isReservedTimeInterval($reserve->timeInterval())) {
            throw new RestaurantException('Reserves must not be intersected');
        }

        $this->data[] = $reserve;
    }

    public function isReservedTimeInterval(TimeInterval $timeInterval): bool
    {
        foreach($this->data as $dataItem) {
            if ($dataItem->timeInterval()->intersectWith($timeInterval)) {
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