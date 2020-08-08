<?php 

use PHPUnit\Framework\TestCase;

use Restaurant\Entity\Reserve;
use Restaurant\Entity\TimeInterval;
use Restaurant\Collection\Reserves;
use Restaurant\Exception\RestaurantException;

class ReservesTest extends TestCase
{
    public function test_array_emptyReserves()
    {
        $reserves = new Reserves();
        $this->assertEquals([], $reserves->array());
    }

    public function test_isReservedTimeInterval_fully()
    {
        $timeInterval = new TimeInterval(
            new DateTime('2022-12-12 18:00'),
            new DateTime('2022-12-12 20:00')
        );

        $reserves = new Reserves();
        $this->assertFalse($reserves->isReservedTimeInterval($timeInterval));

        $reserves->add(new Reserve($timeInterval));
        $this->assertTrue($reserves->isReservedTimeInterval($timeInterval));
    }

    public function test_add_firstReserve()
    {
        $timeInterval = new TimeInterval(
            new DateTime('2022-12-12 18:00'),
            new DateTime('2022-12-12 20:00')
        );
        $reserve = new Reserve($timeInterval);

        $reserves = new Reserves();
        $reserves->add($reserve);
        
        $this->assertEquals([$reserve], $reserves->array());
    }

    public function test_add_duplicatedReserveTimeIntevals()
    {
        $this->expectException(RestaurantException::class);

        $timeInterval = new TimeInterval(
            new DateTime('2022-12-12 18:00'),
            new DateTime('2022-12-12 20:00')
        );
        $reserve1 = new Reserve($timeInterval);
        $reserve2 = new Reserve($timeInterval);

        $reserves = new Reserves();
        $reserves->add($reserve1);
        $reserves->add($reserve2);
    }

    public function test_add_intersectedReserveTimeIntevals()
    {
        $this->expectException(RestaurantException::class);

        $reserve1 = new Reserve(
            new TimeInterval(
                new DateTime('2022-12-12 18:00'),
                new DateTime('2022-12-12 20:00')
            )
        );

        $reserve2 = new Reserve(
            new TimeInterval(
                new DateTime('2022-12-12 19:00'),
                new DateTime('2022-12-12 20:00')
            )
        );

        $reserves = new Reserves();
        $reserves->add($reserve1);
        $reserves->add($reserve2);
    }
}