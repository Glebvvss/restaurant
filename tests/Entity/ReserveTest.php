<?php 

use Datetime;
use Restaurant\Entity\Reserve;
use PHPUnit\Framework\TestCase;
use Restaurant\Entity\TimeInterval;

class ReserveTest extends TestCase
{
    public function test_correctUsage()
    {
        $timeInterval = new TimeInterval(
            new Datetime('2020-08-12 18:00'), 
            new Datetime('2020-08-12 20:00')
        );

        $reserve = new Reserve($timeInterval);

        $this->assertSame($timeInterval, $reserve->timeInterval());
    }
}