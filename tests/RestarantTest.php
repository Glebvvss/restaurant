<?php

use PhpUnit\Framework\Testcase;

use Restaurant\Restaurant;
use Restaurant\Entity\Hall;
use Restaurant\Entity\HallName;
use Restaurant\Collection\Memory\Halls;
use Restaurant\Collection\Memory\Tables;

class RestaurantTest extends TestCase
{
    public function test_hall()
    {
        $hall = new Hall(new HallName('Main'), new Tables());

        $halls = new Halls();
        $halls->add($hall);

        $restaurant = new Restaurant($halls);
        
        $this->assertEquals($hall, $restaurant->hall(new HallName('Main')));
    }

    public function test_halls()
    {
        $hall = new Hall(new HallName('Main'), new Tables());

        $halls = new Halls();
        $halls->add($hall);

        $restaurant = new Restaurant($halls);
        
        $this->assertEquals([$hall], $restaurant->halls());
    }

    public function test_addHall()
    {
        $hall = new Hall(new HallName('Main'), new Tables());

        $restaurant = new Restaurant(new Halls());
        $restaurant->addHall($hall);
        
        $this->assertEquals([$hall], $restaurant->halls());
    }
}