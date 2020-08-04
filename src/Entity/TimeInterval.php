<?php

namespace Restaurant\Entity;

use DateTime;

class TimeInterval
{
    private DateTime $timeFrom;
    private DateTime $timeTo;

    public function __construct(DateTime $timeFrom, DateTime $timeTo)
    {
        $this->timeFrom = $timeFrom;
        $this->timeTo   = $timeTo;
    }

    public function timeFrom(): DateTime
    {
        return $this->timeFrom;
    }

    public function timeTo(): DateTime
    {
        return $this->timeTo;
    }
}