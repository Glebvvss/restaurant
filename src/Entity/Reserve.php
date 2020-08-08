<?php

namespace Restaurant\Entity;

use Restaurant\Exception\RestaurantException;

class Reserve
{
    private TimeInterval $timeInterval;

    public function __construct(TimeInterval $timeInterval)
    {
        if ($timeInterval->timeFrom()->getTimestamp() < time()) {
            throw new RestaurantException('Cannot create reserve with start date time less then now');
        }

        $this->timeInterval = $timeInterval;
    }

    public function timeInterval(): TimeInterval
    {
        return $this->timeInterval;
    }
}