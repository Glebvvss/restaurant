<?php 

use DateTime;
use PHPUnit\Framework\TestCase;
use Restaurant\Entity\TimeInterval;

class TimeIntervalTest extends TestCase
{
    public function test_common_success()
    {
        $timeFrom = new DateTime('2020-08-12 18:00');
        $timeTo   = new DateTime('2020-08-12 20:00');

        $timeInterval = new TimeInterval($timeFrom, $timeTo);

        $this->assertSame($timeFrom, $timeInterval->timeFrom());
        $this->assertSame($timeTo,   $timeInterval->timeTo());
    }

    public function commonInvalidArtimentExceptionDataProvider()
    {
        return [
            'time to less then time from' => [
                new DateTime('2020-08-12 18:00'), 
                new DateTime('2020-08-12 17:00')
            ],
            'time to equals time from' => [
                new DateTime('2020-08-12 18:00'), 
                new DateTime('2020-08-12 18:00')
            ],
        ];
    }

    /**
     * @dataProvider commonInvalidArtimentExceptionDataProvider
     */
    public function test_common_InvalidArgumentException($timeFrom, $timeTo)
    {
        $this->expectException(InvalidArgumentException::class);
        $timeInterval = new TimeInterval($timeFrom, $timeTo);
    }

    public function test_isEquals_true()
    {
        $timeInterval1 = new TimeInterval(
            new DateTime('2020-08-12 18:00'),
            new DateTime('2020-08-12 20:00')
        );

        $timeInterval2 = new TimeInterval(
            new DateTime('2020-08-12 18:00'),
            new DateTime('2020-08-12 20:00')
        );

        $this->assertTrue($timeInterval1->isEquals($timeInterval2));
    }

    public function test_isEquals_false()
    {
        $timeInterval1 = new TimeInterval(
            new DateTime('2020-08-12 18:00'),
            new DateTime('2020-08-12 20:00')
        );

        $timeInterval2 = new TimeInterval(
            new DateTime('2020-08-12 18:00'),
            new DateTime('2020-08-12 22:00')
        );

        $this->assertFalse($timeInterval1->isEquals($timeInterval2));
    }

    public function afterTrueDataProvider()
    {
        return [
            'neibours' => [
                new TimeInterval(new DateTime('2020-08-12 18:00'), new DateTime('2020-08-12 20:00')),
                new TimeInterval(new DateTime('2020-08-12 16:00'), new DateTime('2020-08-12 18:00'))
            ],
            'time between' => [
                new TimeInterval(new DateTime('2020-08-12 18:00'), new DateTime('2020-08-12 20:00')),
                new TimeInterval(new DateTime('2020-08-11 16:00'), new DateTime('2020-08-11 18:00'))
            ],
        ];
    }

    /**
     * @dataProvider afterTrueDataProvider
     */
    public function test_after_trueResult($timeInterval1, $timeInterval2)
    {
        $this->assertTrue($timeInterval1->after($timeInterval2));
    }

    public function afterFalseDataProvider()
    {
        return [
            'at the same time' => [
                new TimeInterval(new DateTime('2020-08-12 18:00'), new DateTime('2020-08-12 20:00')),
                new TimeInterval(new DateTime('2020-08-12 18:00'), new DateTime('2020-08-12 19:00'))
            ],
            'time between' => [
                new TimeInterval(new DateTime('2020-08-12 18:00'), new DateTime('2020-08-12 20:00')),
                new TimeInterval(new DateTime('2020-08-12 22:00'), new DateTime('2020-08-12 23:00'))
            ],
        ];
    }

    /**
     * @dataProvider afterFalseDataProvider
     */
    public function test_after_falseResult($timeInterval1, $timeInterval2)
    {
        $this->assertFalse($timeInterval1->after($timeInterval2));
    }

    public function beforeTrueDataProvider()
    {
        return [
            'neibours' => [
                new TimeInterval(new DateTime('2020-08-12 18:00'), new DateTime('2020-08-12 20:00')),
                new TimeInterval(new DateTime('2020-08-12 20:00'), new DateTime('2020-08-12 21:00'))
            ],
            'time between' => [
                new TimeInterval(new DateTime('2020-08-12 18:00'), new DateTime('2020-08-12 20:00')),
                new TimeInterval(new DateTime('2020-08-12 22:00'), new DateTime('2020-08-12 23:00'))
            ],
        ];
    }

