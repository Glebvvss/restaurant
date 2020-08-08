<?php

use PhpUnit\Framework\TestCase;

use Restaurant\Entity\Hall;
use Restaurant\Entity\HallName;
use Restaurant\Collection\Tables;

class HallTest extends TestCase
{
    public function test_common()
    {
        $name = new HallName('Main');
        $tables = new Tables();
        
        $hall = new Hall($name, $tables);

        $this->assertSame($name->string(), $hall->name());
        $this->assertSame($tables, $hall->tables());
    }
}