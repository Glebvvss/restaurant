<?php 

use PHPUnit\Framework\TestCase;

use Restaurant\Entity\Table;
use Restaurant\Entity\Reserve;
use Restaurant\Collection\Memory\Reserves;
use Restaurant\Entity\TimeInterval;
use Restaurant\Exception\RestaurantException;

class TableTest extends TestCase
{
    public function test_common_noReservesSuccess()
    {
        $number = 1;
        $reserves = new Reserves();

        $table = new Table($number, $reserves);

        $this->assertEquals($number, $table->number());
        $this->assertEquals($reserves, $table->reserves());
    }


    public function test_common_incorrectTableNumberValue()
    {
        $this->expectException(RestaurantException::class);

        $number = -1;
        $reserves = new Reserves();

        $table = new Table($number, $reserves);
    }

    public function test_isReservedAt_freeAtTheTime()
    {
        $timeInterval = new TimeInterval(
            new DateTime('2020-10-10 20:00'),
            new DateTime('2020-10-10 22:00')
        );

        $table = new Table(1, new Reserves());

        $this->assertFalse($table->isReservedAt($timeInterval));
    }

    public function test_isReservedAt_reservedAtTheTime()
    {
        $timeInterval = new TimeInterval(
            new DateTime('2020-10-10 20:00'),
            new DateTime('2020-10-10 22:00')
        );

        $reserves = new Reserves();
        $reserves->add(new Reserve($timeInterval));
        $table = new Table(1, $reserves);

        $this->assertTrue($table->isReservedAt($timeInterval));
    }
}