<?php

namespace Restaurant\Entity;

class Reserve
{
    private TimeInterval $timeInterval;

    public function __construct(TimeInterval $timeInterval)
    {
        $this->timeInterval = $timeInterval;
    }

    public function timeInterval(): TimeInterval
    {
        return $this->timeInterval;
    }
}