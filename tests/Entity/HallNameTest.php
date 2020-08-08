<?php

use PhpUnit\Framework\TestCase;

use Restaurant\Entity\HallName;

class HallNameTest extends TestCase
{
    public function test_string_emptyValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $hallName = new HallName('');
    }

    public function stringCorrectValueDataProvider()
    {
        return [
            'Upper first symbol string' => ['Main', 'Main'],
            'Lower case string' => ['main', 'Main'],
            'Not trimmed strign' => [' main ', 'Main'],
        ];
    }

    /**
     * @dataProvider stringCorrectValueDataProvider
     */
    public function test_string_correctValue($name, $expectedResult)
    {
        $hallName = new HallName($name);
        $this->assertSame($expectedResult, $hallName->string());
    }
}