<?php 

use Datetime;
use Restaurant\Entity\Reserve;
use PHPUnit\Framework\TestCase;
use Restaurant\Entity\TimeInterval;
use Restaurant\Exception\RestaurantException;

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

    public function test_incorrectReserve_startReserveDateLessThenNow()
    {
        $this->expectException(RestaurantException::class);

        $timeInterval = new TimeInterval(
            new Datetime('1990-08-12 18:00'), 
            new Datetime('2020-08-12 20:00')
        );

        $reserve = new Reserve($timeInterval);
    }
}