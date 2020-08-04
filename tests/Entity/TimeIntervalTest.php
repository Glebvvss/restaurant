<?php 

use DateTime;
use PHPUnit\Framework\TestCase;
use Restaurant\Entity\TimeInterval;

class TimeIntervalTest extends TestCase
{
    public function test_correctUsage()
    {
        $timeFrom = new DateTime('2020-08-12 18:00');
        $timeTo   = new DateTime('2020-08-12 20:00');

        $timeInterval = new TimeInterval($timeFrom, $timeTo);

        $this->assertSame($timeFrom, $timeInterval->timeFrom());
        $this->assertSame($timeTo,   $timeInterval->timeTo());
    }
}