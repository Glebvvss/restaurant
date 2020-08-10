<?php

namespace Restaurant\Entity;

use Restaurant\Collection\Reserves;
use Restaurant\Exception\RestaurantException;

class Table
{
    private int $number;
    private Reserves $reserves;

    public function __construct(int $number, Reserves $reserves)
    {
        if ($number <= 0) {
            throw new RestaurantException('Number of table must by unsigned');
        }

        $this->number   = $number;
        $this->reserves = $reserves;
    }

    public function number(): int
    {
        return $this->number;
    }

    public function reserves(): Reserves
    {
        return $this->reserves;
    }

    public function isReservedAt(TimeInterval $timeIterval): bool
    {
        return $this->reserves->isReservedTimeInterval($timeIterval);
    }
}