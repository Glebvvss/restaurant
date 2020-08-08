<?php

namespace Restaurant\Collection\Contract;

use Restaurant\Entity\Reserve;
use Restaurant\Entity\TimeInterval;

interface IReserves
{
    public function add(Reserve $reserve): void;

    public function isReservedTimeInterval(TimeInterval $timeInterval): bool;
}