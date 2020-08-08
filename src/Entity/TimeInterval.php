<?php

namespace Restaurant\Entity;

use DateTime;
use InvalidArgumentException;

class TimeInterval
{
    private DateTime $timeFrom;
    private DateTime $timeTo;

    public function __construct(DateTime $timeFrom, DateTime $timeTo)
    {
        if ($timeFrom->getTimestamp() >= $timeTo->getTimestamp()) {
            throw new InvalidArgumentException('Parameter $timeFrom must be less than $timeTo');
        }

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

    public function intersectWith(TimeInterval $timeInterval): bool
    {
        if ($this->isEquals($timeInterval)) {
            return true;
        }

        if ($this->startedIn($timeInterval) || $this->endedIn($timeInterval)) {
            return true;
        }

        return false;
    }

    public function isEquals(TimeInterval $timeInterval): bool
    {
        return $this->timeFrom()->getTimestamp() === $timeInterval->timeFrom()->getTimestamp()
            && $this->timeTo()->getTimestamp() === $timeInterval->timeTo()->getTimestamp();
    }

    public function after(TimeInterval $timeInterval): bool
    {
        return $this->timeFrom()->getTimestamp() >= $timeInterval->timeTo()->getTimestamp();
    }

    public function before(TimeInterval $timeInterval): bool
    {
        return $this->timeTo()->getTimestamp() <= $timeInterval->timeFrom()->getTimestamp();
    }

    public function startedIn(TimeInterval $timeInterval): bool
    {
        return $this->timeFrom()->getTimestamp() >= $timeInterval->timeFrom()->getTimestamp()
            && $this->timeFrom()->getTimestamp() <  $timeInterval->timeTo()->getTimestamp();
    }

    public function endedIn(TimeInterval $timeInterval): bool
    {
        return $this->timeTo()->getTimestamp() >  $timeInterval->timeFrom()->getTimestamp()
            && $this->timeTo()->getTimestamp() <= $timeInterval->timeTo()->getTimestamp();
    }
}