    /**
     * @dataProvider beforeTrueDataProvider
     */
    public function test_before_trueResult($timeInterval1, $timeInterval2)
    {
        $this->assertTrue($timeInterval1->before($timeInterval2));
    }

    public function test_startedIn_trueResult()
    {
        $timeInterval1 = new TimeInterval(
            new DateTime('2020-08-12 18:00'), 
            new DateTime('2020-08-12 20:00')
        );

        $timeInterval2 = new TimeInterval(
            new DateTime('2020-08-12 18:00'), 
            new DateTime('2020-08-12 21:00')
        );

        $this->assertTrue($timeInterval1->startedIn($timeInterval2));
    }

    public function test_endedIn_trueResult()
    {
        $timeInterval1 = new TimeInterval(
            new DateTime('2020-08-12 18:00'), 
            new DateTime('2020-08-12 20:00')
        );

        $timeInterval2 = new TimeInterval(
            new DateTime('2020-08-12 19:00'), 
            new DateTime('2020-08-12 21:00')
        );

        $this->assertTrue($timeInterval1->endedIn($timeInterval2));
    }

    public function intersectWithTrueDataProvider()
    {
        return [
            'equals' => [
                new TimeInterval(new DateTime('2020-08-12 18:00'), new DateTime('2020-08-12 20:00')),
                new TimeInterval(new DateTime('2020-08-12 18:00'), new DateTime('2020-08-12 20:00'))
            ],
            'started in' => [
                new TimeInterval(new DateTime('2020-08-12 18:00'), new DateTime('2020-08-12 20:00')),
                new TimeInterval(new DateTime('2020-08-12 19:00'), new DateTime('2020-08-12 23:00'))
            ],
            'ended in' => [
                new TimeInterval(new DateTime('2020-08-12 18:00'), new DateTime('2020-08-12 20:00')),
                new TimeInterval(new DateTime('2020-08-12 17:00'), new DateTime('2020-08-12 19:00'))
            ],
            'same end time' => [
                new TimeInterval(new DateTime('2020-08-12 18:00'), new DateTime('2020-08-12 20:00')),
                new TimeInterval(new DateTime('2020-08-12 19:00'), new DateTime('2020-08-12 20:00'))
            ],
            'same end time reverse' => [
                new TimeInterval(new DateTime('2020-08-12 19:00'), new DateTime('2020-08-12 20:00')),
                new TimeInterval(new DateTime('2020-08-12 18:00'), new DateTime('2020-08-12 20:00'))
            ],
            'same start time' => [
                new TimeInterval(new DateTime('2020-08-12 18:00'), new DateTime('2020-08-12 20:00')),
                new TimeInterval(new DateTime('2020-08-12 18:00'), new DateTime('2020-08-12 19:00'))
            ],
        ];
    }

    /**
     * @dataProvider intersectWithTrueDataProvider
     */
    public function test_intersectWith_trueResult($timeInterval1, $timeInterval2)
    {
        $this->assertTrue($timeInterval1->intersectWith($timeInterval2));
    }

    public function intersectWithFalseDataProvider()
    {
        return [
            'neibours' => [
                new TimeInterval(new DateTime('2020-08-12 18:00'), new DateTime('2020-08-12 20:00')),
                new TimeInterval(new DateTime('2020-08-12 17:00'), new DateTime('2020-08-12 18:00'))
            ],
            'neibours reverse' => [
                new TimeInterval(new DateTime('2020-08-12 17:00'), new DateTime('2020-08-12 18:00')),
                new TimeInterval(new DateTime('2020-08-12 18:00'), new DateTime('2020-08-12 19:00'))
            ],
            'before time between' => [
                new TimeInterval(new DateTime('2020-08-11 18:00'), new DateTime('2020-08-11 20:00')),
                new TimeInterval(new DateTime('2020-08-12 18:00'), new DateTime('2020-08-12 20:00'))
            ],
        ];
    }

    /**
     * @dataProvider intersectWithFalseDataProvider
     */
    public function test_intersectWith_falseResult($timeInterval1, $timeInterval2)
    {
        $this->assertFalse($timeInterval1->intersectWith($timeInterval2));
    }
}