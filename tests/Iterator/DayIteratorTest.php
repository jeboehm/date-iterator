<?php

declare(strict_types=1);

namespace Jeboehm\DateIterator\Tests\Iterator\DayIterator;

use Jeboehm\DateIterator\Iterator\DayIterator;
use Jeboehm\DateIterator\Model\DateRange;
use PHPUnit\Framework\TestCase;

class DayIteratorTest extends TestCase
{
    private DayIterator $iterator;

    protected function setUp(): void
    {
        $this->iterator = new DayIterator(
            DateRange::fromDateTime(
                new \DateTime('2019-12-03'),
                new \DateTime('2019-12-10')
            )
        );
    }

    public function testDatesWithWeekends(): void
    {
        $expected = [
            '2019-12-03',
            '2019-12-04',
            '2019-12-05',
            '2019-12-06',
            '2019-12-07',
            '2019-12-08',
            '2019-12-09',
            '2019-12-10',
        ];

        $i = 0;

        foreach ($this->iterator as $date) {
            $this->assertEquals($expected[$i], $date->format('Y-m-d'));

            $i++;
        }

        $this->assertEquals(8, $i);
    }

    public function testDateWithoutWeekends(): void
    {
        $this->iterator->setExcludeWeekend(true);

        $expected = [
            '2019-12-03',
            '2019-12-04',
            '2019-12-05',
            '2019-12-06',
            '2019-12-09',
            '2019-12-10',
        ];

        $i = 0;

        foreach ($this->iterator as $date) {
            $this->assertEquals($expected[$i], $date->format('Y-m-d'));

            $i++;
        }

        $this->assertEquals(6, $i);
    }
}
