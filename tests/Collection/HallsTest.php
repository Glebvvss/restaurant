<?php

use Restaurant\Entity\Hall;
use Restaurant\Entity\HallName;
use PHPUnit\Framework\TestCase;
use Restaurant\Collection\Memory\Halls;
use Restaurant\Collection\Memory\Tables;
use Restaurant\Exception\RestaurantException;

class HallsTest extends TestCase
{
    public function test_array_emptyHalls()
    {
        $halls = new Halls();

        $this->assertEquals([], $halls->array());
    }

    public function test_array_existsHalls()
    {
        $hall = new Hall(new HallName('Main'), new Tables());

        $halls = new Halls();
        $halls->add($hall);

        $this->assertEquals([$hall], $halls->array());
    }

    public function test_array_duplicateHallNames()
    {
        $this->expectException(RestaurantException::class);

        $hall = new Hall(new HallName('Main'), new Tables());

        $halls = new Halls();
        $halls->add($hall);
        $halls->add($hall);
    }

    public function test_isReservedName_free()
    {
        $halls = new Halls();
    
        $this->assertFalse($halls->isReservedName('Main'));
    }

    public function test_isReservedName_reserved()
    {
        $hall = new Hall(new HallName('Main'), new Tables());

        $halls = new Halls();
        $halls->add($hall);
        
        $this->assertTrue($halls->isReservedName('Main'));
    }

    public function test_hallByName_success()
    {
        $hall = new Hall(new HallName('Main'), new Tables());

        $halls = new Halls();
        $halls->add($hall);

        $this->assertEquals($hall, $halls->hallByName(new HallName('main')));
    }

    public function test_hallByName_notFound()
    {
        $this->expectException(RestaurantException::class);

        $halls = new Halls();
        $hall = $halls->hallByName(new HallName('main'));
    }
}