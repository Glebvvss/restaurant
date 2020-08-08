<?php 

use Restaurant\Entity\Table;
use Restaurant\Entity\Reserve;
use PHPUnit\Framework\TestCase;
use Restaurant\Collection\Tables;
use Restaurant\Collection\Reserves;
use Restaurant\Exception\RestaurantException;

class TablesTest extends TestCase
{
    public function test_add_success()
    {
        $table = new Table(1, new Reserves());

        $tables = new Tables();
        $tables->add($table);

        $this->assertEquals([$table], $tables->array());
    }

    public function test_add_duplicateTables()
    {
        $this->expectException(RestaurantException::class);

        $tables = new Tables();
        $tables->add(new Table(1, new Reserves()));
        $tables->add(new Table(1, new Reserves()));
    }

    public function test_inUse_newTable()
    {
        $tables = new Tables();
        $table = new Table(1, new Reserves());
        $this->assertFalse($tables->inUse($table));
    }

    public function test_inUse_alreadyUsesTable()
    {
        $tables = new Tables();
        $table = new Table(1, new Reserves());
        $tables->add($table);
        $this->assertTrue($tables->inUse($table));
    }
}