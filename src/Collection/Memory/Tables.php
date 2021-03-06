<?php

namespace Restaurant\Collection\Memory;

use Restaurant\Entity\Table;
use Restaurant\Collection\Contract\ITables;
use Restaurant\Exception\RestaurantException;
use Restaurant\Collection\Contract\ICollection;

class Tables implements ITables, ICollection
{
    private $data = [];

    public function add(Table $table): void
    {
        if ($this->inUse($table)) {
            throw new RestaurantException("Table with {$table->number()} number already in use");
        }

        $this->data[] = $table;
    }

    public function inUse(Table $table): bool
    {
        foreach($this->data as $dataItem) {
            if ($dataItem->number() === $table->number()) {
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