<?php

namespace Restaurant\Collection\Contract;

use Restaurant\Entity\Table;
use Restaurant\Entity\Tables;

interface ITables
{
    public function add(Table $table): void;

    public function inUse(Table $table): bool;
}